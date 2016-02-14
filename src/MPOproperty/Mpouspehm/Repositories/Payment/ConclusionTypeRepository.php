<?php

namespace MPOproperty\Mpouspehm\Repositories\Payment;

use MPOproperty\Mpouspehm\Repositories\Repository;

class ConclusionTypeRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'MPOproperty\Mpouspehm\Models\TypeConclusion';
    }

}