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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('building_name', 120);
            $table->string('address')->nullable();
            $table->integer('building_number')->nullable();
            $table->string('email',70)->nullable();
            $table->string('application_logo_path')->nullable();
            $table->text('welcome_message')->nullable();

            $table->unsignedBigInteger('departament_id')->nullable();
            $table->foreign('departament_id')->references('id')->on('departaments')->onUpdate('cascade')->onDelete('set null');            

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
        Schema::dropIfExists('settings');
    }
};
