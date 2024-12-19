<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = [
        'tan',
        'name_of_institute',
        'city',
        'pincode',
        'name_of_ddo',
        'designation',
        'employer_pan',
    ];
}
