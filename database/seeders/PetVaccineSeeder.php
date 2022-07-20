<?php

namespace Database\Seeders;

use App\Models\PetVaccine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetVaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PetVaccine::create([
            'pet_id'=>1,
            'vaccine_id'=>1
        ]);
        PetVaccine::create([
            'pet_id'=>1,
            'vaccine_id'=>2
        ]);
        PetVaccine::create([
            'pet_id'=>2,
            'vaccine_id'=>1
        ]);
    }
}
