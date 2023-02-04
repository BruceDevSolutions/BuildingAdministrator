<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_expense_property', function (Blueprint $table) {
            $table->id();

            $table->date('paid_up_to'); /* Fecha en que se registrará hasta que mes tiene validez el pago */
            $table->string('names', 50); /* Nombres de la persona que realizó el pago */

            $table->unsignedBigInteger('income_id');
            $table->foreign('income_id')->references('id')->on('incomes')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income_expense_property');
    }
};
