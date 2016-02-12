<?php namespace MPOproperty\Mposuccess\Repositories\Criteria;
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 22.08.2015
 * Time: 13:19
 */

use MPOproperty\Mposuccess\Repositories\RepositoryInterface as Repository;

abstract class Criteria {

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public abstract function apply($model, Repository $repository);
}