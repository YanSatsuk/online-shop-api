<?php

namespace App\Http\Controllers;

use App\Classes\Goods\GoodsCRUDHelper;
use App\Classes\Responses\ResponseHelper;
use App\Classes\Validator\ValidatorHelper;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * Add new goods
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $arrRes = null;
        $data = $request->all();
        $validator = ValidatorHelper::init()->validate($data, ValidatorHelper::NEW_GOODS);
        if ($validator === true) {
            $goods = GoodsCRUDHelper::add($data);
            $arrRes = ResponseHelper::init()->getResponseByName(
                ResponseHelper::DEFAULT,
                ResponseHelper::CODE_200,
                $goods
            );
        } else {
            $arrRes = ResponseHelper::init()->getErrorResponse($validator);
        }
        return response()->json($arrRes);
    }

    /**
     * Get all goods
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $goods = GoodsCRUDHelper::getAll();
        $res = ResponseHelper::init()->getResponseByName(
            ResponseHelper::DEFAULT,
            ResponseHelper::CODE_200,
            $goods
        );
        return response()->json($res);
    }

    /**
     * Update goods
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $arrRes = null;
        $data = $request->all();
        $validator = ValidatorHelper::init()->validate($data, ValidatorHelper::GOODS);
        if ($validator === true) {
            $goods = GoodsCRUDHelper::update($data);
            $arrRes = ResponseHelper::init()->getResponseByName(
                ResponseHelper::DEFAULT,
                ResponseHelper::CODE_200,
                $goods
            );
        } else {
            $arrRes = ResponseHelper::init()->getErrorResponse($validator);
        }
        return response()->json($arrRes);
    }

    /**
     * Remove goods
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove($id)
    {
        GoodsCRUDHelper::remove($id);
        $res = ResponseHelper::init()->getResponseByName(
            ResponseHelper::DEFAULT,
            ResponseHelper::CODE_200
        );
        return response()->json($res);
    }
}
