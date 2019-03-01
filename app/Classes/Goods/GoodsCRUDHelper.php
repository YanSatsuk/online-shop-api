<?php

namespace App\Classes\Goods;

use App\Goods;
use App\Interfaces\iBasicCRUD;

class GoodsCRUDHelper implements iBasicCRUD
{
    /**
     * Add new goods
     * @param array $data
     * @return Goods
     */
    public static function add(array $data)
    {
        $goods = new Goods($data);
        $goods->save();
        return $goods;
    }

    /**
     * Get all goods
     * @return mixed
     */
    public static function getAll()
    {
        $goods = Goods::where('status', iBasicCRUD::ACTIVE)->get();
        return $goods;
    }

    /**
     * Update goods
     * @param array $data
     */
    public static function update(array $data)
    {
        $goods = Goods::find($data['id']);
        $goods->update($data);
    }

    /**
     * Change status to inactive
     * @param int $id
     */
    public static function remove(int $id)
    {
        $goods = Goods::find($id);
        $goods->status = iBasicCRUD::INACTIVE;
        $goods->save();
    }
}
