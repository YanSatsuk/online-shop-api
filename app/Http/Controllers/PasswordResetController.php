<?php

namespace App\Http\Controllers;

use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\PasswordReset;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class PasswordResetController extends Controller
{
    /**
     * Create token for reset password by email
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $arrRes = [];
        $status = 200;
        $email = $request->email;

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email'
        ]);

        if ($validator->fails()) {
            $arrRes['message'] = $validator->errors();
            $status = 400;
        } else {
            $user = User::where('email', $email)->first();
            if ($user) {
                $passwordReset = PasswordReset::updateOrCreate(
                    ['email' => $user->email],
                    ['token' => str_random(60)]
                );
                $user->notify(new PasswordResetRequest($passwordReset->token));
                $arrRes['message'] = 'We have e-mailed your password reset link!';
            } else {
                $arrRes['message'] = "We can't find a user with that e-mail address.";
                $status = 404;
            }
        }

        return response()->json($arrRes, $status);
    }

    /**
     * Find token for reset password
     *
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function find($token)
    {
        $arrRes = [];
        $status = 200;
        $message = 'This password reset token is invalid.';

        $passwordReset = PasswordReset::where('token', $token)->first();
        if (
            $passwordReset &&
            Carbon::parse($passwordReset->updated_at)
                ->addMinutes(120)
                ->isFuture()
        ) {
            $arrRes['email'] = $passwordReset->email;
            $arrRes['token'] = $passwordReset->token;
        } else if ($passwordReset) {
            $passwordReset->delete();
            $arrRes['message'] = $message;
            $status = 404;
        } else {
            $arrRes['message'] = $message;
            $status = 404;
        }

        return response()->json($arrRes, $status);
    }

    /**
     * Reset password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $arrRes = [];
        $status = 200;

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
            'password_confirm' => 'required|same:password',
            'token' => 'required|string'
        ]);

        if ($validator->fails()) {
            $arrRes['message'] = $validator->errors();
            $status = 400;
        } else {
            $passwordReset = PasswordReset::where([
                ['email', $request->email],
                ['token', $request->token]
            ])->first();
            if ($passwordReset) {
                $user = User::where('email', $passwordReset->email)->first();
                $user->password = bcrypt($request->password);
                $user->save();
                $passwordReset->delete();
                $user->notify(new PasswordResetSuccess($passwordReset));
                $arrRes['message'] = 'Password changed successfully.';
            } else {
                $arrRes['message'] = 'This password reset token is invalid.';
                $status = 400;
            }
        }

        return response()->json($arrRes, $status);
    }
}
