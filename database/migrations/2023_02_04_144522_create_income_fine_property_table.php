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
        Schema::create('income_fine_property', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('income_id');
            $table->foreign('income_id')->references('id')->on('incomes')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('fine_id')->nullable();
            $table->foreign('fine_id')->references('id')->on('fines')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('income_fine_property');
    }
};
