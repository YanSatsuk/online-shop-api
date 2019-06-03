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
        $user = new User($data);
        $user->password = bcrypt($data['password']);
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

    /**
     * Get all clients
     * @return mixed
     */
    public static function getAllClients()
    {
        $users = User::where('role', User::CLIENT)->get();
        return $users;
    }
}
