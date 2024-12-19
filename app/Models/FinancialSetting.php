<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'financial_year',
        'da_amount',
        'cca_amount',
        'ma_amount',
        'sfa',
        'hra_rural',
        'hra_city',
        'hra_metro',
        'other_allowance',
    ];

    protected $casts = [
        'da' => 'array', // Automatically cast DA to array
    ];
}
