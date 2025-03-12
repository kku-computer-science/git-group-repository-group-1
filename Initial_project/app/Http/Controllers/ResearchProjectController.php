<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\ResearchProject;
use App\Models\User;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Log;
use App\Models\Fund;
use App\Models\Outsider;

class ResearchProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id = auth()->user()->id;
        if (auth()->user()->HasRole('admin')) {
            $researchProjects = ResearchProject::with('User')->get();
        } elseif (auth()->user()->HasRole('headproject')) {
            $researchProjects = ResearchProject::with('User')->get();
        } elseif (auth()->user()->HasRole('staff')) {
            $researchProjects = ResearchProject::with('User')->get();
        } else {
            $researchProjects = User::find($id)->researchProject()->get();
            //$researchProjects=User::find($id)->researchProject()->latest()->paginate(5);

            //$researchProjects = ResearchProject::with('User')->latest()->paginate(5);
        }
        //dd($id);
        //$researchProjects = ResearchProject::latest()->paginate(5);
        //$researchProjects = ResearchProject::with('User')->latest()->paginate(5);
        //return $researchProjects;

        return view('research_projects.index', compact('researchProjects'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::role(['teacher', 'student'])->get();
        $funds = Fund::get();
        $deps = Department::get();
        return view('research_projects.create', compact('users', 'funds', 'deps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'project_name' => 'required',
                'budget' => 'required|numeric',
                'project_year' => 'required',
                'fund' => 'required',
                //'note' => 'required',
                'head' => 'required'
            ],

            [
                'project_name.required' => 'ต้องใส่ข้อมูล ชื่อโครงการวิจัย',
                'budget.required' => 'ต้องใส่ข้อมูล งบประมาณ',
                'project_year.required' => 'ต้องใส่ข้อมูล ปีที่ปีที่ยื่นขอ',
                'fund.required' => 'ต้องใส่ข้อมูล ทุนวิจัย',
                'head.required' => 'ต้องใส่ข้อมูล ผู้รับผิดชอบโครงการ',
            ]
        );
        //return $request->fund; 
        $fund = Fund::find($request->fund);
        $req = $request->all();
        //return $req;
        //$req['project_year'] = $req['project_year'] - 543;

        $researchProject = $fund->researchProject()->Create($req);
        //$researchProject = $fund->researchProject()->save($fund);
        //$fund = $request->fund;
        //$researchProject = ResearchProject::create($request->all());

        //$researchProject->fund()->create($fund);

        $head = $request->head;
        $researchProject->user()->attach($head, ['role' => 1]);
        //$user=auth()->user();
        //$user=User::find($head);
        //$user->givePermissionTo('editResearchProject','deleteResearchProject');


        if (isset($request->moreFields)) {
            foreach ($request->moreFields as $key => $value) {
                //dd($value);
                if ($value['userid'] != null) {
                    $researchProject->user()->attach($value, ['role' => 2]);
                }
                //$user->givePermissionTo('readResearchProject');
            }
        }
        $input = $request->except(['_token']);
        //$x = 1;
        //return isset($input['fname']);
        //$length = count($request->input('fname'));
        if (isset($input['fname'][0]) and (!empty($input['fname'][0]))){
            foreach ($request->input('fname') as $key => $value) {
                $data['fname'] = $input['fname'][$key];
                $data['lname'] = $input['lname'][$key];
                $data['title_name'] = $input['title_name'][$key];

                if (Outsider::where('fname', '=', $data['fname'])->orWhere('lname', '=', $data['lname'])->first() == null) {
                    $author = new Outsider;
                    $author->fname = $data['fname'];
                    $author->lname = $data['lname'];
                    $author->title_name = $data['title_name'];
                    $author->save();
                    $researchProject->outsider()->attach($author, ['role' => 2]);
                } else {
                    $author = Outsider::where('fname', '=', $data['fname'])->orWhere('lname', '=', $data['lname'])->first();
                    $authorid = $author->id;
                    $researchProject->outsider()->attach($authorid, ['role' => 2]);
                }
                //$x++;
            }
        }


        //$user = User::find(auth()->user()->id);
        //$user->researchProject()->attach(2);

        return redirect()->route('researchProjects.index')->with('success', 'research projects created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResearchProject  $researchProject
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchProject $researchProject)
    {
        return view('research_projects.show', compact('researchProject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResearchProject  $researchProject
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchProject $researchProject)
    {

        $researchProject = ResearchProject::find($researchProject->id);
        $this->authorize('update', $researchProject);
        $researchProject = ResearchProject::with(['user'])->where('id', $researchProject->id)->first();


        $users = User::role(['teacher', 'student'])->get();
        $funds = Fund::get();
        $deps = Department::get();
        return view('research_projects.edit', compact('researchProject', 'users', 'funds', 'deps'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResearchProject  $researchProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResearchProject $researchProject)
    {

        $request->validate(
            [
                //'project_name' => 'required|max:200',
                'project_name' => 'required',
                'budget' => 'required|numeric',
                'project_year' => 'required',
                'fund' => 'required',
                //'note' => 'required',
                'head' => 'required'
            ],
            [
                'project_name.required' => 'ต้องใส่ข้อมูล ชื่อโครงการวิจัย',
                'budget.required' => 'ต้องใส่ข้อมูล งบประมาณ',
                'project_year.required' => 'ต้องใส่ข้อมูล ปีที่ปีที่ยื่นขอ',
                'fund.required' => 'ต้องใส่ข้อมูล ทุนวิจัย',
                'head.required' => 'ต้องใส่ข้อมูล ผู้รับผิดชอบโครงการ',

            ]
        );
        $researchProject = ResearchProject::find($researchProject->id);
        $this->authorize('update', $researchProject);
        $req = $request->all();
        //$req['project_year'] = $req['project_year'] - 543;
        $researchProject->update($req);
        $head = $request->head;
        //$researchProject->user()->detach($head);
        //dd($researchProject->user()->get());
        $researchProject->user()->detach();
        $researchProject->user()->attach(array(
            $head => array('role' => 1),
        ));
        //$researchProject->user()->attach($head,['role' => 1]);

        //$researchProject->update($this->validatePost());
        if (isset($request->moreFields)) {
            foreach ($request->moreFields as $key => $value) {
                //dd($value);
                if ($value['userid'] != null) {
                    $researchProject->user()->attach($value, ['role' => 2]);
                }
                //$user->givePermissionTo('readResearchProject');
            }
        }
        $input = $request->except(['_token']);
        //$x = 1;
        //$length = count($request->input('fname'));
        $researchProject->outsider()->detach();
        if (isset($input['fname'][0]) and (!empty($input['fname'][0]))){
            foreach ($request->input('fname') as $key => $value) {
                $data['fname'] = $input['fname'][$key];
                $data['lname'] = $input['lname'][$key];
                $data['title_name'] = $input['title_name'][$key];

                if (Outsider::where([['fname', '=', $data['fname']],['lname', '=', $data['lname']]])->first() == null) {
                    $author = new Outsider;
                    $author->fname = $data['fname'];
                    $author->lname = $data['lname'];
                    $author->title_name = $data['title_name'];
                    $author->save();
                    $researchProject->outsider()->attach($author, ['role' => 2]);
                } else {
                    $author = Outsider::where([['fname', '=', $data['fname']],['lname', '=', $data['lname']]])->first();
                    $authorid = $author->id;
                    $researchProject->outsider()->attach($authorid, ['role' => 2]);
                }
                //$x++;
            }
        }
        return redirect()->route('researchProjects.index')
            ->with('success', 'Research Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResearchProject  $researchProject
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchProject $researchProject)
    {

        $this->authorize('delete', $researchProject);
        $researchProject->delete();
        return redirect()->route('researchProjects.index')
            ->with('success', 'Research Project deleted successfully');
    }
}
