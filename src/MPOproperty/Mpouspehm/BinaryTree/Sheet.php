<?php namespace MPOproperty\Mpouspehm\BinaryTree;

use MPOproperty\Mpouspehm\Contracts\BinaryTree\SheetInterface;
use MPOproperty\Mpouspehm\Repositories\Tree\TreeRepository;
use Event;

/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 22.08.2015
 * Time: 10:42
 */


class Sheet implements SheetInterface {

    protected $structure   = [
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six'
    ];

    protected $sid;

    protected $left;

    protected $right;

    public $user;

    protected $line;

    protected $side;

    protected $two;

    protected $parent;

    protected $level;

    protected $tree;

    protected $dataMembers = [];

    /*
     * Array (4 elem.) - statictic about own places and referrals in sheet and structure
     *
     * 0 - count own places in sheet (triangle)
     * 1 - count referrals in sheet (triangle)
     * 2 - count own places in structure
     * 3 - count referrals in structure
     */
    protected $statistic = [0,0,0,0];

    /**
     * @param      $level
     * @param null $uid
     * @param null $sid
     */
    public function __construct($level, $uid = null, $sid = null){
        $this->sid = $sid;
        $this->level = $level;

        TreeRepository::setTable('MPOproperty\Mpouspehm\Models\Tree' . $level);
        $this->tree = app('MPOproperty\Mpouspehm\Repositories\Tree\TreeRepository');
        $this->user = app('MPOproperty\Mpouspehm\Repositories\User\UserRepository');

        if(!empty($uid)) {
            $this->user = $this->user->find($uid);
            $this->parent = $this->user->refer ? $this->user->refer : 0;
        }

        if(!empty($this->sid)){
            $this->left = $this->tree->findUser($this->sid * 2);
            $this->right = $this->tree->findUser(($this->sid * 2) + 1);

            $this->line = log($this->sid, 2);
            $this->side = ($this->sid%2)?0:1;


            if(!empty($this->left)){
                $this->two[0] = $this->tree->findUser($this->sid * 4);
                $this->two[1] = $this->tree->findUser(($this->sid * 4) + 1);
            }else{
                $this->two[0] = null;
                $this->two[1] = null;
            }

            if(!empty($this->right)){
                $this->two[2] = $this->tree->findUser((($this->sid * 2) + 1) * 2);
                $this->two[3] = $this->tree->findUser(((($this->sid * 2) + 1) * 2) + 1);
            }else{
                $this->two[2] = null;
                $this->two[3] = null;
            }
        }
    }

    public function insert($parent = null, $reborn = false)
    {
        if(! ($this->level % 3)) {
            list($sid, $number, $n, $parentTwo) = $this->tree->findSidTreeReborn($this->user->id, $this->user->refer, $this->level, $parent, $reborn);
        } else {
            $sid = $this->tree->findIMindByUser($this->user->id, $this->user->refer, $this->level);
        }

        if(! $sid) {
            return false;
        }

        /*$max = $this->tree->findIMaxId();

        if($sid > $max){
            for($i = $max + 1; $i < $sid; $i++){
                $this->tree->create([
                    'user_id' => null,
                    'id'      => $i
                ]);
            }
        }*/

        $current = $this->tree->find($sid);

        if($this->level % 3) {
            if (is_null($current)) {
                $create = $this->tree->create([
                    'user_id' => $this->user->id,
                    'id' => $sid,
                ]);
            } else {
                $create = $this->tree->update([
                    'user_id' => $this->user->id,
                ], $sid);
            }
        } else {
            if (is_null($current)) {
                $create = $this->tree->create([
                    'user_id' => $this->user->id,
                    'id'      => $sid,
                    'number'  => $number,
                    'reborn'  => $reborn,
                    'n'       => $n,
                    'parent'  => $parentTwo
                ]);
            } else {
                $create = $this->tree->update([
                    'user_id' => $this->user->id,
                    'number'  => $number,
                    'reborn'  => $reborn,
                    'n'       => $n,
                    'parent'  => $parentTwo
                ], $sid);
            }
        }

        if($create) {
            $name = explode("_", $this->level);
            Event::fire('tree.' . $this->structure[$name[0]] . '.bye', [
                trim($this->user->surname . ' ' . $this->user->name . " (" . $this->user->email . ")"),
                $sid,
                $this->user->id,
                $this->user->refer
            ]);

        }

        return $create;
    }

    public function remove($key){

    }

    protected function init(){
    }

    private function find($id){
        $places = $this->tree->findIdByUser($id);
        $sid = null;

        $sid = $this->findVacancy($places);

        if(is_null($sid)){
            $user = $this->user->find($id);
            if(!empty($user)) {
                $sid = $this->find($user->refer);
            }
        }

        return $sid;
    }

    private function findVacancy($places){
        $sid = null;
        foreach ($places as $place) {
            $sheet = new Sheet($this->level, $place->user_id, $place->id);
            if (empty($sheet->left)) {
                $sid = $sheet->sid * 2;
                break;
            } elseif (empty($sheet->right)) {
                $sid = ($sheet->sid * 2) + 1;
                break;
            } else {
                foreach ($sheet->two as $key => $place) {
                    if (empty($place)) {
                        $sid = ($sheet->sid * 4) + $key;
                        break;
                    }
                }
            }
        }
        return $sid;
    }

    /**
     * @return mixed
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @return mixed
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getTwo($key)
    {
        return $this->two[$key];
    }

    /**
     * @return null
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * @return null
     */
    public function getParent()
    {
        return ($this->sid%2)?($this->sid - 1)/2:$this->sid/2;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }


    /**
     * @return mixed
     */
    public function getDataMembers()
    {
        $memberIds = [
            $this->left,   $this->right,
            $this->two[0], $this->two[1],
            $this->two[2], $this->two[3]
        ];

        $memberIds = array_replace($memberIds,array_fill_keys(array_keys($memberIds, null),''));  // if null value
        $members = array_count_values($memberIds);

        // count own places in sheet
        $this->statistic[0] = array_key_exists($this->user->id, $members) ? $members[$this->user->id] : 0;

        $memberIds = array_keys($members);


        $userRepository = app('MPOproperty\Mpouspehm\Repositories\User\UserRepository');

        $users = $userRepository->findDataByArrayIds($memberIds);

        foreach($users as &$user){
            $user['fio'] = trim(implode(" ", [$user['surname'], $user['name'], $user['patronymic']]), " \xC2\xA0");
            $user['short'] = $this->doShortName($user['surname'], $user['name']);
            unset($user['surname'], $user['name'], $user['patronymic']);

            // count referrals in sheet
            if ($user['refer'] == $this->user->id) {
                $this->statistic[1] += array_key_exists($user['uid'], $members) ? $members[$user['uid']] : 0;
            }

            $this->dataMembers[$user['uid']] = $user;
        }

        // statistic in structure
        $this->statistic[2] = $this->tree->findUserCount($this->user->id);
        $this->statistic[3] = $this->tree->getCountReferralPlacesInLevel($this->user->id, $this->level);
    }

    public function findDataMemberById($memberId)
    {
        return $this->dataMembers[$memberId];
    }

    public function doDataMemberById($memberId, $sid)
    {
        if ($memberId) {
            $data = $this->dataMembers[$memberId];
            $data['sid'] = $sid;
            return $data;
        } else {
            return ['name' => ''];
        }
    }

    public function doShortName($name1, $name2)
    {
       return $this->rus2translit(mb_strtoupper(mb_substr($name1, 0, 1) . mb_substr($name2, 0, 1)));
    }

    public function findDataMember()
    {
        if ($this->left) {
            $left = $this->dataMembers[$this->left];
            $left['sid'] = $this->sid * 2;
            $left['children'] = [
                $this->doDataMemberById($this->two[0], $this->sid * 4),
                $this->doDataMemberById($this->two[1], $this->sid * 4 + 1)
            ];
        } else {
            $left = ['name' => '', 'children' => [ ['name' => ''],['name' => ''] ]];
        }

        if ($this->right) {
            $right = $this->dataMembers[$this->right];
            $right['sid'] = $this->sid * 2 + 1;
            $right['children'] = [
                $this->doDataMemberById($this->two[2], $this->sid * 4 + 2),
                $this->doDataMemberById($this->two[3], $this->sid * 4 + 3)
            ];
        } else {
            $right = ['name' => '', 'children' => [ ['name' => ''],['name' => ''] ]];
        }

        return [
            $left,
            $right
        ];
    }


    public static function rus2translit($string) {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }


    public function toArray(){
        return [
            'current'   => [$this->user->id, $this->getParent(), $this->level],
            'one'       => [$this->left, $this->sid * 2, $this->level],
            'two'       => [$this->right, ($this->sid * 2) + 1, $this->level],
            'three'     => [$this->two[0], $this->sid * 4, $this->level],
            'four'      => [$this->two[1], ($this->sid * 4) + 1, $this->level],
            'five'      => [$this->two[2], ($this->sid * 4) + 2, $this->level],
            'six'       => [$this->two[3], ($this->sid * 4) + 3, $this->level],
        ];
    }

    public function toJson(){
        $this->getDataMembers();

        return json_encode([
            "sid" => $this->getParent(),
            "usid" => $this->user->sid,
            "email" => $this->user->email,
            "fio"  => implode(" ", [$this->user->surname, $this->user->name, $this->user->patronymic]),
            'short' => $this->doShortName($this->user->surname, $this->user->name),
            "statistic" => $this->statistic,
            "children" => $this->findDataMember()
        ], JSON_UNESCAPED_UNICODE);
    }

    public static function next($table, $user_id, $parent, $level, $place){
        TreeRepository::setTable($table);
        $tree = app('MPOproperty\Mpouspehm\Repositories\Tree\TreeRepository');
        return $tree->findIMindByUserTest($user_id, $parent, $level, $place, false);
    }
}