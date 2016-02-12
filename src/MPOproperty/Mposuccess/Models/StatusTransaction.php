<?php

namespace MPOproperty\Mposuccess\Models;

use Illuminate\Database\Eloquent\Model;

class StatusTransaction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'status_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'description'];

    /**
     * @var bool
     */
    public $timestamps = false;

}
