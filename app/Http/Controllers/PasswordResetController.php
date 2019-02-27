<?php

namespace App\Http\Controllers;

use App\Classes\Auth\AuthHelper;
use App\Classes\Responses\ResponseHelper;
use App\Classes\Validator\ValidatorHelper;
use Illuminate\Http\Request;
use Validator;

class PasswordResetController extends Controller
{
    /**
     * Create token for reset password by email
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $arrRes = null;
        $email = $request->email;
        $validator = ValidatorHelper::init()->validate($email, ValidatorHelper::RESET_PASSWORD_REQUEST);
        $resHelper = ResponseHelper::init();
        if ($validator === true) {
            $passwordReset = AuthHelper::resetPasswordCreateRequest($email);
            if ($passwordReset) {
                $arrRes = $resHelper->getResponseByName(
                    ResponseHelper::RESET_PASSWORD_REQUEST,
                    ResponseHelper::CODE_200
                );
            } else {
                $arrRes = $resHelper->getResponseByName(
                    ResponseHelper::RESET_PASSWORD_REQUEST,
                    ResponseHelper::CODE_400
                );
            }
        } else {
            $arrRes = $resHelper->getErrorResponse($validator);
        }
        return response()->json($arrRes);
    }

    /**
     * Find token for reset password
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function find($token)
    {
        $arrRes = null;
        $passwordReset = AuthHelper::findResetPasswordRequest($token);
        if ($passwordReset) {
            $arrRes = ResponseHelper::init()->getResponseByName(
                ResponseHelper::FIND_PASSWORD_RESET_TOKEN,
                ResponseHelper::CODE_200,
                $passwordReset
            );
        } else {
            $arrRes = ResponseHelper::init()->getResponseByName(
                ResponseHelper::FIND_PASSWORD_RESET_TOKEN,
                ResponseHelper::CODE_400
            );
        }
        return response()->json($arrRes);
    }

    /**
     * Reset password
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $arrRes = null;
        $data = $request->all();
        $resHelper = ResponseHelper::init();
        $validator = ValidatorHelper::init()->validate($data, ValidatorHelper::RESET_PASSWORD);
        if ($validator) {
            $result = AuthHelper::changePassword($data);
            if ($result) {
                $arrRes = $resHelper->getResponseByName(
                    ResponseHelper::REST_PASSWORD,
                    ResponseHelper::CODE_200
                );
            } else {
                $arrRes = $resHelper->getResponseByName(
                    ResponseHelper::REST_PASSWORD,
                    ResponseHelper::CODE_400
                );
            }
        } else {
            $arrRes = $resHelper->getErrorResponse($validator);
        }
        return response()->json($arrRes);
    }
}
