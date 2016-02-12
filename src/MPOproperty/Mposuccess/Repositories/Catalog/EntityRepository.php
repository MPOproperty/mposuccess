<?php namespace MPOproperty\Mposuccess\Repositories\Catalog;
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 10.09.2015
 * Time: 22:00
 */

use MPOproperty\Mposuccess\Models\Entity;
use MPOproperty\Mposuccess\Repositories\Repository;

class EntityRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'MPOproperty\Mposuccess\Models\Entity';
    }

    public function findByParams($params){
        $query = $this->model->select('*');

        if (isset($params['order'], $params['order']['field'], $params['order']['dir']))
            $query->orderBy($params['order']['field'], $params['order']['dir']);

        if (isset($params['where']))
            foreach($params['where'] as $where) {
                $query->where($where[0], $where[1], $where[2]);
            }

        $count = $query->count();

        if (isset($params['start']) && $params['start'])
            $query->skip($params['start']);

        if (isset($params['count']) && $params['count'])
            $query->take($params['count']);

        return [
            'entities' => $query->get(),
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

        $columns = $params['columns'];

        $order = [
            'field' => $columns[$params['order'][0]['column']]['name'],
            'dir'   => $params['order'][0]['dir']
        ];

        $where = [];
        $action = isset($params['action']) ? $params['action'] : '';

        if ($action = 'filter') {
            foreach(['name', 'description'] as $field) {
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

        foreach($result['entities'] as $entity) {
            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $entity->id . '">',
                ($entity->image != '') ? '<div class="thumbnail"><span data-id="' . $entity->id .'" class="glyphicon glyphicon-remove"></span><img src="' . config('mposuccess.entities_storage_img') . $entity->image . '"/></div>' : '',
                $entity->name,
                $entity->description,
                '<div class="margin-bottom-5"><a href="/panel/admin/entity/' . $entity->id .'/edit" class="btn default btn-xs purple b-load" data-target="#ajax" data-toggle="modal"><i class="fa fa-edit"></i>' .  trans('mposuccess::panel.edit') . '</a></div>' .
                '<a data-href="/panel/admin/entity/' . $entity->id .'/delete" class="btn default btn-xs black b-delete" data-id-news="{{$item->id}}"><i class="fa fa-trash-o"></i>' . trans('mposuccess::panel.delete') . '</a>',
            );
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

    /**
     * Create/edit entity
     *
     * @return boolean
     */
    public function updateData($data, $request, $id)
    {
        if ($id) {
            $this->update($data, $id);

            $oldImg = $this->find($id, ['image'])->image;
        } else {
            $news = $this->create($data);

            if ($news) {
                $id = $news->id;
                $oldImg = null;
            } else {
                return false;
            }
        }

        /*
         *  Change/add (upload) image for news - if file uploaded
        */
        if ($request->hasFile('file'))
        {
            $destinationPath = config('mposuccess.entities_storage_img');
            $fileName = $id . '.' . $request->file('file')->getClientOriginalExtension();

            if ($oldImg) {
                if (file_exists(public_path() . $destinationPath . $oldImg)) {
                    unlink(public_path() . $destinationPath . $oldImg);
                }
            }

            $request->file('file')->move(public_path() . $destinationPath, $fileName);

            $this->update([
                'image' => $fileName
            ], $id);
        }

        return true;
    }

    public function deleteImage($id) {

        $entity = $this->find($id);

        if($entity && $entity->image) {
            $destinationPath = config('mposuccess.entities_storage_img');
            if (file_exists(public_path() . $destinationPath . $entity->image)) {
                unlink(public_path() . $destinationPath . $entity->image);
            }
            $entity->image = '';
            $entity->save();
        } else {
            return 1;
        }

        return 0;
    }
}