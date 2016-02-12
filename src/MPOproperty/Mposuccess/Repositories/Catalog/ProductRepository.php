<?php namespace MPOproperty\Mposuccess\Repositories\Catalog;
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 10.09.2015
 * Time: 22:00
 */

use MPOproperty\Mposuccess\Models\Product;
use MPOproperty\Mposuccess\Repositories\Repository;

class ProductRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {

        return 'MPOproperty\Mposuccess\Models\Product';
    }

    /**
     * Create/edit product
     *
     * @return boolean
     */
    public function updateData($data, $request)
    {
        $data['name'] = $data['title'];
        $data['price'] = $request->input('price');
        $data['percent'] = $request->input('percent');
        $data['count'] = $request->input('count');
        $data['level'] = $request->input('level');
        if (!in_array($data['level'], [1,2,4,5])) {
            $data['level'] = 1;
        }

        unset($data['title']);

        $productEntities = app('MPOproperty\Mposuccess\Repositories\Catalog\ProductEntitiesRepository');

        if ($request->input('id')) {
            $id = $request->input('id');

            $this->update($data, $id);
            $productEntities->change($id, $request->input('entities'), $request->input('counts'));
            return true;
        } else {
            if ($product = $this->create($data)) {

                $productEntities->change($product->id, $request->input('entities'), $request->input('counts'));
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Get price by level id
     * @param $level
     * @return mixed
     */
    public function getPriceByLevel($level)
    {
        $currentProduct = $this->find($level);

        if(!isset($currentProduct->coast)) {
            throw new \InvalidArgumentException("Цена заказа должна существовать.");
        }

        return $currentProduct->coast;
    }

    /**
     * Получение описания покупки уровня и количества места
     *
     * @param $level
     * @param $count
     * @return string
     */
    public static function getDescriptionByLevel($level, $count)
    {
        $levelDesc = '';

        switch ($level) {
            case 1:
                $levelDesc = trans('mposuccess::payment.level.level1');
                break;
            case 2:
                $levelDesc = trans('mposuccess::payment.level.level2');
                break;
            case 4:
                $levelDesc = trans('mposuccess::payment.level.level4');
                break;
            case 5:
                $levelDesc = trans('mposuccess::payment.level.level5');
                break;
            default:
                return '';
        }


        return trans('mposuccess::payment.paymentProduct') . ' ' . $levelDesc .', ' . trans('mposuccess::payment.placeCount') . ': ' . $count;
    }
}