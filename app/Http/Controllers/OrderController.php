<?php

namespace App\Http\Controllers;

use App\Classes\Order\OrderHelper;
use App\Classes\Responses\ResponseHelper;
use App\Classes\Validator\ValidatorHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Make order
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function make(Request $request)
    {
        $arrRes = null;
        $data = $request->all();
        $validator = ValidatorHelper::init()->validate($data, ValidatorHelper::NEW_ORDER);
        if ($validator === true) {
            $order = OrderHelper::make($data);
            $arrRes = ResponseHelper::init()->getResponseByName(
                ResponseHelper::DEFAULT,
                ResponseHelper::CODE_200,
                $order
            );
        } else {
            $arrRes = ResponseHelper::init()->getErrorResponse($validator);
        }
        return response()->json($arrRes);
    }

    /**
     * Update order
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $arrRes = null;
        $data = $request->all();
        $validator = ValidatorHelper::init()->validate($data, ValidatorHelper::ORDER);
        if ($validator === true) {
            $order = OrderHelper::change($data);
            $arrRes = ResponseHelper::init()->getResponseByName(
                ResponseHelper::DEFAULT,
                ResponseHelper::CODE_200,
                $order
            );
        } else {
            $arrRes = ResponseHelper::init()->getErrorResponse($validator);
        }
        return response()->json($arrRes);
    }

    /**
     * Get all orders for user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllForUser()
    {
        $orders = OrderHelper::getOrdersByUserId(Auth::id());
        $res = ResponseHelper::init()->getResponseByName(
            ResponseHelper::DEFAULT,
            ResponseHelper::CODE_200,
            $orders
        );
        return response()->json($res);
    }

    /**
     * Get orders by status
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        $data = $request->all();
        $status = $data['status'] ? $data['status'] : null;
        $order = $data['order'] ? $data['order'] : null;
        $orders = OrderHelper::getOrdersByStatus($status, $order);
        $res = ResponseHelper::init()->getResponseByName(
            ResponseHelper::DEFAULT,
            ResponseHelper::CODE_200,
            $orders
        );
        return response()->json($res);
    }
}
