<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
    protected $table = 'tb_actors';
    protected $primaryKey='idActor';
    protected $fillable = ['firstName','lastName', 'birthDate', 'nationality'];

    use SoftDeletes;
}
