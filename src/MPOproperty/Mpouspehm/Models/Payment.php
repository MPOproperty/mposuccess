<?php

namespace MPOproperty\Mpouspehm\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    CONST CONVERSION_BALANCE = 100;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'balance'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_balance';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->hasOne('MPOproperty\Mpouspehm\Models\User', 'id');
    }

    /**
     * @param $value
     * @return float
     */
    public function getBalanceAttribute($value)
    {
        return $value / self::CONVERSION_BALANCE;
    }

    /**
     * @param $value
     */
    public function setBalanceAttribute($value)
    {
        $this->attributes['balance'] = $value * self::CONVERSION_BALANCE;
    }

}
