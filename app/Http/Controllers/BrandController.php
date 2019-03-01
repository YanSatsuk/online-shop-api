<?php

namespace App\Http\Controllers;

use App\Classes\Brand\BrandCRUDHelper;
use App\Classes\Responses\ResponseHelper;
use App\Classes\Validator\ValidatorHelper;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Add new brand
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $arrRes = null;
        $data = $request->all();
        $validator = ValidatorHelper::init()->validate($data, ValidatorHelper::NAME);
        if ($validator === true) {
            $brand = BrandCRUDHelper::add($data);
            $arrRes = ResponseHelper::init()->getResponseByName(
                ResponseHelper::DEFAULT,
                ResponseHelper::CODE_200,
                $brand
            );
        } else {
            $arrRes = ResponseHelper::init()->getErrorResponse($validator);
        }
        return response()->json($arrRes);
    }

    /**
     * Get all brands
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $brands = BrandCRUDHelper::getAll();
        $res = ResponseHelper::init()->getResponseByName(
            ResponseHelper::DEFAULT,
            ResponseHelper::CODE_200,
            $brands
        );
        return response()->json($res);
    }

    /**
     * Update brand
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $arrRes = null;
        $data = $request->all();
        $validator = ValidatorHelper::init()->validate($data, ValidatorHelper::ID_NAME);
        if ($validator === true) {
            $brand = BrandCRUDHelper::update($data);
            $arrRes = ResponseHelper::init()->getResponseByName(
                ResponseHelper::DEFAULT,
                ResponseHelper::CODE_200,
                $brand
            );
        } else {
            $arrRes = ResponseHelper::init()->getErrorResponse($validator);
        }
        return response()->json($arrRes);
    }

    /**
     * Remove brand
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove($id)
    {
        BrandCRUDHelper::remove($id);
        $res = ResponseHelper::init()->getResponseByName(
            ResponseHelper::DEFAULT,
            ResponseHelper::CODE_200
        );
        return response()->json($res);
    }
}
