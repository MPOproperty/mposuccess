<?php

namespace MPOproperty\Mposuccess\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status_id', 'type_id', 'user_id', 'description', 'price', 'from', 'to', 'sid'];

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type_transaction()
    {
        return $this->belongsTo('MPOproperty\Mposuccess\Models\TypeTransaction', 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status_transaction()
    {
        return $this->belongsTo('MPOproperty\Mposuccess\Models\StatusTransaction', 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('MPOproperty\Mposuccess\Models\User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function from_user_id()
    {
        return $this->belongsTo('MPOproperty\Mposuccess\Models\User', 'from');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to_user_id()
    {
        return $this->belongsTo('MPOproperty\Mposuccess\Models\User', 'to');
    }

    /**
     * @param $value
     * @return float
     */
    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    /**
     * @param $value
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

}
