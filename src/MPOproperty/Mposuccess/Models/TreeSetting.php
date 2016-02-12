<?php

namespace MPOproperty\Mposuccess\Models;

use Illuminate\Database\Eloquent\Model;

class TreeSetting extends Model
{
    protected $table = 'tree_settings';
    protected $hidden = ['id'];
    public $timestamps = false;
    protected $fillable = ['level', 'cells_to_fill', 'first_pay', 'next_pay', 'sum_pay', 'invited'];
}
