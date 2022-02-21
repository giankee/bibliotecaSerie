<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platform extends Model
{
    protected $table = 'tb_platforms';
    protected $primaryKey='idPlatform';
    protected $fillable = ['name'];

    use SoftDeletes;
}
