<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Source_data;
class SourceDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Source_data::create([
            'source_name'=> 'Scopus'
        ]);
        Source_data::create([
            'source_name'=> 'Web Of Science'
        ]);
        Source_data::create([
            'source_name'=> 'TCI'
        ]);
    }
}
