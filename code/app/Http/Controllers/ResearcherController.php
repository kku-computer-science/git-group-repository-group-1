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
        // ตัวอย่าง: ดึงข้อมูล Program ที่ degree_id = 1 พร้อมกับ users
        // (ส่วนนี้จะส่งไปยังหน้า researchers.blade.php ถ้าต้องการแสดงในหน้า index)
        $programs = Program::with(['users' => function ($query) {
            $query->role('teacher')->with('expertise');
        }])->where('degree_id', '=', 1)->get();

        // ตัวอย่าง: ดึง user ทั้งหมด (หรือตามต้องการ)
        $users = User::role('teacher')->with('expertise')->get();

        // ส่งตัวแปร $programs และ $users ไปยัง view researchers.blade.php
        return view('researchers', compact('programs', 'users'));
    }

    public function request($id)
    {
        // รวบรวม users จากหลายเงื่อนไข
        $user1 = User::role('teacher')
            ->where('position_th', 'ศ.ดร.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->orderBy('fname_en')
            ->get();

        $user2 = User::role('teacher')
            ->where('position_th', 'รศ.ดร.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->orderBy('fname_en')
            ->get();

        $user3 = User::role('teacher')
            ->where('position_th', 'ผศ.ดร.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->orderBy('fname_en')
            ->get();

        $user4 = User::role('teacher')
            ->where('position_th', 'ศ.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->orderBy('fname_en')
            ->get();

        $user5 = User::role('teacher')
            ->where('position_th', 'รศ.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->orderBy('fname_en')
            ->get();

        $user6 = User::role('teacher')
            ->where('position_th', 'ผศ.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->orderBy('fname_en')
            ->get();

        $user7 = User::role('teacher')
            ->where('position_th', 'อ.ดร.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->orderBy('fname_en')
            ->get();

        $user8 = User::role('teacher')
            ->where('position_th', 'อ.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->orderBy('fname_en')
            ->get();

        // รวม user ทุกกลุ่มเป็น Collection เดียว
        $users = collect(array_merge(
            $user1->toArray(),
            $user4->toArray(),
            $user2->toArray(),
            $user5->toArray(),
            $user3->toArray(),
            $user6->toArray(),
            $user7->toArray(),
            $user8->toArray()
        ));

        // ดึงข้อมูล Program ตาม id ที่ส่งเข้ามา
        // จะได้เป็น Eloquent Collection ของ Model Program
        $programs = Program::where('id', '=', $id)->get();

        // ส่งไปที่ view researchers.blade.php
        // เปลี่ยนชื่อเป็น programs เพื่อไม่ให้ชนกับ Request ของ Laravel
        return view('researchers', compact('programs', 'users'));
    }

    // ฟังก์ชัน searchs() ใช้ค้นหาตามความเชี่ยวชาญ (expertise)
    public function searchs($id, $text)
    {
        $user1 = User::role('teacher')
            ->where('position_th', 'ศ.ดร.')
            ->with(['program','expertise'])
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->whereHas('expertise', function($q) use($text){
                $q->where('expert_name', 'LIKE', "%{$text}%");
            })
            ->orderBy('fname_en')
            ->get();

        $user2 = User::role('teacher')
            ->where('position_th', 'รศ.ดร.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->whereHas('expertise', function($q) use($text){
                $q->where('expert_name', 'LIKE', "%{$text}%");
            })
            ->orderBy('fname_en')
            ->get();

        $user3 = User::role('teacher')
            ->where('position_th', 'ผศ.ดร.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->whereHas('expertise', function($q) use($text){
                $q->where('expert_name', 'LIKE', "%{$text}%");
            })
            ->orderBy('fname_en')
            ->get();

        $user4 = User::role('teacher')
            ->where('position_th', 'ศ.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->whereHas('expertise', function($q) use($text){
                $q->where('expert_name', 'LIKE', "%{$text}%");
            })
            ->orderBy('fname_en')
            ->get();

        $user5 = User::role('teacher')
            ->where('position_th', 'รศ.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->whereHas('expertise', function($q) use($text){
                $q->where('expert_name', 'LIKE', "%{$text}%");
            })
            ->orderBy('fname_en')
            ->get();

        $user6 = User::role('teacher')
            ->where('position_th', 'ผศ.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->whereHas('expertise', function($q) use($text){
                $q->where('expert_name', 'LIKE', "%{$text}%");
            })
            ->orderBy('fname_en')
            ->get();

        $user7 = User::role('teacher')
            ->where('position_th', 'อ.ดร.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->whereHas('expertise', function($q) use($text){
                $q->where('expert_name', 'LIKE', "%{$text}%");
            })
            ->orderBy('fname_en')
            ->get();

        $user8 = User::role('teacher')
            ->where('position_th', 'อ.')
            ->with('program')
            ->whereHas('program', function($q) use($id){
                $q->where('id', '=', $id);
            })
            ->whereHas('expertise', function($q) use($text){
                $q->where('expert_name', 'LIKE', "%{$text}%");
            })
            ->orderBy('fname_en')
            ->get();

        // รวม user ทุกกลุ่ม
        $users = collect(array_merge(
            $user1->toArray(),
            $user2->toArray(),
            $user3->toArray(),
            $user4->toArray(),
            $user5->toArray(),
            $user6->toArray(),
            $user7->toArray(),
            $user8->toArray()
        ));

        // ดึง Program ตาม id
        $programs = Program::where('id', '=', $id)->get();

        // ส่งไปที่ view researchers.blade.php
        return view('researchers', compact('programs', 'users'));
    }

    // ฟังก์ชัน search() รับ Request และส่งต่อไปยัง searchs()
    public function search($id, Request $req)
    {
        // ดึงค่าที่ส่งมาจาก input ชื่อ textsearch
        $textsearch = $req->textsearch;

        // เรียกใช้ฟังก์ชัน searchs() ด้านบน
        return $this->searchs($id, $textsearch);
    }
}