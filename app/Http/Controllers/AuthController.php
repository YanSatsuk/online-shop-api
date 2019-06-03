<?php

namespace App\Http\Controllers;

use App\Classes\Auth\AuthHelper;
use App\Classes\Responses\ResponseHelper;
use App\Classes\Users\UsersCRUDHelper;
use App\Classes\Validator\ValidatorHelper;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create new user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request)
    {
        $arrRes = null;
        $user = null;
        $data = $request->all();
        $validator = ValidatorHelper::init()->validate($data, ValidatorHelper::SIGN_UP);
        if ($validator === true) {
            $user = UsersCRUDHelper::addUser($data);
            $additionalResponse = AuthHelper::responseWithUser($user);
            $arrRes = ResponseHelper::init()->getResponseByName(
                ResponseHelper::CREATE_USER,
                ResponseHelper::CODE_200,
                $additionalResponse
            );
        } else {
            $arrRes = ResponseHelper::init()->getErrorResponse($validator);
        }
        return response()->json($arrRes);
    }

    /**
     * Login user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $arrRes = null;
        $data = $request->all();
        $validator = ValidatorHelper::init()->validate($data, ValidatorHelper::LOGIN);
        $resHelper = ResponseHelper::init();
        if ($validator === true) {
            $credentials = [
                'email' => $data['email'],
                'password' => $data['password']
            ];
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $additionalResponse = AuthHelper::responseWithUser($user);
                $arrRes = $resHelper->getResponseByName(
                    ResponseHelper::LOGIN,
                    ResponseHelper::CODE_200,
                    $additionalResponse
                );
            } else {
                $arrRes = $resHelper->getResponseByName(
                    ResponseHelper::LOGIN,
                    ResponseHelper::CODE_400
                );
            }
        } else {
            $arrRes = $resHelper->getErrorResponse($validator);
        }
        return response()->json($arrRes);
    }
}
