<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'funds-list',
            'funds-create',
            'funds-edit',
            'funds-delete',
            'projects-list',
            'projects-create',
            'projects-edit',
            'projects-delete',
            'papers-list',
            'papers-create',
            'papers-edit',
            'papers-delete',
            'groups-list',
            'groups-create',
            'groups-edit',
            'groups-delete',
            'departments-list',
            'departments-create',
            'departments-edit',
            'departments-delete',
        ];

        foreach ($data as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}