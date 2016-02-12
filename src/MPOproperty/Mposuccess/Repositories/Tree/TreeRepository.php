<?php namespace MPOproperty\Mposuccess\Repositories\Tree;
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 22.08.2015
 * Time: 11:08
 */

use MPOproperty\Mposuccess\BinaryTree\Sheet;
use MPOproperty\Mposuccess\Repositories\Repository;
use MPOproperty\Mposuccess\Models\Tree;

class TreeRepository extends Repository{

    private $parent;

    public function findIdByUser($key){
        return $this->model->where('user_id',$key)->orderBy('id', 'ASC')->get();
    }
    public function setToCompany(){
        if(is_null($sid = $this->model->where('user_id',null)->min('id'))){
            $sid = $this->model->max('id');
            $sid++;
        }
        return $sid;
    }

    public function findIMindByUser($user, $parent, $level){

        $settings = app('MPOproperty\Mposuccess\Repositories\Tree\TreeUserSettings');

        $sid = $settings->getPlace($user, $level);

        if(is_null($sid)) {
            $sid = $this->getMinSidByUser($user);
        }

        if(0 == $parent) {
            if(is_null($sid)) {
                return $this->setToCompany();
            } else {
                return $this->findVacancyBySid($sid);
            }
        } else {

            $users = app('MPOproperty\Mposuccess\Repositories\User\UserRepository');

            while(is_null($sid)) {
                $user = $users->find($user);
                if(is_null($user)) {
                    throw new \InvalidArgumentException("Пользователю присвоен несуществующий реферал.");
                }
                $sid = $this->getMinSidByUser($user->refer, $level);
                $user = $user->refer;
                if(0 == $user) {
                    return $this->setToCompany();
                }
            }

            return $this->findVacancyBySid($sid);

        }
    }

    public function findVacancyBySid($sid){
        for($line = 1;;$line++) {
            $start = $sid * pow(2, $line);
            for($place = $start; $place < $start + pow(2, $line);$place++) {
                $sheet = $this->model->where('id',$place)->first();
                if(is_null($sheet) || is_null($sheet->user_id)) {
                    return $place;
                }
            }
        }
    }

    public function getMinSidByUser($user_id, $level = null){
        if(! is_null($level)) {
            $settings = app('MPOproperty\Mposuccess\Repositories\Tree\TreeUserSettings');
            $sid = $settings->getPlace($user_id, $level);

            if(! is_null($sid)) {
                return $sid;
            }
        }
        return $this->model->where('user_id', $user_id)->min('id');
    }
    public function getNumberMax(){
        return $this->model->max('number') + 1;
    }
    public function getAllNull(){
        return $this->model->where('user_id', null)->all()->toArray();
    }
    public function findUser($id){
        $this->applyCriteria();
        return $this->model->where('id', $id)->pluck('user_id');
    }

    public function getUsersPlaceCount($user_id){
        return $this->model->select('m')->where('user_id', $user_id)->distinct()->count();
    }

    public function findUserCount($id){
        $this->applyCriteria();
        return $this->model->where('user_id', $id)->count();
    }

    public function getCountUsersById($ids = array()){
        $places = $this->model->select('user_id')->whereIn('user_id', $ids)->groupBy('user_id')->get()->toArray();
        return count($places);
    }

    public function findIMaxId(){
        return $this->model->max('id');
    }
    public function findByChild($key){

    }

    public function findByVacancy($key){

    }

    public function getMByPlace($place) {
        return $this->model->where('id', $place)->pluck('m');
    }
    /*
     * Find first place (min id) in tree by user id
     */
    public function findFirstPlaceByUserId($id){
        return $this->model->where('user_id', $id)->pluck('id');
    }

    public function findBeforePlaceByUserSid($user_id, $sid){
        $beforePlaces = $this->getListPlacesBeforeSid($user_id, $sid);

        while ($sid > 0) {
            $sid = intval($sid/2);
            if (in_array($sid, $beforePlaces))
                return $sid;
        }

        return $sid;
    }

    /**
     * Get count referral and self places in every level
     *
     * @return boolean
     */
    public function getCountReferralPlaces($id)
    {
        $countReferrals = [];

        for ($level = 0; $level < config('mposuccess.structure_count'); $level++) {
            self::$table = 'MPOproperty\Mposuccess\Models\Tree' . ($level+1);
            $this->makeModel();
            $countReferrals[$level+1] = $this->model
                                        ->whereIn('user_id', \DB::table('users')
                                            ->where('refer', '=', $id)
                                            ->orWhere('id', '=', $id)
                                            ->lists('id')
                                        )
                                        ->count();
        }

        return $countReferrals;
    }

    public function getCountReferralPlacesInLevel($refId, $level) {
        self::$table = 'MPOproperty\Mposuccess\Models\Tree' . ($level);
        $this->makeModel();
        return $this->model
            ->whereIn('user_id', \DB::table('users')
                ->where('refer', '=', $refId)
                ->lists('id')
            )
            ->count();
    }

    /*
     * Get list places (id) in current structure (tree)
     */
    public function getListPlacesBornTest($user_id, $m){
        return $this->model->where('user_id', '=', $user_id)->where('m' , '=', $m)->orderBy('number')->lists('id')->toArray();
    }

    public function getListPlacesBornGroupM($user_id){
        return $this->model->select(\DB::raw('MIN(number) as number'))->where('user_id', '=', $user_id)->groupBy('m')->orderBy('number')->lists('id')->toArray();
    }
    /*
     * Get list places (id) in current structure (tree)
     */
    public function getListPlacesBorn($user_id){
        return $this->model->where('user_id', '=', $user_id)->orderBy('id')->lists('id')->toArray();
    }

    /*
     * Get list places (id) in current structure (tree)
     */
    public function getListPlaces($user_id){
        return $this->model->where('user_id', '=', $user_id)->lists('id')->toArray();
    }

    public function getListPlacesNumber($user_id){
        return $this->model->where('user_id', '=', $user_id)->orderBy('reborn')->orderBy('number')->get()->toArray();
    }

    /*
     * Get list places (id) before $sid in current structure (tree)
     */
    public function getListPlacesBeforeSid($user_id, $sid){
        return $this->model
            ->where('user_id', '=', $user_id)
            ->where('id', '<', $sid)
            ->lists('id')->toArray();
    }

    /**
     * Specify Model class name
     *
     *
     * @return mixed
     */
    public function model()
    {
        //return 'MPOproperty\Mposuccess\Models\Tree';
        return self::$table;
    }

    /**
     * @param $user_id
     * @param $refer_id
     * @param $level
     * @param $parent
     * @param $reborn
     *
     * @return array
     */
    public function findSidTreeReborn($user_id, $refer_id, $level, $parent, $reborn){

        if($user_id == 0) {
            return false;
        }

        $settings = app('MPOproperty\Mposuccess\Repositories\Tree\TreeUserSettings');
        $topUser = $settings->getTop($level);

        if($countAllPlace = $this->countAllPlace()){
            if($countUserPlace = $this->countPlaceByUserId($user_id)) {
                if($reborn) {
                    $place = $this->model->where('id', $parent)->first();
                    if(0 != $place->parent) {
                        if($parent = $this->compareUserBySid($place->parent, [$refer_id, $user_id])) {
                            if($sid = $this->findEmptyPlace($parent->user_id, $parent->n)) {
                                return $this->saveDataPlace($sid, $user_id, $place->parent, $place->n);
                            } else {
                                throw new \InvalidArgumentException("Что-то не так");
                            }
                        } else {
                            $parent = $this->model->where('id', '=', $place->parent)->first();
                            if($countReferPlace = $this->countPlaceByUserId($refer_id)) {
                                if($sid = $this->findEmptyPlace($refer_id)) {
                                    return $this->saveDataPlace($sid, $user_id, $parent->id, $parent->n);
                                } else {
                                    throw new \InvalidArgumentException("Что-то не так");
                                }
                            } else {
                                if($sid = $this->findEmptyPlace($parent->user_id, $parent->n)) {
                                    return  $this->saveDataPlace($sid, $user_id, $parent->id, $parent->n);
                                } else {
                                    throw new \InvalidArgumentException("Что-то не так");
                                }
                            }
                        }
                    } else {
                        $sid = $this->findPlaceInCompany();
                        return $this->saveDataPlace($sid, $user_id, $place->parent, $place->n);
                    }
                } else {
                    if($sid = $this->findEmptyPlace($user_id)) {
                        return $this->saveDataPlace($sid, $user_id, $this->parent);
                    } else {
                        throw new \InvalidArgumentException("Что-то не так");
                    }
                }
            } else {
                if($parent = $this->findParent($refer_id)) {
                    if($sid = $this->findEmptyPlace($parent->user_id)) {
                        return $this->saveDataPlace($sid, $user_id, $this->parent);
                    } else {
                        throw new \InvalidArgumentException("Что-то не так");
                    }
                } else {
                    if(! ($sid = $this->findLastRebornTopUser($topUser))) {
                        $sid = $this->model->where('user_id', $topUser)->min('id');
                    }
                    if($sid = $this->findEmptyPlaceBySid($sid)) {
                        return $this->saveDataPlace($sid, $user_id, $this->parent);
                    } else {
                        throw new \InvalidArgumentException("Что-то не так");
                    }
                }
            }
        } else {
            return $this->putPlaceInCompany($user_id);
        }
    }

    /**
     * Количество мест в этапе
     */
    private function countAllPlace(){
        return $this->model
            ->where('user_id', '!=', 0)
            ->count();
    }

    /**
     * Количество мест пользавателя
     * @param $id
     *
     * @return mixed
     */
    private function countPlaceByUserId($id){
        return $this->model
            ->where('user_id', '=', $id)
            ->where('user_id', '!=', 0)
            ->count();
    }

    /**
     * Сравнение данного пользавателя с
     * пользавателм стоящим в данном месте
     *
     * @param $sid
     * @param $users
     *
     * @return bool
     * @internal param $user
     *
     */
    private function compareUserBySid($sid, $users){
        $place = $this->model
            ->where('id', '=', $sid)
            ->first();
        if($place->user_id == $users[0] || $place->user_id == $users[1]) {
            return $place;
        }
        return false;
    }

    /**
     * @param      $user_id
     * @param null $n
     *
     * @return bool
     */
    private function findEmptyPlace($user_id, $n = null){
        if(! ($place = $this->findEmptyPlaceReborn($user_id, $n, false))) {
            $place = $this->findEmptyPlaceReborn($user_id, $n, true);
        }
        return $place;
    }

    /**
     * @param      $user_id
     * @param null $n
     * @param      $reborn
     *
     * @return bool
     */
    private function findEmptyPlaceReborn($user_id, $n = null, $reborn){
        if(is_null($n)){
            $places = $this->model->where('user_id', '=', $user_id)
                ->where('reborn', '=', $reborn)
                ->orderBy('n')
                ->get();
        } else {
            $places = $this->model->where('user_id', '=', $user_id)
                ->where('reborn', '=', $reborn)
                ->where('n', '=', $n)
                ->get();
        }

        foreach($places as $place) {
            for($line = 1; $line < 3; $line++) {
                $start = $place->id * pow(2, $line);
                for($p = $start; $p < $start + pow(2, $line);$p++) {
                    $sheet = $this->model->where('id',$p)->first();
                    if(is_null($sheet) || is_null($sheet->user_id)) {
                        $this->parent = $place->id;
                        return $p;
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param     $sid
     * @param int $max
     *
     * @return bool
     */
    private function findEmptyPlaceBySid($sid, $max = 3){
        for($line = 1; $line < $max; $line++) {
            $start = $sid * pow(2, $line);
            for($place = $start; $place < $start + pow(2, $line);$place++) {
                $sheet = $this->model->where('id',$place)->first();
                if(is_null($sheet) || is_null($sheet->user_id)) {
                    $this->parent = $sid;
                    return $place;
                }
            }
        }
        return false;
    }

    /**
     * @param $user_id
     *
     * @return mixed
     */
    private function findParent($user_id){
        $users = app('MPOproperty\Mposuccess\Repositories\User\UserRepository');

        do {
            if(0 == $user_id){
                return false;
            }
            $place = $this->model
                ->where('user_id', '=', $user_id)
                ->first();
            if(is_null($place)) {
                $user = $users->find($user_id);
                $user_id = $user->refer;
            }
        } while(is_null($place));

        return $place;
    }

    /**
     * @param $user_id
     *
     * @return array
     */
    private function putPlaceInCompany($user_id){
        $sid = $this->model->max('id') + 1;
        return $this->saveDataPlace($sid, $user_id, false, 1);
    }

    /**
     * @param $id
     *
     * @return bool
     */
    private function findLastRebornTopUser($id){
        $sid = $this->model->where('user_id', '=', $id)
            ->where('reborn', '=', true)
            ->orderBy('number', 'desc')
            ->pluck('id');
        if(is_null($sid)) {
            return false;
        }
        return $sid;
    }

    private function findPlaceInCompany(){
        $places = $this->model
            ->where('user_id', '=', 0)
            ->get();
        foreach($places as $place) {
            if($sid = $this->findEmptyPlaceBySid($place->id, 2)) {
                return $sid;
            }
        }
    }

    /**
     * @param      $sid
     * @param      $user_id
     * @param      $parent
     * @param null $n
     *
     * @return array
     */
    private function saveDataPlace($sid, $user_id, $parent, $n = null){
        if(is_null($n)) {
            $count = $this->model->where('user_id', '=', $user_id)
                ->where('reborn', '=', false)
                ->count();
            $number = $n = $count + 1;
        } else {
            $count = $this->model->where('user_id', '=', $user_id)
                ->where('reborn', '=', true)
                ->count();
            $number = $count + 1;
        }

        return [$sid, $number, $n, $parent];
    }
}