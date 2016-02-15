<?php namespace MPOproperty\Mpouspehm\Repositories\Tree;
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 22.08.2015
 * Time: 11:08
 */

use MPOproperty\Mpouspehm\Repositories\Repository;
use MPOproperty\Mpouspehm\Models\UserPlaceSettings;

class TreeUserSettings extends Repository{


    /**
     * Specify Model class name
     *
     *
     * @return mixed
     */
    public function model()
    {
        return 'MPOproperty\Mpouspehm\Models\UserPlaceSettings';
    }

    public function firstOrCreate($data){
        return $this->model->firstOrCreate($data);
    }

    /**
     * Todo исключения
     *
     * @param $sid
     * @param $uid
     * @param $level
     */
    public function newPlace($sid, $uid, $level){
        $settings = $this->model->firstOrCreate([
            'user'      => $uid,
            'structure' => $level
        ]);
        $settings->update([
            'place' => $sid
        ], $settings->id);
    }

    public function getPlace($uid, $level){
        return  $this->model->where('user', $uid)->where('structure', $level)->pluck('place');
    }

    public function setTop($sid, $level){
        $settings = $this->model->firstOrCreate([
            'user'      => 0,
            'structure' => $level,
            'place' => $sid
        ]);

        return $settings;
    }

    public function getTop($level){
        return  $this->model->where('user', 0)->where('structure', $level)->pluck('place');
    }

}