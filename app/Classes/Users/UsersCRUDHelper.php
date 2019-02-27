<?php

namespace App\Classes\Users;

use App\User;

class UsersCRUDHelper
{
    /**
     * Add new user
     * @param array $data
     * @return User
     */
    public static function addUser(array $data)
    {
        $user = new User([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $user->save();
        return $user;
    }

    /**
     * Find user by email
     * @param string $email
     * @return mixed
     */
    public static function findUserByEmail(string $email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }
}
