<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SerieActor extends Model
{
    protected $table = 'tb_series_actors';
    protected $primaryKey='idSerieActor';
    protected $fillable = ['serieId', 'actorId'];
}
