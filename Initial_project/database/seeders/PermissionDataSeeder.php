<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name'=> 'readResearchProject',	
            'guard_name'=> 'web'
        ]);
        Permission::create([
            'name'=> 'addResearchProject',	
            'guard_name'=> 'web'
        ]);
        Permission::create([
            'name'=> 'editResearchProject',	
            'guard_name'=> 'web'
        ]);
        Permission::create([
            'name'=> 'deleteResearchProject',	
            'guard_name'=> 'web'
        ]);
        
    }
}
