<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Degree;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::paginate(10);
        //return $programs;
		return view('courses.index',compact('courses'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'course_code' => 'required',
            'course_name' => 'required',
        ]);

        $courseId = $request->course_id;
        $course = Course::find($courseId);
        $degree = Degree::find(2);
        //$course=Course::updateOrCreate(['id' => $courseId], ['course_code' => $request->course_code, 'course_name' => $request->course_name]);
        
        $degree->course()->updateOrCreate(['id' => $courseId], ['course_code' => $request->course_code, 'course_name' => $request->course_name]);
    
        
        if (empty($request->pro_id))
            $msg = 'Customer entry created successfully.';
        else
            $msg = 'Customer data is updated successfully';
        return redirect()->route('courses.index')->with('success', $msg);

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
		$course = Course::where($where)->first();
		return response()->json($course);
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
        $course = Course::where('id', $id)->delete();
        return response()->json($course);
    }
}
