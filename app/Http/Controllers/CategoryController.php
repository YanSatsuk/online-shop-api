<?php

namespace App\Http\Controllers;

use App\Classes\Category\CategoryCRUDHelper;
use App\Classes\Responses\ResponseHelper;
use App\Classes\Validator\ValidatorHelper;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Add new category
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $arrRes = null;
        $data = $request->all();
        $validator = ValidatorHelper::init()->validate($data, ValidatorHelper::NAME);
        if ($validator === true) {
            $category = CategoryCRUDHelper::add($data['name']);
            $arrRes = ResponseHelper::init()->getResponseByName(
                ResponseHelper::DEFAULT,
                ResponseHelper::CODE_200,
                $category
            );
        } else {
            $arrRes = ResponseHelper::init()->getResponseByName(
                ResponseHelper::DEFAULT,
                ResponseHelper::CODE_400
            );
        }
        return response()->json($arrRes);
    }

    /**
     * Get all categories
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $categories = CategoryCRUDHelper::getAll();
        $res = ResponseHelper::init()->getResponseByName(
            ResponseHelper::DEFAULT,
            ResponseHelper::CODE_200,
            $categories
        );
        return response()->json($res);
    }

    /**
     * Update category
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $arrRes = null;
        $data = $request->all();
        $validator = ValidatorHelper::init()->validate($data, ValidatorHelper::ID_NAME);
        if ($validator === true) {
            $category = CategoryCRUDHelper::update($data);
            $arrRes = ResponseHelper::init()->getResponseByName(
                ResponseHelper::DEFAULT,
                ResponseHelper::CODE_200,
                $category
            );
        } else {
            $arrRes = ResponseHelper::init()->getResponseByName(
                ResponseHelper::DEFAULT,
                ResponseHelper::CODE_400
            );
        }
        return response()->json($arrRes);
    }

    /**
     * Remove category
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove($id)
    {
        CategoryCRUDHelper::remove($id);
        $res = ResponseHelper::init()->getResponseByName(
            ResponseHelper::DEFAULT,
            ResponseHelper::CODE_200
        );
        return response()->json($res);
    }
}
