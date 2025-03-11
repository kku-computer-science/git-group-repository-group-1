<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Paper;
use App\Models\User;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\TemplateProcessor;

class PDFController extends Controller
{
    

    public function index()
    {
        $user = User::findOrFail(1);
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];


        return view('myPDF', compact('$user'));
    }
    public function generateInvoiceExcel(Request $request)
    {

        $from = Carbon::now()->year - 5;
        $to = Carbon::now()->year;
        $user = User::find($request->id);
        //$user->paper
        // $p = $user->paper()->whereIn('paper_type', ['Conference Paper', 'Journal'])->whereBetween('paper_yearpub', [$from, $to])->with(['author' => function ($query) {
        //     $query->select('author_name');
        // }])->get()->toArray();
        //$p= $user->paper->toArray();
        $p = $user->paper()->whereIn('paper_type', ['Conference Paper', 'Journal'])->whereBetween('paper_yearpub', [$from, $to])->with([
            'teacher' => function ($query) {
                $query->select(DB::raw("CONCAT(concat(left(fname_en,1),'.'),' ',lname_en) as full_name"))->addSelect('user_papers.author_type');
            },
            'author' => function ($query) {
                $query->select(DB::raw("CONCAT(concat(left(author_fname,1),'.'),' ',author_lname) as full_name"))->addSelect('author_of_papers.author_type');
            }
        ])->get()->toArray();

        // $tags = array_map(function ($tag) {
        //     $a = collect($tag['author']);
        //     $ex = collect($tag['paper_page']);
        //     $b = $a->implode('author_name', ', ');
        //     $c = explode("-", $tag['paper_page']);

        //     $first = @$c[0];
        //     $last = @$c[1];

        //     return array(
        //         'author' => $b,
        //         'paper_name' => $tag['paper_name'],
        //         'paper_yearpub' => $tag['paper_yearpub'],
        //         'paper_sourcetitle' => $tag['paper_sourcetitle'],
        //         'paper_volume' => $tag['paper_volume'],
        //         'paper_issue' => $tag['paper_issue'],
        //         'paper_page_start' => $first,
        //         'paper_page_end' => $last,
        //         'paper_citation' => $tag['paper_citation'],
        //         'paper_doi' => $tag['paper_doi'],
        //     );
        // }, $p);
        $p = array_map(function ($tag) {
            $t = collect($tag['teacher']);
            $a = collect($tag['author']);
            $aut = $t->concat($a);
            $aut = $aut->sortBy(['author_type', 'asc']);
            //$ids = collect(['First author', 'Co-author', 'Corresponding author']);
            $sorted = $aut->implode('full_name', ', ');
            //return $sorted;
            $c = explode("-", $tag['paper_page']);

            $first = @$c[0];
            $last = @$c[1];
            return array(
                //'id' => $tag['id'],
                'author' => $sorted,
                'paper_name' => $tag['paper_name'],
                'paper_yearpub' => $tag['paper_yearpub'],
                'paper_sourcetitle' => $tag['paper_sourcetitle'],
                'paper_volume' => $tag['paper_volume'],
                'paper_issue' => $tag['paper_issue'],
                'paper_page_start' => $first,
                'paper_page_end' => $last,
                'paper_citation' => $tag['paper_citation'],
                'paper_doi' => $tag['paper_doi'],
                'paper_subtype' => $tag['paper_subtype'], 
            );
        }, $p);
        $tags = (object) $p;
        //return $tags;
        ob_end_clean(); // this
        ob_start(); // and this
        $fileName = $user->fname_en;
        return Excel::download(new UsersExport($tags), $fileName . '.csv');
    }
    public function generateInvoicePDF(Request $request)
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
        $user = User::find($request->id);

        $ed = $user->education;
        $from = Carbon::now()->year - 5;
        $to = Carbon::now()->year;

        $p = $user->paper()->whereIn('paper_type', ['Conference Paper', 'Journal'])->whereBetween('paper_yearpub', [$from, $to])->with([
            'teacher' => function ($query) {
                $query->select(DB::raw("CONCAT(concat(left(fname_en,1),'.'),' ',lname_en) as full_name"))->addSelect('user_papers.author_type');
            },
            'author' => function ($query) {
                $query->select(DB::raw("CONCAT(concat(left(author_fname,1),'.'),' ',author_lname) as full_name"))->addSelect('author_of_papers.author_type');
            }
        ])->get()->toArray();

        $p = array_map(function ($tag) {
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
        $p = (object) $p;
//return gettype($p);
        // $b = $user->academicworks()->whereHas('academicworks', function ($query) {
        //     return $query->where('ac_type', '=', 'book');
        // })->get();
        $b = $user->academicworks()->where('ac_type', '=', 'book')->get();
        //return $b;
        $pat = $user->academicworks()->where('ac_type', '!=', 'book')->with([
            'user' => function ($query) {
                $query->select(DB::raw("CONCAT(fname_th,' ',lname_th) as full_name"))->addSelect('user_of_academicworks.author_type');
            },
            'author' => function ($query) {
                $query->select(DB::raw("CONCAT(author_fname,' ',author_lname) as full_name"))->addSelect('author_of_academicworks.author_type');
            }
        ])->get();
//return $pat;

        $pdf = PDF::loadView('myPDF', compact('user', 'ed', 'p', 'b', 'pat', 'from', 'to'));


        return $pdf->stream(rand() . '.pdf');
    }
    public function generateInvoiceDOCX(Request $request)
    {

        $user = User::findOrFail($request->id);

        $u1 = $user->education()->where('level', '=', 1)->first();
        $u2 = $user->education()->where('level', '=', 2)->first();
        $u3 = $user->education()->where('level', '=', 3)->first();
        // return $u3;
        $from = Carbon::now()->year - 5;
        $to = Carbon::now()->year;
        //$years = range(Carbon::now()->year, Carbon::now()->year - 5);

        $p = $user->paper()->whereIn('paper_type', ['Conference Paper', 'Journal'])->whereBetween('paper_yearpub', [$from, $to])->with([
            'teacher' => function ($query) {
                $query->select(DB::raw("CONCAT(concat(left(fname_en,1),'.'),' ',lname_en) as full_name"))->addSelect('user_papers.author_type');
            },
            'author' => function ($query) {
                $query->select(DB::raw("CONCAT(concat(left(author_fname,1),'.'),' ',author_lname) as full_name"))->addSelect('author_of_papers.author_type');
            }
        ])->get()->toArray();
        

        $b = $user->academicworks()->where('ac_type', '=', 'book')->get()->toArray();

        $pat = $user->academicworks()->where('ac_type', '!=', 'book')->with([
            'user' => function ($query) {
                $query->select(DB::raw("CONCAT(fname_th,' ',lname_th) as full_name"))->addSelect('user_of_academicworks.author_type');
            },
            'author' => function ($query) {
                $query->select(DB::raw("CONCAT(author_fname,' ',author_lname) as full_name"))->addSelect('author_of_academicworks.author_type');
            }
        ])->get()->toArray();


        //return gettype(array($p));
        $tags = array_map(function ($tag) {
            $t = collect($tag['teacher']);
            $a = collect($tag['author']);
            $aut = $t->concat($a);
            $aut = $aut->sortBy(['author_type', 'asc']);
            //$ids = collect(['First author', 'Co-author', 'Corresponding author']);
            $sorted = $aut->implode('full_name', ', ');
            return array(
                'PId' => $tag['id'],
                'paper_name' => $tag['paper_name'],
                'paper_sourcetitle' => $tag['paper_sourcetitle'],
                'paper_yearpub' => $tag['paper_yearpub'],
                'paper_volume' => $tag['paper_volume'],
                'paper_issue' => $tag['paper_issue'],
                'paper_page' => $tag['paper_page'],
                'paper_doi' => $tag['paper_doi'],
                'author' => $sorted,
                //'author' => $tag['author']->implode('author_name', ', '),
            );
        }, $p);
        //$p = (object) $p;

        $book = array_map(function ($tag) use ($user) {
            return array(
                'PId' => $tag['id'],
                'paper_name' => $tag['ac_name'],
                'paper_sourcetitle' => $tag['ac_sourcetitle'],
                'paper_yearpub' => $tag['ac_year'],
                'paper_page' => $tag['ac_page'],
                'tname' => $user->fname_th . ' ' . $user->lname_th,
                //'author' => $tag['author']->implode('author_name', ', '),
            );
        }, $b);


        $patent = array_map(function ($tag) {
            $t = collect($tag['user']);
            $a = collect($tag['author']);
            $aut = $t->concat($a);
            $aut = $aut->sortBy(['author_type', 'asc']);
            //$ids = collect(['First author', 'Co-author', 'Corresponding author']);
            $sorted = $aut->implode('full_name', ', ');
            return array(
                'PId' => $tag['id'],
                'paper_name' => $tag['ac_name'],
                // 'paper_sourcetitle' => $tag['paper_sourcetitle'],
                'reference_number' => $tag['ac_refnumber'],
                'paper_type' => $tag['ac_type'],

                'patent_date' => Carbon::parse($tag['ac_year'])->thaidate('j F Y'),
                'pname' => $sorted,
                //'author' => $tag['author']->implode('author_name', ', '),
            );
        }, $pat);
        // return $patent;
        //return $patent;
        //return $tags[1]['author'][0]['author_name'];
        //return $tags;
        $templateProcessor = new TemplateProcessor('word-template/CV-CS.docx');
        $templateProcessor->setValue('id', $user->id);
        $templateProcessor->setValue('title_name_th', $user->title_name_th);
        $templateProcessor->setValue('title_name_en', $user->title_name_en);
        $templateProcessor->setValue('fname_en', $user->fname_en);
        $templateProcessor->setValue('lname_en', $user->lname_en);
        $templateProcessor->setValue('fname_th', $user->fname_th);
        $templateProcessor->setValue('lname_th', $user->lname_th);
        $templateProcessor->setValue('position_th', $user->academic_ranks_th);
        if (isset($u1->qua_name)) {
            $templateProcessor->setValue('qua_name1', $u1->qua_name);
            $templateProcessor->setValue('uname1', $u1->uname);
            $templateProcessor->setValue('year1', $u1->year);
        } else {
            $templateProcessor->setValue('qua_name1',  null);
            $templateProcessor->setValue('uname1', null);
            $templateProcessor->setValue('year1', null);
        }

        if (isset($u2->qua_name)) {

            $templateProcessor->setValue('qua_name2', $u2->qua_name);
            $templateProcessor->setValue('uname2', $u2->uname);
            $templateProcessor->setValue('year2', $u2->year);
        } else {
            $templateProcessor->setValue('qua_name2',  null);
            $templateProcessor->setValue('uname2', null);
            $templateProcessor->setValue('year2', null);
        }

        if (isset($u3->qua_name)) {
            $templateProcessor->setValue('qua_name3', $u3->qua_name);
            $templateProcessor->setValue('uname3', $u3->uname);
            $templateProcessor->setValue('year3', $u3->year);
        } else {
            $templateProcessor->setValue('qua_name3',  null);
            $templateProcessor->setValue('uname3', null);
            $templateProcessor->setValue('year3', null);
        }

        // $templateProcessor->setValue('qua_name1', $u1->qua_name);
        // $templateProcessor->setValue('uname1', $u1->uname);
        //$templateProcessor->setValue('year1', $u1->year);
        // $templateProcessor->setValue('qua_name2', $u2->qua_name);
        // $templateProcessor->setValue('uname2', $u2->uname);
        // $templateProcessor->setValue('year2', $u2->year);
        // $templateProcessor->setValue('qua_name3', $u3->qua_name);
        // $templateProcessor->setValue('uname3', $u3->uname);
        // $templateProcessor->setValue('year3', $u3->year);
        $templateProcessor->setValue('email', $user->email);
        $templateProcessor->setValue('from', $from + 543);
        $templateProcessor->setValue('to', $to + 543);
        //$templateProcessor->setValues(array($p));

        //$templateProcessor->cloneRowAndSetValues('userId', $p);
        $templateProcessor->cloneRowAndSetValues('author', $tags);
        $templateProcessor->cloneRowAndSetValues('tname', $book);
        $templateProcessor->cloneRowAndSetValues('pname', $patent);

        $fileName = $user->fname_en;
        $templateProcessor->saveAs('CV-CS-' . $fileName . '.docx');
        return response()->download('CV-CS-' . $fileName . '.docx')->deleteFileAfterSend(true);
    }
}
