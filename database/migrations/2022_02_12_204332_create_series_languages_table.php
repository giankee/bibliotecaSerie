<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_series_languages', function (Blueprint $table) {
            $table->bigIncrements('idSerieLanguage');
            $table->string('type');
            $table->integer('serieId')->unsigned();
            $table->integer('languageId')->unsigned();
            $table->foreign('serieId')->references('idSerie')->on('tb_series');
            $table->foreign('languageId')->references('idLanguage')->on('tb_languages');
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
        Schema::dropIfExists('tb_series_languages');
    }
}
