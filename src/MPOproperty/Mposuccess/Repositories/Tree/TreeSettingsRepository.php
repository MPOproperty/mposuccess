<?php namespace MPOproperty\Mposuccess\Repositories\Tree;
/**
 * Created by PhpStorm.
 * User: yan4ik
 * Date: 26.09.15
 * Time: 2:38
 */

use MPOproperty\Mposuccess\Repositories\Repository;

/**
 * Class TreeSettingsRepository
 * @package MPOproperty\Mposuccess\Repositories\Tree
 */
class TreeSettingsRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {

        return 'MPOproperty\Mposuccess\Models\TreeSetting';
    }

    /*
     * Выдаёт все настройки массивом
     */
    /**
     * @return mixed
     */
    public function getSettings(){
        return $this->model->all();
    }

    /*
     * Записывает настройки структур
     */
    /**
     * @param array $data
     * @param $level
     * @param string $attribute
     * @return mixed
     */
    public function updateSettings(array $data, $level, $attribute="level")
    {
        return $this->model->where($attribute, '=', $level)->update($data);
    }

    /**
     * @param $level
     *
     * @return mixed
     */
    public function getStart($level){
        return $this->model->where('level', '=', $level)->pluck('first_pay');
    }

    /**
     * @param $level
     *
     * @return mixed
     */
    public function getInterval($level){
        return $this->model->where('level', '=', $level)->pluck('next_pay');
    }

    /**
     * @param $level
     *
     * @return mixed
     */
    public function getNumber($level){
        return $this->model->where('level', '=', $level)->pluck('invited');
    }

    /**
     * @param $level
     *
     * @return mixed
     */
    public function getPrice($level){
        return $this->model->where('level', '=', $level)->pluck('sum_pay');
    }
}