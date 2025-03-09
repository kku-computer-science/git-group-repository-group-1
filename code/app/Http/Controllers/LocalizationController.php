<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Models\ResearchGroup;
use App\Models\ResearchProject;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function index()
    {
        $resp = ResearchGroup:: all();
        return view('welcome',compact('resp'));
       // return view('welcome');
    }
    public function switchLang($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }
        return redirect()->back();
    }
}