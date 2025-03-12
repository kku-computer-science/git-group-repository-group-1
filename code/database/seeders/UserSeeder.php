<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
            'fname'=> 'Ngamnij',
            'lname'=> 'Arch-int',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'ngamnij@kku.ac.th',
            'password' => Hash::make('123456789'),
            'picture' => 'Ngamnij.jpg',
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Chakchai',
            'lname'=> 'So-In',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'chakso@kku.ac.th',
            'password' => Hash::make('123456789'),
            'picture' => 'Chakchai.jpg',
        ])->assignRole(2);
        User::create([
            'fname'=> 'Somjit',
            'lname'=> 'Arch-int',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'somjit@kku.ac.th',
            'picture' => 'Somjit.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Chaiyapon',
            'lname'=> 'Keeratikasikorn',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'chaiyapon@kku.ac.th',
            'picture' => 'Chaiyapon.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Punyaphol',
            'lname'=> 'Horata',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'punhor1@kku.ac.th',
            'picture' => 'Punyaphol.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Sartra',
            'lname'=> 'Wongthanavasu',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'wongsar@kku.ac.th',
            'picture' => 'Sartra.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Sirapat',
            'lname'=> 'Chiewchanwattana',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'sunkra@kku.ac.th',
            'picture' => 'Sirapat.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        
        User::create([
            'fname'=> 'Khamron',
            'lname'=> 'Sunat',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'skhamron@kku.ac.th',
            'picture' => ' Khamron.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Chitsutha',
            'lname'=> 'Soomlek',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'chitsutha@kku.ac.th',
            'picture' => 'Chitsutha.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Nagon',
            'lname'=> 'Watanakij',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'nagon@kku.ac.th',
            'picture' => 'Nagon.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Boonsup',
            'lname'=> 'Waikham',
            'position'=> 'Assoc.Prof.',
            'email' => 'Boonsup@kku.ac.th',
            'picture' => 'Boonsup.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Paweena',
            'lname'=> 'Wanchai',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'wpaweena@kku.ac.th',
            'picture' => 'Paweena.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Pipat',
            'lname'=> 'Reungsang',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'reungsang@kku.ac.th',
            'picture' => 'Pipat.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Pusadee',
            'lname'=> 'Seresangtakul',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'pusadee@kku.ac.th',
            'picture' => 'Pusadee.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Monlica',
            'lname'=> 'Wattana',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'monlwa@kku.ac.th',
            'picture' => 'Monlica.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Wararat',
            'lname'=> 'Songpan',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'wararat@kku.ac.th',
            'picture' => 'Wararat.jpg',
            'password' => Hash::make('123456789'),
             

        ])->assignRole(2);
        User::create([
            'fname'=> 'Sunti',
            'lname'=> 'Tintanai',
            'position'=> 'Assoc.Prof.',
            'email' => 'sunti@kku.ac.th',
            'picture' => 'Sunti.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Saiyan',
            'lname'=> 'Saiyod',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'saiyan@kku.ac.th',
            'picture' => 'Saiyan.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Silada',
            'lname'=> 'Intarasothonchun',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'silain@kku.ac.th',
            'picture' => 'Silada.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Urachart',
            'lname'=> 'Kokaew',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'urachart@kku.ac.th',
            'picture' => 'Urachart.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Urawan',
            'lname'=> 'Chanket',
            'position'=> 'Assoc.Prof.Dr.',
            'email' => 'curawa@kku.ac.th',
            'picture' => 'Urawan.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Phet',
            'lname'=> 'Aimtongkham',
            'position'=> 'Dr.',
            'email' => 'phetim@kku.ac.th',
            'picture' => 'Phet.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);

        User::create([
            'fname'=> 'Wachirawut',
            'lname'=> 'Thamviset',
            'position'=> 'Dr.',
            'email' => 'twachi@kku.ac.th',
            'picture' => 'Wachirawut.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Warunya',
            'lname'=> 'Wunnasri',
            'position'=> 'Dr.',
            'email' => 'waruwu@kku.ac.th',
            'picture' => 'Warunya.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Rapassit',
            'lname'=> 'Chinnapatjee',
            'position'=> 'Dr.',
            'email' => 'rapassit@kku.ac.th',
            'picture' => 'Rapassit.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Sakpod',
            'lname'=> 'Tongleamnak',
            'position'=> 'Dr.',
            'email' => 'sakpod@kku.ac.th',
            'picture' => 'Sakpod.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Thanaphon',
            'lname'=> 'Tangchoopong',
            'position'=> 'Dr.',
            'email' => 'thanaphon@kku.ac.th',
            'picture' => 'Thanaphon.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);

        User::create([
            'fname'=> 'Sarun',
            'lname'=> 'Apichontrakul',
            'position'=> 'Dr.',
            'email' => 'sarunap@kku.ac.th',
            'picture' => 'Sarun.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Rasamee',
            'lname'=> 'Suwanwerakamtorn',
            'position'=> 'Assist.Prof.',
            'email' => 'rasamee@kku.ac.th',
            'picture' => 'Rasamee.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Chanon',
            'lname'=> 'Dechsupa',
            'position'=> 'Dr.',
            'email' => ' chanode@kku.ac.th',
            'picture' => 'Chanode.jpg',
            'password' => Hash::make('123456789'),
             
        ])->assignRole(2);
        User::create([
            'fname'=> 'Praisan',
            'lname'=> 'Padungweang',
            'position'=> 'Dr.',
            'email' => 'praipa@kku.ac.th',
            'picture' => 'Praipa.jpg',
            'password' => Hash::make('223456789'),
             
        ])->assignRole(2);
        
        
    }
}
