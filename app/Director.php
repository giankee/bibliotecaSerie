<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Director extends Model
{
    protected $table = 'tb_directors';
    protected $primaryKey='idDirector';
    protected $fillable = ['firstName','lastName', 'birthDate', 'nationality'];

    use SoftDeletes;
}
