<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phongban extends Model
{
    //
    protected $table = 'phongban';
    protected $primaryKey = 'id';
    protected $fillable = ['ten', 'daxoa'];
    public $timestamps = true;
    
}
