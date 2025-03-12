<?php
   
namespace App\Imports;

use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;  

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $program = Program::find($row['program_id']);
        //return $program;
        $user = User::create([
            // 'fname_en'     => $row['fname_en'],
            // 'lname_en'     => $row['lname_en'],
            'fname_th'     => $row['fname_th'],
            'fname_th'     => $row['fname_th'],
            'lname_th'     => $row['lname_th'],
            'username'    => $row['stdid'], 
            'password' => Hash::make($row['stdid']),
            'program_id'=> $row['program_id'],
        ])->assignRole('student');
        //$user->assignRole($request->roles);*/
        //dd($row);
    }
}