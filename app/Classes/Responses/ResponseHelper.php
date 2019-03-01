<?php

namespace App\Classes\Responses;

class ResponseHelper
{
    const CODE_200 = 200;
    const CODE_400 = 400;
    private const MESSAGE = 'message';
    private const CODE = 'code';
    private const ERROR = 'error';
    private const SUCCESS = 'success';
    private const FAILED = 'failed';
    const CREATE_USER = 'createUser';
    const LOGIN = 'login';
    const RESET_PASSWORD_REQUEST = 'resetPasswordReq';
    const FIND_PASSWORD_RESET_TOKEN = 'findResetToken';
    const REST_PASSWORD = 'resetPassword';
    const DEFAULT = 'default';

    private $responsesMap = [
        self::CREATE_USER => [
            self::CODE_200 => 'User created successfully.',
            self::CODE_400 => self::FAILED
        ],
        self::LOGIN => [
            self::CODE_200 => self::SUCCESS,
            self::CODE_400 => 'Unauthorized.'
        ],
        self::RESET_PASSWORD_REQUEST => [
            self::CODE_200 => 'We have e-mailed your password reset link!',
            self::CODE_400 => "We can't find a user with that e-mail address."
        ],
        self::FIND_PASSWORD_RESET_TOKEN => [
            self::CODE_200 => 'Token is valid.',
            self::CODE_400 => 'This password reset token is invalid.'
        ],
        self::REST_PASSWORD => [
            self::CODE_200 => 'Password changed successfully.',
            self::CODE_400 => 'This password reset token is invalid.'
        ],
        self::DEFAULT => [
            self::CODE_200 => self::SUCCESS,
            self::CODE_400 => self::FAILED
        ]
    ];

    public static function init()
    {
        return new self();
    }

    /**
     * Return response message and code
     * @param string $messageName
     * @param int $code
     * @param null $values
     * @return array
     */
    public function getResponseByName(string $messageName, int $code, $values = null)
    {
        $arrReturn = [];
        if (
            array_key_exists($messageName, $this->responsesMap) &&
            array_key_exists($code, $this->responsesMap[$messageName])
        ) {
            $arrReturn = [
                self::CODE => $code,
                self::MESSAGE => $this->responsesMap[$messageName][$code]
            ];
            if (!is_null($values)) {
                $arrReturn['data'] = $values;
            }
        }
        return $arrReturn;
    }

    /**
     * Return response with error
     * @param $errorMessage
     * @param int $code
     * @return array
     */
    public function getErrorResponse($errorMessage, $code = self::CODE_400)
    {
        $arrReturn = [];
        if (
            $errorMessage !== null &&
            !empty($errorMessage)
        ) {
            $arrReturn = [
                self::CODE => $code,
                self::ERROR => $errorMessage
            ];
        }
        return $arrReturn;
    }
}
