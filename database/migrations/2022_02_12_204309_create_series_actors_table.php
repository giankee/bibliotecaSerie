<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_series_actors', function (Blueprint $table) {
            $table->bigIncrements('idSerieActor');
            $table->integer('serieId')->unsigned();
            $table->integer('actorId')->unsigned();
            $table->foreign('serieId')->references('idSerie')->on('tb_series');
            $table->foreign('actorId')->references('idActor')->on('tb_actors');
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
        Schema::dropIfExists('tb_series_actors');
    }
}
