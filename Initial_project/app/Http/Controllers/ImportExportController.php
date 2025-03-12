<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\UsersExport;

use App\Imports\UsersImport;

use Maatwebsite\Excel\Facades\Excel;

use App\Models\User;
use Spatie\Permission\Models\Role;
class ImportExportController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
       $roles = Role::pluck('name','name')->all();
       return view('users.import',compact('roles'));
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        $validatedData = $request->validate([

           'file' => 'required',

        ]);



        Excel::import(new UsersImport,$request->file('file'));
        return redirect('importfiles')->with('status', 'The file has been imported in Systems');
        
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export($slug) 
    {
        return Excel::download(new UsersExport, 'users.'.$slug);
    }
   
}