<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerInGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PlayerInGame', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('playerGameID');
            $table->integer('gameID');
            $table->integer('goals');
            $table->integer('yellowCard');
            $table->integer('redCard');
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
        Schema::dropIfExists('PlayerInGame');
    }
}
