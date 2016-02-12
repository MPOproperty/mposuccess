<?php

namespace MPOproperty\Mposuccess\Models;

use Illuminate\Database\Eloquent\Model;

class ProductEntities extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'product_id', 'entity_id', 'count'];

    public $timestamps = false;
}
