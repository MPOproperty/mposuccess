<?php namespace MPOproperty\Mpouspehm\Repositories\Role;
/**
 * Created by PhpStorm.
 * User: nicklifs
 * Date: 22.10.2015
 * Time: 22:10
 */

use MPOproperty\Mpouspehm\Repositories\Repository;
use MPOproperty\Mpouspehm\Models\RoleCustom;
use MPOproperty\Mpouspehm\Models\User;

class RoleRepository extends Repository {

    /**
     * Specify Models class name
     *
     * @return mixed
     */
    function model()
    {

        return 'MPOproperty\Mpouspehm\Models\RoleCustom';
    }
}