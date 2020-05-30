<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('diagnosis_type');
            $table->longText('report_summary');
            $table->float('weight');
            $table->float('height');
            $table->float('BMI');
            $table->float('interdialytic_weight');
            $table->float('dry_weight');
            $table->float('creatinine');
            $table->float('urea');
            $table->float('potassium');
            $table->float('sodium');
            $table->float('phosphate');
            $table->longText('urine_analysis');
            $table->float('bp');
            $table->float('ktv');
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
        Schema::dropIfExists('reports');
    }
}
