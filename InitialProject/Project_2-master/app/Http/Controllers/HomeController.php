<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Bibtex;
use RenanBr\BibTexParser\Listener;
use RenanBr\BibTexParser\Parser;
use RenanBr\BibTexParser\Processor;

class HomeController extends Controller
{

    public function index()
    {
        //$papers = Paper::all()->orderBy, 'DESC');
        $papers = [];
        $year = range(Carbon::now()->year - 4, Carbon::now()->year);
        //$papers =Paper::orderBy('paper_yearpub', 'desc')->where('paper_yearpub', '=', 1)->get();
        $years = range(Carbon::now()->year, Carbon::now()->year - 5);

        $from = Carbon::now()->year - 16;
        $to = Carbon::now()->year - 6;
        // foreach ($years as $key => $value) {
        //     $papers[$value] = Paper::where('paper_yearpub', '=', $value)->orderBy('paper_yearpub', 'desc')->get();
        // }
        //return gettype($papers);

        // $p=Paper::with('author','teacher')->whereHas('teacher', function ($query) {
        //     return $query->select(['fname_en','lname_en']);
        // })->get();
        $p2 = Paper::with([
            'teacher' => function ($query) {
                $query->select(DB::raw("CONCAT(concat(left(fname_en,1),'.'),' ',lname_en) as full_name"))->addSelect('user_papers.author_type');
            },
            'author' => function ($query) {
                $query->select(DB::raw("CONCAT(concat(left(author_fname,1),'.'),' ',author_lname) as full_name"))->addSelect('author_of_papers.author_type');
            },

        ])->whereBetween('paper_yearpub', [$from, $to])->orderBy('paper_yearpub', 'desc')->get()->toArray();

        $paper2 = array_map(function ($tag) {
            $t = collect($tag['teacher']);
            $a = collect($tag['author']);
            $aut = $t->concat($a);
            $aut = $aut->sortBy(['author_type', 'asc']);
            //$ids = collect(['First author', 'Co-author', 'Corresponding author']);
            $sorted = $aut->implode('full_name', ', ');
            //return $sorted;
            return array(
                'id' => $tag['id'],
                'author' => $sorted,
                'paper_name' => $tag['paper_name'],
                'paper_sourcetitle' => $tag['paper_sourcetitle'],
                'paper_type' => $tag['paper_type'],
                'paper_subtype' => $tag['paper_subtype'],
                'paper_yearpub' => $tag['paper_yearpub'],
                'paper_url' => $tag['paper_url'],
                'paper_volume' => $tag['paper_volume'],
                'paper_issue' => $tag['paper_issue'],
                'paper_citation' => $tag['paper_citation'],
                'paper_page' => $tag['paper_page'],
                'paper_doi' => $tag['paper_doi'],
            );
        }, $p2);
        //return $paper2;


        foreach ($years as $key => $value) {
            $p = Paper::with([
                'teacher' => function ($query) {
                    $query->select(DB::raw("CONCAT(concat(left(fname_en,1),'.'),' ',lname_en) as full_name"))->addSelect('user_papers.author_type');
                },
                'author' => function ($query) {
                    $query->select(DB::raw("CONCAT(concat(left(author_fname,1),'.'),' ',author_lname) as full_name"))->addSelect('author_of_papers.author_type');
                },

            ])->where('paper_yearpub', '=', $value)->orderBy('paper_yearpub', 'desc')->get()->toArray();
            //return $p;
            $paper = array_map(function ($tag) {
                $t = collect($tag['teacher']);
                $a = collect($tag['author']);
                $aut = $t->concat($a);
                $aut = $aut->sortBy(['author_type', 'asc']);
                //$ids = collect(['First author', 'Co-author', 'Corresponding author']);
                $sorted = $aut->implode('full_name', ', ');
                //return $sorted;
                return array(
                    'id' => $tag['id'],
                    'author' => $sorted,
                    'paper_name' => $tag['paper_name'],
                    'paper_sourcetitle' => $tag['paper_sourcetitle'],
                    'paper_type' => $tag['paper_type'],
                    'paper_subtype' => $tag['paper_subtype'],
                    'paper_yearpub' => $tag['paper_yearpub'],
                    'paper_url' => $tag['paper_url'],
                    'paper_volume' => $tag['paper_volume'],
                    'paper_issue' => $tag['paper_issue'],
                    'paper_citation' => $tag['paper_citation'],
                    'paper_page' => $tag['paper_page'],
                    'paper_doi' => $tag['paper_doi'],
                );
            }, $p);
            $papers[$value] = collect($paper);
        }
        //$papers['Before '.$to] = collect($paper2);
        $papers[$to] = collect($paper2);
        //return $p;




        //return $papers;
        //return gettype($papers);
        //return response()->json($years);
        //$year = range(Carbon::now()->year-5, Carbon::now()->year);

        //--------------- count by year-------------------//
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
        //---------------------------------//

        // $paper_scopus = Paper::whereHas('source', function ($query) {
        //     return $query->where('source_data_id', '=', 1);
        // })->whereIn('paper_type', ['Conference Proceeding', 'Journal'])->count();


        // //return $paper_scopus;


        // $paper_tci = Paper::whereHas('source', function ($query) {
        //     return $query->where('source_data_id', '=', 3);
        // })->whereIn('paper_type', ['Conference Proceeding', 'Journal'])->count();

        //return $paper_tci;


        // $paper_wos = Paper::whereHas('source', function ($query) {
        //     return $query->where('source_data_id', '=', 2);
        // })->whereIn('paper_type', ['Conference Proceeding', 'Journal'])->count();

        $num = $this->getnum();
        $paper_tci_numall = $num['paper_tci'];
        $paper_scopus_numall = $num['paper_scopus'];
        $paper_wos_numall = $num['paper_wos'];
        //return $paper_scopus_numall;
        

        //$id = 0

        //$bb = $this->bibtex(2);

        //$key="watchara";
        //return response()->json($bb);
        return view('home', compact('papers'))->with('year', json_encode($year, JSON_NUMERIC_CHECK))
            ->with('paper_tci', json_encode($paper_tci, JSON_NUMERIC_CHECK))
            ->with('paper_scopus', json_encode($paper_scopus, JSON_NUMERIC_CHECK))
            ->with('paper_wos', json_encode($paper_wos, JSON_NUMERIC_CHECK))
            ->with('paper_tci_numall', json_encode($paper_tci_numall, JSON_NUMERIC_CHECK))
            ->with('paper_scopus_numall', json_encode($paper_scopus_numall, JSON_NUMERIC_CHECK))
            ->with('paper_wos_numall', json_encode($paper_wos_numall, JSON_NUMERIC_CHECK));



        // return $papers;
        // (DB::raw('YEAR(paper_yearpub)')
        //return view('home',compact('papers'));
    }

    public function getnum()
    {
        $paper_scopus = Paper::whereHas('source', function ($query) {
            return $query->where('source_data_id', '=', 1);
        })->whereIn('paper_type', ['Conference Proceeding', 'Journal'])->count();


        //return $paper_scopus;


        $paper_tci = Paper::whereHas('source', function ($query) {
            return $query->where('source_data_id', '=', 3);
        })->whereIn('paper_type', ['Conference Proceeding', 'Journal'])->count();

        //return $paper_tci;


        $paper_wos = Paper::whereHas('source', function ($query) {
            return $query->where('source_data_id', '=', 2);
        })->whereIn('paper_type', ['Conference Proceeding', 'Journal'])->count();

        return compact('paper_scopus','paper_tci','paper_wos');
    }
    public function bibtex($id)
    {
        $paper = Paper::with(['author' => function ($query) {
            $query->select('author_name');
        }])->find([$id])->first()->toArray();

        $Path['lib'] = './../lib/';
        require_once $Path['lib'] . 'lib_bibtex.inc.php';

        $Site = array();


        $Site['bibtex'] = new Bibtex('references.bib');
        $bb = $Site['bibtex'];

        $title = $paper['paper_name'];

        $a = collect($paper['author']);
        $author = $a->implode('author_name', ', ');
        $journal = $paper['paper_sourcetitle'];
        $volume = $paper['paper_volume'];
        $number = $paper['paper_citation'];
        $page = $paper['paper_page'];
        $year = $paper['paper_yearpub'];
        $doi = $paper['paper_doi'];

        $key = "kku";
        $arr = array("type" => $type, "key" => "kku", "author" => $author, "title" => $title, "journal" => $journal, "volume" => $volume, "number" => $number, 'year' => $year, 'pages' => $page, 'ee' => $doi);

        $bb->bibarr["kku"] = $arr;
        $key = "kku";

        return response()->json($key, $bb);
    }
}
