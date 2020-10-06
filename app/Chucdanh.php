<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chucdanh extends Model
{
    //
    protected $table = 'chucdanh';
    protected $primaryKey = 'id';
    protected $fillable = ['ten', 'daxoa'];
    public $timestamps = true;
}
