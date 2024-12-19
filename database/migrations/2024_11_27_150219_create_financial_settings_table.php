<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('financial_settings', function (Blueprint $table) {
            $table->id();
            $table->string('financial_year');
            $table->json('da_amount')->nullable();
            $table->decimal('cca_amount', 10, 2);
            $table->decimal('ma_amount', 10, 2);
            $table->decimal('sfa', 10, 2);
            $table->decimal('hra_rural', 10, 2);
            $table->decimal('hra_city', 10, 2);
            $table->decimal('hra_metro', 10, 2);
            $table->decimal('other_allowance', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financial_settings');
    }
}
