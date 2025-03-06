<?php

namespace App\Http\Controllers;

use App\Models\Academicwork;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function request($id){
        //$res=User::where('id',$id)->with('paper')->get();
        //User::with(['paper'])->where('id',$id)->get();
        //$paper = User::with(['paper','author'])->where('id',$id)->get();
        $id = Crypt::decrypt($id);
        $res = User::where('id',$id)->first();
        $teachers = User::role('teacher')->get();
        
        $papers = Paper::with('teacher','author','source')->whereHas('teacher', function($query) use($id) {
            $query->where('users.id', '=', $id);
        })->orderBy('paper_yearpub', 'desc')-> get();

        $papers_scopus = Paper::with('teacher','author','source')->whereHas('teacher', function($query) use($id) {
            $query->where('users.id', '=', $id);
        })->orderBy('paper_yearpub', 'desc')->whereHas('source', function($query) {
            $query->where('source_data_id', '=', 1);
        })->get();
//return $papers_scopus;

        $papers_wos = Paper::with('teacher','author','source')->whereHas('teacher', function($query) use($id) {
            $query->where('users.id', '=', $id);
        })->whereHas('source', function($query) {
            $query->where('source_data_id', '=', 2);
        })->orderBy('paper_yearpub', 'desc')-> get();
        
        $papers_tci = Paper::with('teacher','author')->whereHas('teacher', function($query) use($id) {
            $query->where('users.id', '=', $id);
        })->whereHas('source', function($query) {
            $query->where('source_data_id', '=', 3);
        })->orderBy('paper_yearpub', 'desc')-> get();

        // $papers_tci = Paper::with('teacher','author')->whereHas('teacher', function($query) use($id) {
        //     $query->where('users.id', '=', $id);
        // })->whereHas('source', function($query) {
        //     $query->where('source_data_id', '=', 3);
        // })-> get();

        // $book_chapter = Paper::with('teacher','author')->whereHas('teacher', function($query) use($id) {
        //     $query->where('users.id', '=', $id);
        // })->whereHas('source', function($query) {
        //     $query->where('source_data_id', '=', 4);
        // })-> get();

        $book_chapter = Academicwork::with('user','author')->whereHas('user', function($query) use($id) {
            $query->where('users.id', '=', $id);
        })->where('ac_type', '=', 'book')->get();

       

        $patent = Academicwork::with('user','author')->whereHas('user', function($query) use($id) {
            $query->where('users.id', '=', $id);
        })->where('ac_type', '!=', 'book')->get();
        //return $res;

        $year = range(Carbon::now()->year-5, Carbon::now()->year);
        $paper_tci = [];
        $paper_scopus = [];
        $paper_wos = [];
        foreach ($year as $key => $value) { 
            $paper_scopus[] = Paper::with('teacher')->whereHas('source', function ($query) {
                return $query->where('source_data_id', '=', 1);
            })->whereHas('teacher',  function($query) use($id) {
                $query->where('users.id', '=', $id);
            })
            ->where(DB::raw('(paper_yearpub)'),$value)->count();
        }

        foreach ($year as $key => $value) { 
            $paper_tci[] = Paper::whereHas('source', function ($query) {
                return $query->where('source_data_id', '=', 3);
            })
            ->whereHas('teacher',  function($query) use($id) {
                $query->where('users.id', '=', $id);
            })->where(DB::raw('(paper_yearpub)'),$value)->count();
        }

        foreach ($year as $key => $value) { 
            $paper_wos[] = Paper::whereHas('source', function ($query) {
                return $query->where('source_data_id', '=', 2);
            })
            ->whereHas('teacher',  function($query) use($id) {
                $query->where('users.id', '=', $id);
            })->where(DB::raw('(paper_yearpub)'),$value)->count();
        }

        $year2 = range(Carbon::now()->year-20, Carbon::now()->year);
        $paper_tci_s = [];
        $paper_scopus_s = [];
        $paper_wos_s = [];
        $paper_book_s = [];
        $paper_patent_s = [];
        foreach ($year2 as $key => $value) { 
            $paper_scopus_s[] = Paper::with('teacher')->whereHas('source', function ($query) {
                return $query->where('source_data_id', '=', 1);
            })->whereHas('teacher',  function($query) use($id) {
                $query->where('users.id', '=', $id);
            })
            ->where(DB::raw('(paper_yearpub)'),$value)->count();
        }

        foreach ($year2 as $key => $value) { 
            $paper_tci_s[] = Paper::whereHas('source', function ($query) {
                return $query->where('source_data_id', '=', 3);
            })
            ->whereHas('teacher',  function($query) use($id) {
                $query->where('users.id', '=', $id);
            })->where(DB::raw('(paper_yearpub)'),$value)->count();
        }

        foreach ($year2 as $key => $value) { 
            $paper_wos_s[] = Paper::whereHas('source', function ($query) {
                return $query->where('source_data_id', '=', 2);
            })
            ->whereHas('teacher',  function($query) use($id) {
                $query->where('users.id', '=', $id);
            })->where(DB::raw('(paper_yearpub)'),$value)->count();
        }
        

        foreach ($year2 as $key => $value) { 
            $paper_book_s[] = Academicwork::where('ac_type', '=', 'book')
            ->whereHas('user',  function($query) use($id) {
                $query->where('users.id', '=', $id);
            })->where(DB::raw('YEAR(ac_year)'),$value)->count();
        }
        foreach ($year2 as $key => $value) { 
            $paper_patent_s[] = Academicwork::where('ac_type', '=', 'book')
            ->whereHas('user',  function($query) use($id) {
                $query->where('users.id', '=', $id);
            })->where(DB::raw('Year(ac_year)'),$value)->count();
        }
        //return $paper_patent_s;
        


    	return view('researchprofiles')->with('year',json_encode($year,JSON_NUMERIC_CHECK))
                ->with('paper_tci',json_encode($paper_tci,JSON_NUMERIC_CHECK))
                ->with('paper_scopus',json_encode($paper_scopus,JSON_NUMERIC_CHECK))
                ->with('paper_wos',json_encode($paper_wos,JSON_NUMERIC_CHECK))
                ->with('paper_tci_s',json_encode($paper_tci_s,JSON_NUMERIC_CHECK))
                ->with('paper_scopus_s',json_encode($paper_scopus_s,JSON_NUMERIC_CHECK))
                ->with('paper_wos_s',json_encode($paper_wos_s,JSON_NUMERIC_CHECK))
                ->with('paper_book_s',json_encode($paper_book_s,JSON_NUMERIC_CHECK))
                ->with('paper_patent_s',json_encode($paper_patent_s,JSON_NUMERIC_CHECK))
                ->with(compact('res','teachers','papers','papers_tci','papers_scopus','papers_wos','book_chapter','patent'));


    //return view('researchprofiles',compact('res','papers','year','paper'))->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('paper',json_encode($paper,JSON_NUMERIC_CHECK));

    }
}