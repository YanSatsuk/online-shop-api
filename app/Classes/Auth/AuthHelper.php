<?php

namespace App\Classes\Auth;

use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\PasswordReset;
use Carbon\Carbon;
use App\User;

class AuthHelper
{
    /**
     * Get response messages with user
     * @param User $user
     * @return array
     */
    public static function responseWithUser(User $user)
    {
        $arrResponse = [
            'username' => $user->username,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'phone' => $user->phone,
        ];
        return $arrResponse;
    }

    /**
     * Create or update reset password request
     * @param $email
     * @return bool
     */
    public static function resetPasswordCreateRequest($email)
    {
        $result = false;
        $user = UsersCRUDHelper::findUserByEmail($email);
        if ($user) {
            $passwordReset = PasswordReset::updateOrCreate(
                ['email' => $email],
                ['token' => str_random(60)]
            );
            $user->notify(new PasswordResetRequest($passwordReset->token));
            $result = true;
        }
        return $result;
    }

    /**
     * Find reset password request
     * @param $token
     * @return mixed
     */
    public static function findResetPasswordRequest($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();
        if (
            $passwordReset &&
            Carbon::parse($passwordReset->updated_at)
                ->addMinutes(120)
                ->isFuture()
        ) {
            $passwordReset = [
                'email' => $passwordReset->email,
                'token' => $passwordReset->token
            ];
        } else if ($passwordReset) {
            $passwordReset->delete();
            $passwordReset = false;
        } else {
            $passwordReset = false;
        }
        return $passwordReset;
    }

    /**
     * Change password
     * @param array $data
     * @return bool
     */
    public static function changePassword(array $data)
    {
        $result = false;
        $passwordReset = PasswordReset::where([
            ['email', $data['email']],
            ['token', $data['token']]
        ])->first();
        if ($passwordReset) {
            $user = User::where('email', $data['email'])->first();
            $user->password = bcrypt($data['password']);
            $user->save();
            $passwordReset->delete();
            $user->notify(new PasswordResetSuccess($passwordReset));
            $result = true;
        }
        return $result;
    }
}
