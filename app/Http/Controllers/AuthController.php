<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Create new user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request)
    {
        $arrRes = [];
        $status = 200;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'password_confirm' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            $arrRes['error'] = $validator->errors();
            $status = 400;
        } else {
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $user->save();
            $token = $this->getToken($user);
            $arrRes = $this->successRes($arrRes, $user, $token);
            $arrRes['message'] = 'User created successfully';
            $status = 201;
        }

        return response()->json($arrRes, $status);
    }

    /**
     * Login user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $arrRes = [];
        $status = 200;

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
            'remember_me' => 'boolean'
        ]);

        if ($validator->fails()) {
            $arrRes['error'] = $validator->errors();
            $status = 400;
        } else {
            $credentials = request(['email', 'password']);
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $this->getToken($user, $request->remember_me);
                $arrRes = $this->successRes($arrRes, $user, $token);
            } else {
                $arrRes['message'] = 'Unauthorized';
                $status = 400;
            }
        }

        return response()->json($arrRes, $status);
    }

    /**
     * Get token
     *
     * @param $user
     * @param bool $remember_me
     * @return mixed
     */
    private function getToken($user, $remember_me = false)
    {
        $token = $user->createToken('token');
        $created_at = $token->token->created_at;

        $remember_me ?
            $token->token->expires_at = Carbon::parse($created_at)->addMonth() :
            $token->token->expires_at = Carbon::parse($created_at)->addHours(2);
        $token->token->save();

        return $token;
    }

    /**
     * Success response with token
     *
     * @param $arrRes
     * @param $user
     * @param $token
     * @return mixed
     */
    private function successRes($arrRes, $user, $token)
    {
        $arrRes['name'] = $user->name;
        $arrRes['token'] = $token->accessToken;
        $arrRes['expires_at'] = (string) $token->token->expires_at;
        return $arrRes;
    }
}
