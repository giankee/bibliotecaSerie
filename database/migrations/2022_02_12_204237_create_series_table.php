<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_series', function (Blueprint $table) {
            $table->bigIncrements('idSerie');
            $table->string('title');
            $table->text('synopsis');
            $table->integer('platformId')->unsigned();
            $table->integer('directorId')->unsigned();

            $table->foreign('platformId')->references('idPlatform')->on('tb_platforms');
            $table->foreign('directorId')->references('idDirector')->on('tb_directors');
            $table->softDeletes();
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
        Schema::dropIfExists('tb_series');
    }
}
