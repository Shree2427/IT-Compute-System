<?php
// database/migrations/xxxx_xx_xx_create_employees_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->string('pan')->unique();
            $table->decimal('basic_salary', 10, 2);
            $table->enum('location_type', ['rural', 'city', 'metro']);
            $table->decimal('pt', 10, 2)->default(0); // Professional Tax
            $table->decimal('lic', 10, 2)->default(0); // Life Insurance Contribution
            $table->decimal('gpf', 10, 2)->default(0); // Family Benefit Fund
            $table->date('increment_month')->nullable(); // Month when increment happens
            $table->decimal('increment_amount', 10, 2)->default(0); // Increment amount
            $table->date('payscale_change_month')->nullable(); // Pay scale change month
            $table->string('new_pay_scale')->nullable(); // New pay scale
            $table->decimal('new_basic_salary', 10, 2)->default(0); // New basic salary after pay scale change
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
