<?php

namespace MPOproperty\Mpouspehm\Models;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    protected $table = 'tree';
    public $timestamps = false;
    protected $fillable = array('user_id', 'id');
}
