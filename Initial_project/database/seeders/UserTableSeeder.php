<?php

namespace Database\Seeders;


use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['fname'=> 'wat',
        'lname'=> 'sri',
        'position'=> 'Assoc.Prof.Dr.', 
        'email' => 'adminsccs@gmail.com',
        'picture' => 'null',
        'password' => Hash::make('12345678')];
        
        $user = User::create([
            'fname'=> 'wat',
            'lname'=> 'sri',
            'position'=> 'Assoc.Prof.Dr.', 
            'email' => 'adminsccs@gmail.com',
            'picture' => 'null',
            'password' => Hash::make('12345678')
        ]);
         
        $role = Role::find(1);   

        $permissions = Permission::pluck('id', 'id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}