<?php namespace MPOproperty\Mposuccess\Repositories\Program;
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 10.09.2015
 * Time: 22:00
 */

use MPOproperty\Mposuccess\Repositories\Repository;

class ProgramRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {

        return 'MPOproperty\Mposuccess\Models\Program';
    }

}