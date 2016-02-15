<?php

namespace MPOproperty\Mpouspehm\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['img', 'name', 'preview', 'content', 'display', 'type'];

    public $timestamps = true;
}
