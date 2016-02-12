<?php namespace MPOproperty\Mposuccess\Repositories\Catalog;
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 10.09.2015
 * Time: 22:00
 */

use MPOproperty\Mposuccess\Models\Product;
use MPOproperty\Mposuccess\Repositories\Repository;

class ProductEntitiesRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {

        return 'MPOproperty\Mposuccess\Models\ProductEntities';
    }

    public function change($product_id, $entities_new, $counts_new)
    {
        $entities_old = $this->findAllBy('product_id', $product_id);

        $processed_ids = [];
        foreach ($entities_old as $entity) {
            if ($entities_new && in_array($entity->entity_id, $entities_new)) {
                $processed_ids[] = $entity->entity_id;

                $key = array_search($entity->entity_id, $entities_new);
                $count_new = $counts_new[$key];
                if ($entity->count != $count_new) {
                    $entity->count = $count_new;
                    $entity->save();
                }
            } else {
                $entity->delete();
            }
        }

        if ($entities_new != null && count($entities_new)) {
            $unprocessed_ids = array_diff ($entities_new, $processed_ids);
            foreach($unprocessed_ids as $id) {
                $key = array_search($id, $entities_new);
                $count  = $counts_new[$key];
                $this->create([
                    'product_id' => $product_id,
                    'entity_id'  => $id,
                    'count'      => $count
                ]);
            }
        }
    }
        /*$data['name'] = $data['title'];
        $data['price'] = $request->input('price');
        $data['percent'] = $request->input('percent');

        unset($data['title']);

        $productEntities = app('MPOproperty\Mposuccess\Repositories\Catalog\ProductEntitiesRepository');

        if ($request->input('id')) {
            $id = $request->input('id');

            if ($this->update($data, $id)) {
                $productEntities->change($id, $request->input('entities'), $request->input('counts'));
                return true;
            } else {
                return false;
            }

        }
    }*/
}