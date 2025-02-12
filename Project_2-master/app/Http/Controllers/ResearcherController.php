<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ResearcherController extends Controller
{
    public function index()
    {
        //$reshr = User::role('teacher')->orderBy('department_id')->with('Expertise')->get();
        //$reshr = Department::with(['users' => fn($query) => $query->where('fname', 'like', 'wat%')])->get();
        $reshr = Program::with(['users' => fn ($query) => $query->role('teacher')->with('expertise')])->where('degree_id', '=', 1)->get();
        //$reshr = Department::with('users')->join('expertises', 'id', '=', 'expertises.user_id')->get();


        //return view('researchers',compact('reshr'));
    }
    public function request($id)
    {
        //$res=User::where('id',$id)->with('paper')->get();
        //User::with(['paper'])->where('id',$id)->get();
        //$paper = User::with(['paper','author'])->where('id',$id)->get();
        $user1 = User::role('teacher')->where('position_th', 'ศ.ดร.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        $user2 = User::role('teacher')->where('position_th', 'รศ.ดร.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        $user3 = User::role('teacher')->where('position_th', 'ผศ.ดร.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        $user4 = User::role('teacher')->where('position_th', 'ศ.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        $user5 = User::role('teacher')->where('position_th', 'รศ.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        $user6 = User::role('teacher')->where('position_th', 'ผศ.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        $user7 = User::role('teacher')->where('position_th', 'อ.ดร.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        $user8 = User::role('teacher')->where('position_th', 'อ.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->orderBy('fname_en')->get();
        
        $users = collect([...$user1, ...$user4, ...$user2, ...$user5, ...$user3, ...$user6, ...$user7, ...$user8]);
        //return $users;
        // $request = Program::with(['users' => fn($query) => 
        // //$query->role('teacher')->orderByRaw("FIELD(position_en , 'Prof. Dr.' as 1, 'Assoc. Prof. Dr.' as 2, 'Asst. Prof. Dr.' as 3,'Assoc. Prof.' as 4, 'Asst. Prof.' as 5, 'Dr.' as 6,'Lecturer' as 7) ASC")
        // $query->role('teacher')->orderByRaw("FIELD(position_en , 'Prof. Dr.' , 'Assoc. Prof. Dr.' , 'Asst. Prof. Dr.' ,'Assoc. Prof.' , 'Asst. Prof.' , 'Dr.' ,'Lecturer' )")
        // ->with('expertise')])
        // ->where('degree_id', '=', 1, 'and')->where('id','=',$id)->get();
        $request = Program::where('id','=',$id)->get();
        // $request = Program::with('users')->whereHas('users', function (Builder $query) {
        //     $query->role('teacher')->where('position_en', '==', 'Prof. Dr.');
        //     });
        //return $request;
        //$user = User::orderByRaw("FIELD(position_en , '	Prof. Dr.', 'Assoc. Prof. Dr.', 'Asst. Prof. Dr.','Assoc. Prof.', 'Asst. Prof.', 'Dr.','Lecturer') ASC");
        //return $request;
        return view('researchers', compact('request','users'));
    }
    public function searchs($id,$text){
        //return $text;
        $user1 = User::role('teacher')->where('position_th', 'ศ.ดร.')->with(['program','expertise'])->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->whereHas('expertise', function($q) use($text){
            $q->where('expert_name', 'LIKE', "%{$text}%");
        })->orderBy('fname_en')->get();
        $user2 = User::role('teacher')->where('position_th', 'รศ.ดร.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->whereHas('expertise', function($q) use($text){
            $q->where('expert_name', 'LIKE', "%{$text}%");
        })->orderBy('fname_en')->get();
        $user3 = User::role('teacher')->where('position_th', 'ผศ.ดร.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->whereHas('expertise', function($q) use($text){
            $q->where('expert_name', 'LIKE', "%{$text}%");
        })->orderBy('fname_en')->get();
        $user4 = User::role('teacher')->where('position_th', 'ศ.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->whereHas('expertise', function($q) use($text){
            $q->where('expert_name', 'LIKE', "%{$text}%");
        })->orderBy('fname_en')->get();
        $user5 = User::role('teacher')->where('position_th', 'รศ.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->whereHas('expertise', function($q) use($text){
            $q->where('expert_name', 'LIKE', "%{$text}%");
        })->orderBy('fname_en')->get();
        $user6 = User::role('teacher')->where('position_th', 'ผศ.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->whereHas('expertise', function($q) use($text){
            $q->where('expert_name', 'LIKE', "%{$text}%");
        })->orderBy('fname_en')->get();
        $user7 = User::role('teacher')->where('position_th', 'อ.ดร.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->whereHas('expertise', function($q) use($text){
            $q->where('expert_name', 'LIKE', "%{$text}%");
        })->orderBy('fname_en')->get();
        $user8 = User::role('teacher')->where('position_th', 'อ.')->with('program')->whereHas('program', function($q) use($id){
            $q->where('id', '=', $id);
        })->whereHas('expertise', function($q) use($text){
            $q->where('expert_name', 'LIKE', "%{$text}%");
        })->orderBy('fname_en')->get();

        $users = collect([...$user1, ...$user2, ...$user3, ...$user4, ...$user5, ...$user6, ...$user7, ...$user8]);

        $request = Program::where('id','=',$id)->get();

        return view('researchers', compact('request','users'));
    }
    public function search($id,Request $request){
        $request = $request->textsearch;
        $a = $this->searchs($id,$request);
        return $a;
    }
}