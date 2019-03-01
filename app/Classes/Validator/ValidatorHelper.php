<?php

namespace App\Classes\Validator;

use Validator;

class ValidatorHelper
{
    const SIGN_UP = 'signUp';
    const LOGIN = 'login';
    const RESET_PASSWORD_REQUEST = 'resetPasswordReq';
    const RESET_PASSWORD = 'resetPassword';
    const NAME = 'name';
    const ID_NAME = 'idAndName';
    const NEW_GOODS = 'newGoods';
    const GOODS = 'goods';

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
        ],
        self::NAME => [
            'name' => 'required|string'
        ],
        self::ID_NAME => [
            'id' => 'required|numeric',
            'name' => 'required|string'
        ],
        self::NEW_GOODS => [
            'brand_id' => 'required|numeric',
            'model' => 'required|string',
            'price' => 'required|numeric',
            'rating' => 'numeric',
            'image_url' => 'required|string',
            'category_id' => 'required|numeric',
            'count' => 'required|numeric'
        ],
        self::GOODS => [
            'id' => 'required|numeric',
            'brand_id' => 'numeric',
            'model' => 'string',
            'price' => 'numeric',
            'rating' => 'numeric',
            'image_url' => 'string',
            'category_id' => 'numeric',
            'count' => 'numeric'
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
