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
        Schema::create('extraordinary_fee_property', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedBigInteger('extraordinary_fee_id');
            $table->foreign('extraordinary_fee_id')->references('id')->on('extraordinary_fees')->onUpdate('cascade')->onDelete('cascade');
           
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('extraordinary_fee_property');
    }
};
