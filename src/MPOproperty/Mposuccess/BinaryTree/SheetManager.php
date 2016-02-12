<?php
/**
 * Created by PhpStorm.
 * User: MPOproperty
 * Date: 15.09.2015
 * Time: 20:31
 */

namespace MPOproperty\Mposuccess\BinaryTree;

use MPOproperty\Mposuccess\Models\User;
use MPOproperty\Mposuccess\BinaryTree\Sheet;


/**
 * @property Sheet tree
 */
class SheetManager
{
    protected $builder;
    protected $sheet;
    protected $uid;
    protected $pid;
    protected $level;

    public function __construct($uid, $level){
        $this->uid = $uid;
        $this->level = $level;
    }

    public function create(){

        $this->tree = new Sheet($this->level, $this->uid);
        return $this->tree->insert();

    }
}