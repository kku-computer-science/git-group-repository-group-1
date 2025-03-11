<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            SourceDataSeeder::class,
            UserTableSeeder::class,
            //PermissionDataSeeder::class,
            UserSeeder::class
        ]);
        /*User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'favoriteColor' => 'blue',
            'picture' => 'null',
            'password' => Hash::make('12345678'),
            'role' => 1
        ]);
        User::create([
            'name' => 'Teacher',
            'email' => 'teacher@test.com',
            'favoriteColor' => 'blue',
            'picture' => 'null',
            'password' => Hash::make('12345678'),
            'role' => 3
        ]);
        User::create([
            'name' => 'Student',
            'email' => 'student@test.com',
            'favoriteColor' => 'blue',
            'picture' => 'null',
            'password' => Hash::make('12345678'),
            'role' => 2
        ]);*/
    }
}
