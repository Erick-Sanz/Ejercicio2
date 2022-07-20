<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PetVaccineController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccineController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


Route::group(['middleware'=> ['auth:sanctum']], function () {
    Route::post('/logout',[AuthController::class,'logout']);
    
    Route::get('vaccines/{id}',[VaccineController::class,'show']);
    Route::get('pets/{id}',[PetController::class,'show']);
    Route::get('users/{id}',[UserController::class,'show']);
    Route::post('petvaccine', [PetVaccineController::class,'join' ]);
    
    Route::resource('vaccines', VaccineController::class );
    Route::resource('pets', PetController::class );
    Route::resource('users', UserController::class );
});

