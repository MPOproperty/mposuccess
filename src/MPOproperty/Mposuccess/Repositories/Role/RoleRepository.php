<?php namespace MPOproperty\Mposuccess\Repositories\Role;
/**
 * Created by PhpStorm.
 * User: nicklifs
 * Date: 22.10.2015
 * Time: 22:10
 */

use MPOproperty\Mposuccess\Repositories\Repository;
use MPOproperty\Mposuccess\Models\RoleCustom;
use MPOproperty\Mposuccess\Models\User;

class RoleRepository extends Repository {

    /**
     * Specify Models class name
     *
     * @return mixed
     */
    function model()
    {

        return 'MPOproperty\Mposuccess\Models\RoleCustom';
    }
}