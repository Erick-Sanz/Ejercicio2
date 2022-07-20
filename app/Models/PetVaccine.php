<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetVaccine extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'pet_id',
        'vaccine_id',
    ];
}
