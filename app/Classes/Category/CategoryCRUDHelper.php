<?php

namespace App\Classes\Category;

use App\Category;
use App\Interfaces\iBasicCRUD;

class CategoryCRUDHelper implements iBasicCRUD
{
    /**
     * Add new category
     * @param array $data
     * @return Category
     */
    public static function add(array $data)
    {
        $category = new Category($data);
        $category->save();
        return $category;
    }

    /**
     * Get all categories
     * @return mixed
     */
    public static function getAll()
    {
        $categories = Category::where('status', iBasicCRUD::ACTIVE)->get();
        return $categories;
    }

    /**
     * Update category
     * @param array $data
     */
    public static function update(array $data)
    {
        $category = Category::find($data['id']);
        $category->name = $data['name'];
        $category->save();
    }

    /**
     * Change status to inactive
     * @param $id
     */
    public static function remove(int $id)
    {
        $category = Category::find($id);
        $category->status = iBasicCRUD::INACTIVE;
        $category->save();
    }
}
