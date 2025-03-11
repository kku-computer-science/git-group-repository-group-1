<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ExportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:export')->only('index');
        // Redirect::to('dashboard')->send();
         
    }
    public function index()
    {
        $data = User::role('teacher')->get();
        //return $data;
        return view('export.index', compact('data'));
    }
}
