<?php namespace MPOproperty\Mposuccess\Repositories\Notification;
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 10.09.2015
 * Time: 22:00
 */

use MPOproperty\Mposuccess\Repositories\Repository;

class NotificationRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {

        return 'MPOproperty\Mposuccess\Models\Notification';
    }

    public function newCount($value) {
        $this->applyCriteria();
        return $this->model->where('sid', '=', $value)->where('status', '=', 0)->count();
    }

    public function allCount($value) {
        $this->applyCriteria();
        return $this->model->where('sid', '=', $value)->count();
    }

    public function newNotification($value, $skip, $take) {
        $this->applyCriteria();
        return $this->model
            ->orderBy('id', 'desc')
            ->where('status', '=', 0)
            ->where('sid', '=', $value)
            ->take($take)->get();
    }


    public function findAllBySid($sid) {
        $this->applyCriteria();
        return $this->model
            ->where('sid', '=', $sid)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function markAsRead($id) {
        $userId = \Auth::user()->id;

        $notification = $this->model
                            ->where('sid', '=', $userId)
                            ->where('id', '=', $id)
                            ->first();

        if ($notification) {
            $notification->status = 1;
            return $notification->save();
        } else {
            return 0;
        }
    }

    public function markAsReadAll() {
        return $this->update(['status' => 1], \Auth::user()->id, 'sid');
    }



    public function findByParams($params){
        $query = $this->model
            ->where('sid', '=', \Auth::user()->id)
            ->select();

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

        if (isset($params['start']) && $params['start'])
            $query->skip($params['start']);

        if (isset($params['count']) && $params['count'])
            $query->take($params['count']);

        return $query->get();
    }

    public function findByParamsForTable($params){
        $iTotalRecords = $this->findAllBy('sid', \Auth::user()->id)->count();
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);

        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $columns = $params['columns'];

        $order = [
            'field' => $columns[$params['order'][0]['column']]['name'],
            'dir'   => $params['order'][0]['dir']
        ];

        $where = [];
        $action = isset($params['action']) ? $params['action'] : '';

        if ($action = 'filter') {
            if(isset($params['date_from']) && $params['date_from'])
                $where[] = ['created_at', '>=', preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$3-$2-$1",$params['date_from'])];

            if(isset($params['date_to']) && $params['date_to'])
                $where[] = ['created_at', '<=', preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$3-$2-$1",$params['date_to']) ];

            if(isset($params['status']) && ($params['status'] == 0 || $params['status'] == 1))
                $where[] = ['status', '=', $params['status']];

            foreach(['name', 'text'] as $field) {
                if(isset($params[$field]) && $params[$field])
                    $where[] = [$field, 'like', '%' . $params[$field] . '%'];
            }
        }

        $notifications = $this->findByParams([
            'start' => $iDisplayStart,
            'count' => $end - $iDisplayStart,
            'order' => $order,
            'where' => $where
        ]);

        foreach($notifications as $notification) {
            $records["data"][] = array(
                $notification->name,
                $notification->text,
                date_format(date_create($notification->created_at), 'd M Y'),
                $notification->status ?
                    '<span class="label label-sm label-success">' . trans('mposuccess::panel.notification.status-read') . '</span>' :
                    '<span class="label label-sm label-warning">' . trans('mposuccess::panel.notification.status-unread') . '</span>',
                '<a data-href="/panel/notification/' . $notification->id .'/delete" class="btn default btn-xs black b-delete"><i class="fa fa-trash-o"></i>' . trans('mposuccess::panel.delete') . '</a>',
            );
        }


        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        echo json_encode($records);
    }
}