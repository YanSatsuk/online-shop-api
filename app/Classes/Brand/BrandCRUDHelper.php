<?php

namespace App\Classes\Brand;

use App\Brand;
use App\Interfaces\iBasicCRUD;

class BrandCRUDHelper implements iBasicCRUD
{
    /**
     * Add new brand
     * @param array $data
     * @return Brand
     */
    public static function add(array $data)
    {
        $brand = new Brand($data);
        $brand->save();
        return $brand;
    }

    /**
     * Get all brands
     * @return mixed
     */
    public static function getAll()
    {
        $brands = Brand::where('status', iBasicCRUD::ACTIVE)->get();
        return $brands;
    }

    /**
     * Update brand
     * @param array $data
     */
    public static function update(array $data)
    {
        $brand = Brand::find($data['id']);
        $brand->name = $data['name'];
        $brand->save();
    }

    /**
     * Change status to inactive
     * @param int $id
     */
    public static function remove(int $id)
    {
        $brand = Brand::find($id);
        $brand->status = iBasicCRUD::INACTIVE;
        $brand->save();
    }
}
