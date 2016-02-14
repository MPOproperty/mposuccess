<?php

namespace MPOproperty\Mpouspehm\Repositories\Payment;

use MPOproperty\Mpouspehm\Models\Withdrawal;
use MPOproperty\Mpouspehm\Repositories\Repository;
use MPOproperty\Mpouspehm\Repositories\Transaction\StatusTransactionRepository;


class WithdrawalRepository extends Repository
{
    /**
     * Описание транзакции по умолчанию
     */
    CONST DEFAULT_DESCRIPTION = "Вывод средств";
    
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'MPOproperty\Mpouspehm\Models\Withdrawal';
    }


    /**
     * Создание запроса на снятие средств
     *
     * @param $params
     * @return Withdrawal
     * @throws \Exception
     */
    public function createWithdrawal($params)
    {
        $model = new Withdrawal();

        $model->status_id = StatusTransactionRepository::STATUS_EXHIBITED;
        $model->user_id = $params['user_id'];
        $model->description = isset($params['description']) ? $params['description'] : self::DEFAULT_DESCRIPTION;
        $model->price = $params['price'];
        $model->method_id = $params['method_id'];
        $model->date = $params['date'];

        return $model->save();
    }

    public function findByParamsForTable($params){
        $status = app('MPOproperty\Mpouspehm\Repositories\Transaction\StatusTransactionRepository');

        $iTotalRecords = $this->all()->count();
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
        $whereJoin = [];
        $action = isset($params['action']) ? $params['action'] : '';

        if ($action = 'filter') {
            if(isset($params['price_from']) && $params['price_from'])
                $where[] = ['price', '>=', $params['price_from']*100];

            if(isset($params['price_to']) && $params['price_to'])
                $where[] = ['price', '<=', $params['price_to']*100];

            if(isset($params['date_from']) && $params['date_from'])
                $where[] = ['withdrawals.date', '>=', preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$3-$2-$1",$params['date_from']) ];

            if(isset($params['date_to']) && $params['date_to'])
                $where[] = ['withdrawals.date', '<=', preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$3-$2-$1 23:59:59",$params['date_to']) ];

            if(isset($params['status']) && $params['status'])
                $where[] = ['withdrawals.status_id', '=', $params['status']];

            if(isset($params['method']) && $params['method'])
                $where[] = ['withdrawals.method_id', '=', $params['method']];

            foreach(['id'] as $field) {
                if(isset($params[$field]) && $params[$field])
                    $where[] = ['withdrawals.' . $field, 'like', '%' . $params[$field] . '%'];
            }

            foreach(['creator', 'from', 'to'] as $field) {
                if(isset($params[$field]) && $params[$field])
                    $whereJoin[$field] = ['like', '%' . $params[$field] . '%'];
            }
        }

        $withdrawals = $this->findByParams([
            'start'     => $iDisplayStart,
            'count'     => $end - $iDisplayStart,
            'order'     => $order,
            'where'     => $where,
            'whereJoin' => $whereJoin
        ]);

        $linkStart = '<a href="/panel/admin/withdrawal/';
        $linkEndPaid = '/paid" class="btn default btn-xs purple b-edit" data-target="#ajax" data-toggle="modal"><i class="fa fa-edit"></i>' .  trans('mpouspehm::panel.statusPaid') . '</a>';
        $linkEndRejected = '/rejected" class="btn default btn-xs purple b-edit" data-target="#ajax" data-toggle="modal"><i class="fa fa-edit"></i>' .  trans('mpouspehm::panel.statusRejected') . '</a>';
        foreach($withdrawals as $withdrawal) {
            $records["data"][] = array(
                $withdrawal->id,
                $withdrawal->status_transaction ? $withdrawal->status_transaction->description : '',
                $withdrawal->type_conclusion ? $withdrawal->type_conclusion->name : '',
                $withdrawal->creator,
                $withdrawal->price,
                date_format(date_create($withdrawal->date), 'd M Y'),
                ($withdrawal->status_id == $status::STATUS_EXHIBITED) ?
                    '<div class="margin-bottom-5" >' . $linkStart . $withdrawal->id . $linkEndPaid . '</div>' . $linkStart . $withdrawal->id . $linkEndRejected
                    : ''
            );
        }

        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        echo json_encode($records);
    }

    public function findByParams($params){
        $query = $this->model
            ->leftJoin('status_transactions', 'status_transactions.id', '=', 'withdrawals.status_id')
            ->leftJoin('type_conclusions', 'type_conclusions.id', '=', 'withdrawals.method_id')
            ->leftJoin('users', 'users.id', '=', 'withdrawals.user_id')
            ->select('withdrawals.*', \DB::raw('CONCAT(users.surname, " ", users.name, " (", users.sid, ")") as creator')
            );

        if (isset($params['whereJoin'], $params['whereJoin']['creator'])) {
            $query->where(\DB::raw('CONCAT(users.surname, " ", users.name, " (", users.sid, ")")'),
                $params['whereJoin']['creator'][0], $params['whereJoin']['creator'][1]);
        }

        if (isset($params['whereJoin'], $params['whereJoin']['from'])) {
            $query->where(\DB::raw('CONCAT(users_from.surname, " ", users_from.name, " (", users_from.sid, ")")'),
                $params['whereJoin']['from'][0], $params['whereJoin']['from'][1]);
        }

        if (isset($params['whereJoin'], $params['whereJoin']['to'])) {
            $query->where(\DB::raw('CONCAT(users_to.surname, " ", users_to.name, " (", users_to.sid, ")")'),
                $params['whereJoin']['to'][0], $params['whereJoin']['to'][1]);
        }

        if (isset($params['order'], $params['order']['field'], $params['order']['dir']))
            $query->orderBy($params['order']['field'], $params['order']['dir']);

        if (isset($params['where']))
            foreach($params['where'] as $where) {
                $query->where($where[0], $where[1], $where[2]);
            }

        if (isset($params['start']) && $params['start'])
            $query->skip($params['start']);

        if (isset($params['count']) && $params['count'])
            $query->take($params['count']);

        return $query->get();
    }

    /**
     * Измнение статусы запроса на вывод средств
     * @param $id
     * @param $status
     * @return bool
     */
    public function changeWithdrawalStatus($id, $status)
    {
        try {
            $withdrawal = $this->find($id);
            $withdrawal->status_id = $status;

            if ($withdrawal->save()) {
                return $withdrawal;
            }
        } catch (\Exception $e) {}

        return false;
    }
}
