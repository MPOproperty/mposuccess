<?php

namespace MPOproperty\Mposuccess\Repositories\Payment;

use MPOproperty\Mposuccess\Repositories\Repository;

class ConclusionTypeRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'MPOproperty\Mposuccess\Models\TypeConclusion';
    }

}