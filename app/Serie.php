<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serie extends Model
{
    protected $table = 'tb_series';
    protected $primaryKey='idSerie';
    protected $fillable = ['title','synopsis', 'platformId', 'directorId'];

    use SoftDeletes;

    public function listActors()
    {
        return $this->belongsToMany(Actor::class, 'tb_series_actors', 'serieId', 'actorId')->withPivot('idSerieActor');
    }

    public function listLanguages()
    {
        return $this->belongsToMany(Language::class, 'tb_series_languages', 'serieId', 'languageId')->withPivot('idSerieLanguage','type');
    }
}
