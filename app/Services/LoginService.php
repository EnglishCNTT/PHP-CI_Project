<?php

namespace App\Services;

use App\Common\ResultUtils;
use App\Models\PurchaseModel;
use App\Models\UserModel;
use Exception;

class LoginService extends BaseService
{

    private $users;
    /**
     * Construct
     */
    function __construct()
    {
        parent::__construct();
        $this->users = new UserModel();
    }

    public function hasLoginInfo($requestData)
    {
        $validate = $this->validateLogin($requestData);

        if ($validate->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => $validate->getErrors()
            ];
        }

        $params = $requestData->getPost();
        $user = $this->users->where('email', $params['email'])->first();

        if (!$user) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => [
                    'notExist' => 'Email không tồn tại!'
                ]
            ];
        }

        if (password_verify($params['password'], $user['password'])) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => [
                    'wrongPass' => 'Mật khẩu không đúng!'
                ]
            ];
        }

        $session = session();

        unset($user['password']);

        $session->set('user_login', $user);

        return [
            'status' => ResultUtils::STATUS_CODE_OK,
            'messageCode' => ResultUtils::MESSAGE_CODE_OK,
            'messages' => null
        ];
    }

    private function validateLogin($requestData)
    {
        $rule = [
            'email' => 'valid_email',
            'password' => 'max_length[30]|min_length[6]',
        ];

        $message = [
            'email' => [
                'valid_email' => 'Email không đúng định dạng'
            ],
            'password' => [
                'max_length' => 'Mật khẩu không được quá 30 ký tự',
                'min_length' => 'Mật khẩu không được ít hơn 6 ký tự'
            ]
        ];

        $this->validation->setRules($rule, $message);
        $this->validation->withRequest($requestData)->run();

        return $this->validation;
    }

    public function logoutUser()
    {
        $session = session();
        $session->destroy();
    }
}
