<?php

namespace App\Http\Controllers;

use App\Category;
use App\Models\Department;
use App\Models\Product;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class TestController extends Controller
{
  public function index(Request $request)
  {
      /*if ($request->ajax()) {
          $data = User::select('*');
          return DataTables::of($data)
                  ->addIndexColumn()
                  ->addColumn('action', function($row){
   
                         $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
  
                          return $btn;
                  })
                  ->rawColumns(['action'])
                  ->make(true);
      }*/
      $departments = Department::all();
      
      return view('createpaper',compact('departments'));
  }

    public function update($id)
    {
    	$category = Product::find($id);

	    return response()->json([
	      'data' => $category
	    ]);
    }

    public function getCategory($department_id)
    {
        $data = Program::where('department_id',$department_id)->get();
        //Log::info($data);
        return response()->json(['data' => $data]);
    }
}

