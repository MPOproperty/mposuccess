<?php namespace MPOproperty\Mpouspehm\Repositories\Catalog;
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 10.09.2015
 * Time: 22:00
 */

use MPOproperty\Mpouspehm\Models\Product;
use MPOproperty\Mpouspehm\Repositories\Repository;

class ProductRepository extends Repository {

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {

        return 'MPOproperty\Mpouspehm\Models\Product';
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

        $productEntities = app('MPOproperty\Mpouspehm\Repositories\Catalog\ProductEntitiesRepository');

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
                $levelDesc = trans('mpouspehm::payment.level.level1');
                break;
            case 2:
                $levelDesc = trans('mpouspehm::payment.level.level2');
                break;
            case 4:
                $levelDesc = trans('mpouspehm::payment.level.level4');
                break;
            case 5:
                $levelDesc = trans('mpouspehm::payment.level.level5');
                break;
            default:
                return '';
        }


        return trans('mpouspehm::payment.paymentProduct') . ' ' . $levelDesc .', ' . trans('mpouspehm::payment.placeCount') . ': ' . $count;
    }
}