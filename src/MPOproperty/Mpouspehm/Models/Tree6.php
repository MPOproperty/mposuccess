<?php

namespace MPOproperty\Mpouspehm\Models;

use Illuminate\Database\Eloquent\Model;

class Tree6 extends Model
{
    protected $table = 'tree6';
    public $timestamps = false;
    protected $fillable = array('user_id', 'id', 'number', 'reborn', 'n', 'parent');
}
