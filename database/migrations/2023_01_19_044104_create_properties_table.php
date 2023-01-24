<?php

use App\Models\Property;
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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10); //códígo único para identificar la inmueble. Por ejemplo 4C
            $table->text('description')->nullable();
            $table->double('monthly_rate',6,2, true);
            $table->double('area',8,2, true)->nullable();
            $table->enum('property_type', [Property::DEPARTAMENTO, Property::LOCAL_COMERCIAL]);
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
        Schema::dropIfExists('properties');
    }
};
