<?php
/**
 * Created by PhpStorm.
 * User: MPOproperty
 * Date: 13.09.2015
 * Time: 17:38
 */

namespace MPOproperty\Mposuccess\BinaryTree;


use MPOproperty\Mposuccess\Contracts\BinaryTree\BuilderContract;
//use MPOproperty\Mposuccess\Repositories\Tree\TreeRepository;

class SheetBuilder implements BuilderContract
{
    protected $sheet;

    public function __construct($sid){
        $this->sheet = new Sheet($sid);
    }

    public function getBuild(){
        return $this->sheet;
    }
}