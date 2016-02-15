<?php

namespace MPOproperty\Mpouspehm\Models;

use Illuminate\Database\Eloquent\Model;

class UserPlaceSettings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user', 'structure', 'place'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_place_settings';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->hasMany('MPOproperty\Mpouspehm\Models\User', 'id', 'user');
    }

    /**
     * @param null $number
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tree($number = null)
    {
        if(is_null($number) || class_exists('MPOproperty\Mpouspehm\Models\Tree' . $number)) {
            throw new \InvalidArgumentException("Обращение к несуществуешей структуре.");
        }
        return $this->hasMany('MPOproperty\Mpouspehm\Models\Tree' . $number, 'id', 'place');
    }

}