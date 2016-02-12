<?php

namespace MPOproperty\Mposuccess\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'des', 'price', 'percent', 'url', 'count', 'level'];

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    public function getCoastAttribute()
    {
        return round(($this->attributes['price'] / 100) * (1 + $this->attributes['percent'] / 100), 2);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entities()
    {
        return $this->hasMany('MPOproperty\Mposuccess\Models\ProductEntities', 'product_id');
    }

    public function entities_all()
    {
        return $this->belongsToMany('MPOproperty\Mposuccess\Models\Entity', 'product_entities', 'product_id', 'entity_id')->withPivot('count');
    }
}