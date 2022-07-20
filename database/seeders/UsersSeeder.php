<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Erick',
            'surname'=>'Romero',
             'email'=>'usuario4910@gmail.com',
             'password'=>Hash::make('Erick'),
        ]);
        User::create([
            'name'=>'Juan',
            'surname'=>'Perez',
            'email'=>'Juan@gmail.com',
            'password'=>Hash::make('Juan'),
        ]);    
        User::create([
            'name'=>'Diana',
            'surname'=>'Perez',
            'email'=>'Diana@gmail.com',
            'password'=>Hash::make('Diana'),
        ]);    
    }
}
