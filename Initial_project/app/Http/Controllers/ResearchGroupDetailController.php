<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Paper;
use App\Models\ResearchGroup;
use Illuminate\Http\Request;

class ResearchGroupDetailController extends Controller
{
    public function request($id)
    {
        $resgd = ResearchGroup::with(['User.paper' => function ($query) {
            return $query->orderBy('paper_yearpub','DESC');
        }])->where('id','=',$id)->get();

        //return $resgd;
        // $std = ResearchGroup::hasRole('student')::with(['User.paper' => function ($query) {
        //     return $query->orderBy('paper_yearpub','DESC');
        // }])->where('id','=',$id)->get();
        // $ref = $resgd[0]->user[1]->fname_en;
        // $rel = $resgd[0]->user[1]->lname_en;
        // $author = Author::where([['author_fname', '=', $ref], ['author_lname', '=', $rel]])->get();
        //return  $author;

        // $author = Paper::whereHas('author', function($q){
        //     $q->where('author_fname', '=', 'Pongsathon');
        // })->get();
        // $author = collect($author);
        //return  $author;

        return view('researchgroupdetail', compact('resgd'));
        //return $resgd;

    }
}
