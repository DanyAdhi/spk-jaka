<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComparisonMatricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comparison_matrices', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name');
            $table->float('kemuh', 8, 5);
            $table->float('imm', 8, 5);
            $table->float('tauhid', 8, 5);
            $table->float('ibadah', 8, 5);
            $table->float('bta', 8, 5);
            $table->timestamps();

            $table->unique('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comparison_matrices');
    }
}
