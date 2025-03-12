<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        //$papers = Paper::all()->orderBy, 'DESC');
        $papers = [];
        $year = range(Carbon::now()->year - 4, Carbon::now()->year);
        $y = $year;
        //$papers =Paper::orderBy('paper_yearpub', 'desc')->where('paper_yearpub', '=', 1)->get();
        $years = range(Carbon::now()->year, Carbon::now()->year - 4);
        foreach ($years as $key => $value) {
            $papers[$value] = Paper::where('paper_yearpub', '=', $value)->orderBy('paper_yearpub', 'desc')->get();
        }

        //return response()->json($years);
        //$year = range(Carbon::now()->year-5, Carbon::now()->year);
        $paper_tci = [];
        $paper_scopus = [];
        $paper_wos = [];

        foreach ($year as $key => $value) {
            $paper_scopus[] = Paper::whereHas('source', function ($query) {
                return $query->where('source_data_id', '=', 1);
            })->whereIn('paper_type', ['Conference Proceeding', 'Journal'])
                ->where(DB::raw('(paper_yearpub)'), $value)->count();
        }
        //return $paper_scopus;

        foreach ($year as $key => $value) {
            $paper_tci[] = Paper::whereHas('source', function ($query) {
                return $query->where('source_data_id', '=', 3);
            })->whereIn('paper_type', ['Conference Proceeding', 'Journal'])
                ->where(DB::raw('(paper_yearpub)'), $value)->count();
        }

        foreach ($year as $key => $value) {
            $paper_wos[] = Paper::whereHas('source', function ($query) {
                return $query->where('source_data_id', '=', 2);
            })->whereIn('paper_type', ['Conference Proceeding', 'Journal'])
                ->where(DB::raw('(paper_yearpub)'), $value)->count();
        }
        //return $paper_tci;

        // $paper_wos_cit= Paper::whereHas('source', function ($query) {
        //     return $query->where('source_data_id', '=', 1);
        // })->whereIn('paper_type', ['Conference Paper','Article'])->get();
        $paper_scopus_cit = [];
        $paper_tci_cit = [];
        $paper_wos_cit = [];
        foreach ($year as $key => $value) {
            $paper_scopus_cit[] = Paper::whereHas('source', function ($query) {
                return $query->where('source_data_id', '=', 1);
            })->whereIn('paper_type', ['Conference Proceeding', 'Journal'])
                ->where('paper_yearpub', '=', $value)
                ->sum('paper_citation');
        }
        foreach ($year as $key => $value) {
            $paper_wos_cit[] = Paper::whereHas('source', function ($query) {
                return $query->where('source_data_id', '=', 2);
            })->whereIn('paper_type', ['Conference Proceeding', 'Journal'])
                ->where('paper_yearpub', '=', $value)
                ->sum('paper_citation');
        }
        foreach ($year as $key => $value) {
            $paper_tci_cit[] = Paper::whereHas('source', function ($query) {
                return $query->where('source_data_id', '=', 3);
            })->whereIn('paper_type', ['Conference Proceeding', 'Journal'])
                ->where('paper_yearpub', '=', $value)
                ->sum('paper_citation');
        }
        //อาจารย์กี่คนที่ตีพิมพ์ในปีนั้น คิดเป็นกี่คน และกี่เรื่อว หาค่าเฉลี่ย
        // $user_scopus = [];
        // foreach ($year as $key => $value) {
        //     $user = Paper::withCount('teacher')->whereHas('source', function ($query) {
        //         return $query->where('source_data_id', '=', 1);
        //     })->whereIn('paper_type', ['Conference Proceeding', 'Journal'])
        //         ->where('paper_yearpub', '=', $value)->get();
        //     foreach ($user as $key => $val) {
        //         $new_data1 = array($value => $val['teacher_count']);
        //         $user_scopus[] = $new_data1;
        //     }
        // }

        // //$user_scopus=Array($user_scopus);
        // return gettype($user_scopus);
        

       
        //return $sumArray;


        return view('report', compact('papers', 'y'))->with('year', json_encode($year, JSON_NUMERIC_CHECK))
            ->with('paper_tci', json_encode($paper_tci, JSON_NUMERIC_CHECK))
            ->with('paper_scopus', json_encode($paper_scopus, JSON_NUMERIC_CHECK))
            ->with('paper_wos', json_encode($paper_wos, JSON_NUMERIC_CHECK))
            ->with('paper_scopus_cit', json_encode($paper_scopus_cit, JSON_NUMERIC_CHECK))
            ->with('paper_wos_cit', json_encode($paper_wos_cit, JSON_NUMERIC_CHECK))
            ->with('paper_tci_cit', json_encode($paper_tci_cit, JSON_NUMERIC_CHECK));
    }
}
