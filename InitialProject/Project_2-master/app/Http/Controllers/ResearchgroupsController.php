<?php

namespace App\Http\Controllers;
use App\Models\ResearchGroup;
use Illuminate\Http\Request;

class ResearchgroupsController extends Controller
{
    public function index()
    {
        $resg = ResearchGroup::with('User')->orderBy('group_name_en')->get();
        return view('research_g',compact('resg'));
    }
}
