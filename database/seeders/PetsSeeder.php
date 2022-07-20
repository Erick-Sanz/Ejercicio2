<?php

namespace Database\Seeders;
use App\Models\Pets;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pets::create([
            'name'=>'Wini',
            'age'=>2,
            'user_id'=>1,
        ]);
        Pets::create([
            'name'=>'Bamby',
            'age'=>2,
            'user_id'=>1,
        ]);
    }
}
