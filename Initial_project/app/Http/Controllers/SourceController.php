<?php

namespace App\Http\Controllers;

use App\Models\Source_data;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sources = Source_data::paginate(4);
        //return $sources;
		return view('source_data.index',compact('sources'))->with('i', (request()->input('page', 1) - 1) * 4);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $r=$request->validate([
            'source_name' => 'required',

            ]);
    
            $source_id = $request->source_id;
            //dd($custId);
            
            Source_data::updateOrCreate(['id' => $source_id],['source_name' => $request->source_name]);
            if(empty($request->source_id))
                $msg = 'Source Data entry created successfully.';
            else
                $msg = 'Source Data is updated successfully';
            return redirect()->route('sources.index')->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('sources.show',compact('source'));
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
		$sour = Source_data::where($where)->first();
		return response()->json($sour);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
