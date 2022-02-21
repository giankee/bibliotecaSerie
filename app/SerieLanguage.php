<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SerieLanguage extends Model
{
    protected $table = 'tb_series_languages';
    protected $primaryKey='idSerieLanguage';
    protected $fillable = ['type','serieId', 'languageId'];
}
