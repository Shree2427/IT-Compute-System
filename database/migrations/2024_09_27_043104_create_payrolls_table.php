<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('payrolls', function (Blueprint $table) {
        $table->id();  // Payroll ID
        $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
        $table->date('pay_date');  // Date of payroll
        $table->decimal('basic_salary', 10, 2);  // Basic salary for this pay period
        $table->decimal('hra', 10, 2);  // House Rent Allowance
        $table->decimal('conveyance_allowance', 10, 2);  // Conveyance Allowance
        $table->decimal('medical_allowance', 10, 2)->nullable();  // Medical Allowance
        $table->decimal('special_allowance', 10, 2)->nullable();  // Special Allowance
        $table->decimal('gross_salary', 10, 2);  // Gross salary before deductions
        $table->decimal('professional_tax', 10, 2)->nullable();  // Professional Tax
        $table->decimal('income_tax', 10, 2)->nullable();  // TDS (Tax Deducted at Source)
        $table->decimal('pf_employee_contribution', 10, 2)->nullable();  // Employee's contribution to PF
        $table->decimal('pf_employer_contribution', 10, 2)->nullable();  // Employer's contribution to PF
        $table->decimal('esic_employee_contribution', 10, 2)->nullable();  // Employee's contribution to ESIC
        $table->decimal('esic_employer_contribution', 10, 2)->nullable();  // Employer's contribution to ESIC
        $table->decimal('other_deductions', 10, 2)->nullable();  // Other deductions like loans, insurance
        $table->decimal('net_salary', 10, 2);  // Net salary after all deductions
        $table->decimal('overtime_hours', 8, 2)->nullable();  // Overtime hours worked (if applicable)
        $table->decimal('overtime_pay', 10, 2)->nullable();  // Pay for overtime hours
        $table->timestamps();  // Created_at, updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
