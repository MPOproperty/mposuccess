<?php

namespace MPOproperty\Mpouspehm\Models;

use Illuminate\Database\Eloquent\Model;

class Tree1 extends Model
{
    protected $table = 'tree1';
    public $timestamps = false;
    protected $fillable = array('user_id', 'id');
}
