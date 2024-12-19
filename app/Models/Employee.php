<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_name', 'pan', 'basic_salary', 'location', 'financial_year', 
        'pt', 'lic', 'gpf', 'increment_month', 'increment_amount', 'pay_scale', 
        'payscale_change_month', 'payband', 'new_pay_scale', 'new_basic_salary',
        'employer_id',
    ];
 // Relationship with the Employer model
 public function employer()
 {
     return $this->belongsTo(Employer::class); // An employee belongs to an employer
 }
    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }
}
