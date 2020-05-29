<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_libraries', function (Blueprint $table) {
            $table->increments('food_id');
            $table->string('food_name');
            $table->string('food_image');
            $table->string('measurement_type');
            $table->string('food_type');
            $table->float('weigh_g');
            $table->float('energy_kcal');
            $table->float('water_g');
            $table->float('protein_g');
            $table->float('fat_g');
            $table->float('cho_g');
            $table->float('fibre_g');
            $table->float('ca_mg');
            $table->float('p_mg');
            $table->float('fe_mg');
            $table->float('na_mg');
            $table->float('k_mg');
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
        Schema::dropIfExists('food_libraries');
    }
}
