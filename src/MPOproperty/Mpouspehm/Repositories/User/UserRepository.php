<?php namespace MPOproperty\Mpouspehm\Repositories\User;
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 22.08.2015
 * Time: 11:08
 */

use DB;
use MPOproperty\Mpouspehm\Repositories\Repository;
use MPOproperty\Mpouspehm\Models\RoleCustom;
use MPOproperty\Mpouspehm\Models\User;

class UserRepository extends Repository {

    /**
     * Specify Models class name
     *
     * @return mixed
     */
    function model()
    {

        return 'MPOproperty\Mpouspehm\Models\User';
    }

    /**
     * Change/add (upload) avatar for user
     *
     * @return boolean
     */
    public function changeAvatar($request, $user)
    {
        if ($request->hasFile('photo'))
        {
            $destinationPath = "/images/users/";
            $fileName = $user->id . '.' . $request->file('photo')->getClientOriginalExtension();

            if ($user->url_avatar) {
                if (file_exists(public_path() . $user->url_avatar)) {
                    unlink(public_path() . $user->url_avatar);
                }
            }

            $request->file('photo')->move(public_path() . $destinationPath, $fileName);

            $this->update([
                'url_avatar' => $destinationPath . $fileName
            ], $user->id);

            return true;
        }
        return false;
    }

    /**
     * Remove avatar for user
     *
     * @return boolean
     */
    public function removeAvatar($id, $url_avatar)
    {
        if ($url_avatar) {
            if (file_exists(public_path() . $url_avatar)) {
                unlink(public_path() . $url_avatar);
            }

            $this->update([
                'url_avatar' => ''
            ], $id);
        }

        return true;
    }



    /**
     * Get refer user
     *
     * @return string
     */
    public function getRefer($referId = 1)
    {
        $refer = $this->model->find($referId, array('surname', 'name', 'email'));
        if (!$refer) {
            $refer = $this->model->find(1, array('surname', 'name', 'email'));
        }

        if ($refer)
            return trim($refer->surname . $refer->name . "(" . $refer->email . ")") ;
        else
            return null;
    }

    /**
     * @param $refer
     *
     * @return mixed
     */
    public function findChilds($refer)
    {
        return $this->model->where('refer', '=', $refer)->count();
    }


    public function findAllChilds($refer)
    {
        $childs = array_merge($this->findChildRef($refer));
        foreach ($childs as $child) {
            $childs = array_merge($childs, $this->findChildRef($child));
            if(is_array($child)) {

            }
        }
        return count($childs);
        //return implode(', ', $childs);
    }

    public function sumProfit($id)
    {
        $profit_trans = DB::table('transactions')->where('to', $id)->where('type_id', 6)->sum('price');
        return $profit_trans/100;
    }

    public function findAllTransactions($id)
    {
        $transactions = DB::select('select * from transactions where user_id = ?', [$id]);
        return count($transactions);
    }


    /**
     * @param $refer
     *
     * @return mixed
     */
    public function findChildRef($refer){
        return $this->model->where('refer', '=', $refer)->lists('id')->toArray();
    }

    public function getName($id){
        $user = $this->model->where('id', '=', $id)->first()->toArray();
        return $user['surname'] . ' ' . $user['name']. ' ' .$user['patronymic'];
    }


    public function findDataByArrayIds($arrayIds){
        return $this->model
            ->whereIn('id', $arrayIds)
            ->select('id as uid', 'surname', 'name', 'patronymic', 'email', 'sid as usid', 'refer')
            ->get()->toArray();
    }


    public function findByParams($params){
        $query = $this->model
            ->leftJoin('user_balance', 'user_balance.id', '=', 'users.id')
            ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('sid', 'users.id as id', 'email', \DB::raw('CONCAT(surname, " ", users.name, " ", patronymic) as fio'), 'user_balance.balance as user_balance', 'roles.name as role');

        if (isset($params['order'], $params['order']['field'], $params['order']['dir']))
            $query->orderBy($params['order']['field'], $params['order']['dir']);

        if (isset($params['where']))
            foreach($params['where'] as $where) {
                if ($where[0] != 'fio') {
                    $query->where($where[0], $where[1], $where[2]);
                } else {
                    $query->where(\DB::raw('CONCAT(surname, " ", users.name, " ", patronymic)'), $where[1], $where[2]);
                }
            }

        $count = $query->count();

        if (isset($params['start']) && $params['start'])
            $query->skip($params['start']);

        if (isset($params['count']) && $params['count'])
            $query->take($params['count']);

        return [
            'users' => $query->get(),
            'count' => $count
        ];
    }

    public function findByParamsForTable($params){
        $iTotalRecords = $this->all()->count();
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);

        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $status_list = array(
            "badUser" => "danger",
            "User" => "info",
            "Moderator" => "warning",
            "Admin" => "success"
        );

        $columns = $params['columns'];

        $order = [
            'field' => $columns[$params['order'][0]['column']]['name'],
            'dir'   => $params['order'][0]['dir']
        ];

        $where = [];
        $action = isset($params['action']) ? $params['action'] : '';

        if ($action = 'filter') {
            if(isset($params['balance_from']) && $params['balance_from'])
                $where[] = ['balance', '>=', $params['balance_from']*100];

            if(isset($params['balance_to']) && $params['balance_to'])
                $where[] = ['balance', '<=', $params['balance_to']*100];

            if(isset($params['role']) && $params['role'])
                $where[] = ['roles.name', '=', $params['role']];

            foreach(['sid', 'fio', 'email'] as $field) {
                if(isset($params[$field]) && $params[$field])
                    $where[] = [$field, 'like', '%' . $params[$field] . '%'];
            }
        }

        $result = $this->findByParams([
            'start' => $iDisplayStart,
            'count' => $end - $iDisplayStart,
            'order' => $order,
            'where' => $where
        ]);

        foreach($result['users'] as $user) {
            //$status = $status_list[rand(0, 2)];
            //$id = ($i + 1);
            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $user->id . '">',
                $user->sid,
                $user->fio,
                $user->email,
                $user->user_balance / 100,
                $user->role && isset($status_list[$user->role]) ?
                    '<span class="label label-sm label-' . $status_list[$user->role] . '">' . $user->role . '</span>' : '',
                '<a href="/panel/admin/user/' . $user->id .'/view" class="btn default btn-xs blue-stripe b-load" data-target="#ajax" data-toggle="modal">' . trans('mpouspehm::panel.view') . '</a>' .
                '<a href="/panel/admin/user/' . $user->id .'/edit" class="btn default btn-xs purple b-load" data-target="#ajax" data-toggle="modal"><i class="fa fa-edit"></i>' .  trans('mpouspehm::panel.edit') . '</a>' .
                '<a data-href="/panel/admin/user/' . $user->id .'/delete" class="btn default btn-xs black b-delete" data-id-news="{{$item->id}}"><i class="fa fa-trash-o"></i>' . trans('mpouspehm::panel.delete') . '</a>',
            ); /* href="/panel/admin/user/' . $user->id .'/delete"   */
        }



        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $result['count'];
        $records["recordsFiltered"] = $result['count'];

        echo json_encode($records);
    }

}