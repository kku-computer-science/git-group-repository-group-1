<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Department;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\Environment\Console;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:programs-list|programs-create|programs-edit|programs-delete', ['only' => ['index','store']]);
         $this->middleware('permission:programs-create', ['only' => ['create','store']]);
         $this->middleware('permission:programs-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:programs-delete', ['only' => ['destroy']]);
         //Redirect::to('dashboard')->send();
    }

    public function index()
    {
        $programs = Program::all();
        $degree = Degree::all();
        $department = Department::all();
        //return $programs;
        return view('programs.index', compact('programs', 'degree', 'department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $r = $request->validate([
            'program_name_th' => 'required',
            'program_name_en' => 'required',
            'degree' => 'required',
            'department' => 'required',

        ]);

        $proId = $request->pro_id;
        $pro = Program::find($proId);
        $degree = Degree::find($request->degree);
        $department = Department::find($request->department);

        //return $degree;
        //$degree -> program() -> sync($pro);
        if (!$pro) {
            $pro2 = new Program;
            //$pro2->department()->associate($department);
            //$pro2->degree()->associate($degree);
            $pro2 = $pro2->degree()->associate($degree);
            $pro2 = $pro2->department()->associate($department);

            $pro2->program_name_en = $request->program_name_en;
            $pro2->program_name_th = $request->program_name_th;
            $pro2->save();
            //$pro2::Create(['program_name_en' => $request->program_name_en, 'program_name_th' => $request->program_name_th]);
            //$pro2->department()->associate($department);
            // $pro2 = $pro2->department()->save($department);
            // $pro2 = $pro2->degree()->save($degree);


            //$pro2->degree()->associate($degree)->save();
            //$pro2->department()->associate($department)->save();
            //return $pro;
            //$pro->save();
        } else {
            //$pro->degree()->associate($degree);
            //$pro->comment = "Hi ItSolutionStuff.com";
            $pro = $pro->degree()->associate($degree);
            $pro = $pro->department()->associate($department);
            $pro->save();
            $pro::updateOrCreate(['id' => $proId], ['program_name_en' => $request->program_name_en, 'program_name_th' => $request->program_name_th]);
        
            
        }
        
        //$pro->save();
        //$pro2::updateOrCreate(['id' => $proId], ['program_name_en' => $request->program_name_en, 'program_name_th' => $request->program_name_th]);
        

        if (empty($request->pro_id))
            $msg = 'Program entry created successfully.';
        else
            $msg = 'Program data is updated successfully';
        return redirect()->route('programs.index')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $pro = Program::where($where)->first();
        return response()->json($pro);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pro = Program::where('id', $id)->delete();
        return response()->json($pro);
    }
}
