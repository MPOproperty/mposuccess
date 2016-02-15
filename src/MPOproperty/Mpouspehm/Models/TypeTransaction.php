<?php

namespace MPOproperty\Mpouspehm\Models;

use Illuminate\Database\Eloquent\Model;

class TypeTransaction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'type_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'description'];

    /**
     * @var bool
     */
    public $timestamps = false;

}
