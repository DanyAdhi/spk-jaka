<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('participant_id');
            $table->integer('kemuhammadiyahan')->comment('score of kemuhammadiyahan participant');
            $table->integer('imm')->comment('score of ke-IMM-an participant');
            $table->integer('tauhid')->comment('score of tauhid participant');
            $table->integer('ibadah')->comment('score of ibadah participant');
            $table->integer('bta')->comment('score of baca-tulis-alquran participant');
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
        Schema::dropIfExists('participant_scores');
    }
}
