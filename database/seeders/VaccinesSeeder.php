<?php

namespace Database\Seeders;

use App\Models\Vaccines;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vaccines::create([
            'name'=>'rabia'
        ]);
        Vaccines::create([
            'name'=>'Parvo'
        ]);
    }
}
