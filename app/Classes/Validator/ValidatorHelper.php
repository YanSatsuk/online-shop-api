<?php

namespace App\Classes\Validator;

use Validator;

class ValidatorHelper
{
    const SIGN_UP = 'signUp';
    const LOGIN = 'login';
    const RESET_PASSWORD_REQUEST = 'resetPasswordReq';
    const RESET_PASSWORD = 'resetPassword';

    private $validateMap = [
        self::SIGN_UP => [
            'username' => 'required|string|min:2',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'password_confirm' => 'required|same:password'
        ],
        self::LOGIN => [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
            'remember_me' => 'boolean'
        ],
        self::RESET_PASSWORD_REQUEST => [
            'email' => 'required|string|email'
        ],
        self::RESET_PASSWORD => [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
            'password_confirm' => 'required|same:password',
            'token' => 'required|string'
        ]
    ];

    public static function init()
    {
        return new self();
    }

    /**
     * Validate array of data by validate map name
     * @param array $data
     * @param string $mapName
     * @return bool
     */
    public function validate(array $data, string $mapName)
    {
        $valid = true;
        $validator = Validator::make($data, $this->validateMap[$mapName]);
        if ($validator->fails()) {
            $valid = $validator->errors();
        }
        return $valid;
    }
}
