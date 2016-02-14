<?php

namespace MPOproperty\Mpouspehm\Repositories\Transaction;

use Illuminate\Support\Facades\DB;
use MPOproperty\Mpouspehm\Models\Transaction;
use MPOproperty\Mpouspehm\Repositories\Repository;
use DB as DBTransaction;

class TransactionRepository extends Repository
{
    /**
     * Идентификатор компании. Может указываться в полях from/to в зависимости от типа транзакции.
     */
    CONST COMPANY_ID = 1;

    /**
     * Описание транзакции по умолчанию
     */
    CONST DEFAULT_DESCRIPTION = "Оплата";

    /**
     * @var
     */
    private $transaction;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'MPOproperty\Mpouspehm\Models\Transaction';
    }

    /**
     * Создание транзакции
     *
     * @param $params
     * @return Transaction
     * @throws \Exception
     */
    public function createTransaction($params)
    {
        $transaction = new Transaction();

        self::transactionValidation($params);

        $transaction->status_id = isset($params['status']) ? $params['status'] : StatusTransactionRepository::STATUS_EXHIBITED;
        $transaction->type_id = $params['type'];
        $transaction->user_id = isset($params['user']) ? $params['user'] : $params['from'];
        $transaction->description = isset($params['description']) ? $params['description'] : self::DEFAULT_DESCRIPTION;
        $transaction->price = $params['price'];
        $transaction->from = $params['from'];
        $transaction->to = $params['to'];
        $transaction->sid = md5(uniqid(rand(), true));

        if ($transaction->save()) {
            $this->transaction = $transaction;
        }
    }

    /**
     * Валидация
     *
     * @param $params
     * @throws \Exception
     */
    public function transactionValidation($params)
    {
        if (!isset($params['type'])) {
            throw new \Exception('Не указан тип транзакции');
        }

        if (!isset($params['price'])) {
            throw new \Exception('Не указана цена транзакции');
        }
    }

    /**
     * Изменение статуса транзакции
     *
     * @param $transactionId
     * @param $status
     * @return mixed
     */
    public function editStatusTransaction($transactionId, $status)
    {
        $transaction = Transaction::find($transactionId);
        $transaction->status = $status;

        return $transaction->save();
    }


    public function findByParams($params)
    {
        $query = $this->model
            ->leftJoin('type_transactions', 'type_transactions.id', '=', 'transactions.type_id')
            ->leftJoin('status_transactions', 'status_transactions.id', '=', 'transactions.status_id')
            ->leftJoin('users', 'users.id', '=', 'transactions.user_id')
            ->leftJoin('users as users_from', 'users_from.id', '=', 'transactions.from')
            ->leftJoin('users as users_to', 'users_to.id', '=', 'transactions.to')
            ->select('transactions.*',
                \DB::raw('CONCAT(users.surname, " ", users.name, " (", users.sid, ")") as creator'),
                \DB::raw('CONCAT(users_from.surname, " ", users_from.name, " (", users_from.sid, ")") as user_from'),
                \DB::raw('CONCAT(users_to.surname, " ", users_to.name, " (", users_to.sid, ")") as user_to')
            );

        if (isset($params['whereJoin'], $params['whereJoin']['creator'])) {
            $query->where(\DB::raw('CONCAT(users.surname, " ", users.name, " (", users.sid, ")")'),
                $params['whereJoin']['creator'][0], $params['whereJoin']['creator'][1]);
        }

        if (isset($params['whereJoin'], $params['whereJoin']['description'])) {
            $query->where(
                'transactions.description',
                $params['whereJoin']['description'][0],
                $params['whereJoin']['description'][1]);
        }

        if (isset($params['whereJoin'], $params['whereJoin']['from'])) {
            $query->where(\DB::raw('CONCAT(users_from.surname, " ", users_from.name, " (", users_from.sid, ")")'),
                $params['whereJoin']['from'][0], $params['whereJoin']['from'][1]);
        }

        if (isset($params['whereJoin'], $params['whereJoin']['to'])) {
            $query->where(\DB::raw('CONCAT(users_to.surname, " ", users_to.name, " (", users_to.sid, ")")'),
                $params['whereJoin']['to'][0], $params['whereJoin']['to'][1]);
        }

        if (isset($params['where'])) {
            foreach ($params['where'] as $where) {
                if(is_array($where[1])) {
                    $query->whereIn($where[0], $where[1]);
                } else {
                    $query->where($where[0], $where[1], $where[2]);
                }
            }
        }

        if ($params['userId']) {
            $query
                ->where(function ($q) use ($params) {
                    $q->where('user_id', '=', $params['userId'])
                        ->orWhere('from', '=', $params['userId'])
                        ->orWhere('to', '=', $params['userId']);
                });
        }

        $count = $query->count();

        if (isset($params['order'], $params['order']['field'], $params['order']['dir'])) {
            $query->orderBy($params['order']['field'], $params['order']['dir']);
        }

        if (isset($params['start']) && $params['start']) {
            $query->skip($params['start']);
        }

        if (isset($params['count']) && $params['count']) {
            $query->take($params['count']);
        }

        return [
        'transactions' => $query->get(),
        'count' => $count
    ];
    }

    /**
     * @param $params
     * @param bool $userId идентификатор пользователя, елси есть, то получать данные только для указанного юзера
     * @param null $typeTransaction если есть, то получить только транзакции для переданных типов (в массиве id)
     * @param bool $isAllField если false - то выводить тип таблицы, как для покупок или бонусов, иначе - как для транзакций
     */
    public function findByParamsForTable($params, $userId = false, $typeTransaction = null, $isAllField = true)
    {
        $iTotalRecords = $this->all()->count();
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);

        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        /*$status_list = array(
            "badUser" => "danger",
            "User" => "info",
            "Moderator" => "warning",
            "Admin" => "success"
        );*/

        $columns = $params['columns'];

        $order = [
            'field' => $columns[$params['order'][0]['column']]['name'],
            'dir' => $params['order'][0]['dir']
        ];

        $where = [];
        $whereJoin = [];
//        $action = isset($params['action']) ? $params['action'] : '';

        if ($action = 'filter') {
            if (isset($params['price_from']) && $params['price_from']) {
                $where[] = ['price', '>=', $params['price_from'] * 100];
            }

            if (isset($params['price_to']) && $params['price_to']) {
                $where[] = ['price', '<=', $params['price_to'] * 100];
            }

            if (isset($params['date_from']) && $params['date_from']) {
                $where[] = [
                    'transactions.created_at',
                    '>=',
                    preg_replace("/(\d+)\D+(\d+)\D+(\d+)/", "$3-$2-$1", $params['date_from'])
                ];
            }

            if (isset($params['date_to']) && $params['date_to']) {
                $where[] = [
                    'transactions.created_at',
                    '<=',
                    preg_replace("/(\d+)\D+(\d+)\D+(\d+)/", "$3-$2-$1 23:59:59", $params['date_to'])
                ];
            }

            if (isset($params['status']) && $params['status']) {
                $where[] = ['status_transactions.id', '=', $params['status']];
            }

            if (isset($params['type']) && $params['type']) {
                $where[] = ['type_transactions.id', '=', $params['type']];
            }

            foreach (['id'] as $field) {
                if (isset($params[$field]) && $params[$field]) {
                    $where[] = ['transactions.' . $field, 'like', '%' . $params[$field] . '%'];
                }
            }

            foreach (['creator', 'from', 'to', 'description'] as $field) {
                if (isset($params[$field]) && $params[$field]) {
                    $whereJoin[$field] = ['like', '%' . $params[$field] . '%'];
                }
            }
        }

        // Выводить нужно только покупки
        if ($userId && $typeTransaction) {
            $where[] = ['type_transactions.id', $typeTransaction];
        }

        $result = $this->findByParams([
            'start' => $iDisplayStart,
            'count' => $end - $iDisplayStart,
            'order' => $order,
            'where' => $where,
            'whereJoin' => $whereJoin,
            'userId' => $userId
        ]);

        if(!$isAllField) {
            foreach ($result['transactions'] as $transaction) {
                $records["data"][] = array(
                    $transaction->id,
                    $transaction->price,
                    date_format(date_create($transaction->created_at), 'd M Y H:i:s'),
                    $transaction->description,
                    ''
                );
            }
        } else {
            foreach ($result['transactions'] as $transaction) {
                $records["data"][] = array(
                    '<input type="checkbox" name="id[]" value="' . $transaction->id . '">',
                    $transaction->id,
                    $transaction->status_transaction ? $transaction->status_transaction->description : '',
                    $transaction->type_transaction ? $transaction->type_transaction->description : '',
                    //$transaction->user ? $transaction->user->surname . ' ' . $transaction->user->name . ' (' . $transaction->user->sid . ')' : '',
                    $transaction->creator,
                    $transaction->price,
                    $transaction->user_from,
                    $transaction->user_to,
                    //$transaction->from ? $transaction->from_user_id->surname . ' ' . $transaction->from_user_id->name . ' (' . $transaction->from_user_id->sid . ')': '',
                    //$transaction->to ? $transaction->to_user_id->surname . ' ' .  $transaction->to_user_id->name . ' (' . $transaction->to_user_id->sid . ')' : '',
                    date_format(date_create($transaction->created_at), 'd M Y H:i:s'),
                    ''
//                    '<a href="/panel/admin/payments/' . $transaction->id . '/edit" class="btn default btn-xs purple b-edit" data-target="#ajax" data-toggle="modal"><i class="fa fa-edit"></i>' . trans('mpouspehm::panel.edit') . '</a>'
                );
            }
        }

        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $result['count'];//$iTotalRecords;
        $records["recordsFiltered"] = $result['count'];//$iTotalRecords;

        echo json_encode($records);
    }

    /**
     * Внутреннее пополнение счета
     *
     * @param $userId
     * @param $price
     * @param null $description
     * @return bool
     */
    public function transactionRefillBalance($userId, $price, $description = null)
    {
        DBTransaction::transaction(function () use ($userId, $description, $price) {

            $type = app('MPOproperty\Mpouspehm\Repositories\Transaction\TypeTransactionRepository');
            $status = app('MPOproperty\Mpouspehm\Repositories\Transaction\StatusTransactionRepository');

            $transactionData = [
                'status' => $status::STATUS_EXHIBITED,
                'type' => $type::TYPE_INTAKE_INTERNAL,
                'user' => $userId,
                'description' => isset($description) ? $description : trans('mpouspehm::payment.descriptions.INTAKE_INTERNAL'),
                'price' => $price,
                'from' => 0,
                'to' => 0
            ];

            $this->createTransaction($transactionData);
        });

        return isset($this->transaction->sid) ? $this->transaction->sid : false;
    }

    /**
     * Вывод средств
     *
     * @param $userId
     * @param $price
     * @return bool
     */
    public function transactionWithdrawal($userId, $price)
    {
        DBTransaction::transaction(function () use ($userId, $price) {

            $type = app('MPOproperty\Mpouspehm\Repositories\Transaction\TypeTransactionRepository');
            $status = app('MPOproperty\Mpouspehm\Repositories\Transaction\StatusTransactionRepository');

            $transactionData = [
                'status' => $status::STATUS_PAID,
                'type' => $type::TYPE_WITHDRAWAL,
                'user' => $userId,
                'description' => trans('mpouspehm::payment.descriptions.TYPE_WITHDRAWAL'),
                'price' => $price,
                'from' => 0,
                'to' => 0
            ];

            $this->createTransaction($transactionData);
        });

        return isset($this->transaction->sid) ? $this->transaction->sid : false;
    }

    /**
     * Изменение статуса транзакции
     *
     * @param $transactionSid
     * @param $status
     * @return bool
     */
    public function changeTransactionStatus($transactionSid, $status)
    {
        try {
            $transaction = Transaction::where('sid', '=', $transactionSid)->firstOrFail();
            $transaction->status_id = $status;

            if ($transaction->save()) {
                return $transaction;
            }
        } catch (\Exception $e) {
        }

        return false;
    }

}