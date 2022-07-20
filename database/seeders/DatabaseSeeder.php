<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {      
        $this->call(VaccinesSeeder::class);        
        $this->call(UsersSeeder::class);
        $this->call(PetsSeeder::class);        
        $this->call(PetVaccineSeeder::class);            
    }
}
