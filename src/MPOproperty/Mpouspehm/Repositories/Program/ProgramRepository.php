<?php namespace MPOproperty\Mpouspehm\Repositories\Program;
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 10.09.2015
 * Time: 22:00
 */

use MPOproperty\Mpouspehm\Repositories\Repository;

class ProgramRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {

        return 'MPOproperty\Mpouspehm\Models\Program';
    }

}