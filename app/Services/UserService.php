<?php

namespace App\Services;

use App\Common\ResultUtils;
use App\Models\UserModel;
use Exception;

class UserService extends BaseService
{

    private $users;
    /**
     * Construct
     */
    function __construct()
    {
        parent::__construct();
        $this->users = new UserModel();
        $this->users->protect(false);
    }

    public function getAllUsers()
    {
        return $this->users->findAll();
    }


    /**
     * Add new User
     */
    public function addUserInfo($requestData)
    {
        $validate = $this->validateAddUser($requestData);

        if ($validate->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => $validate->getErrors()
            ];
        }
        $dataSave = $requestData->getPost();
        unset($dataSave['password_confirm']);
        $dataSave['password'] = password_hash($dataSave['password'], PASSWORD_BCRYPT);
        try {
            $this->users->save($dataSave);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'messages' => ['success' => 'Thêm dữ liệu thành công']
            ];
        } catch (Exception $e) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => ['success' => $e->getMessage()]
            ];
        }
    }

    public function getUserByID($idUser)
    {
        return $this->users->where('id', $idUser);
    }

    private function validateAddUser($requestData)
    {
        $rule = [
            'email' => 'valid_email|is_unique[users.email]',
            'name' => 'max_length[100]',
            'password' => 'max_length[100]|min_length[6]',
            'password_confirm' => 'matches[password]',
        ];
        $message = [
            'email' => [
                'valid_email' => "Tài khoản {field} {value} không đúng định dạng!",
                'is_unique' => "Email đã được đăng ký vui lòng kiểm tra lại!"
            ],

            'name' => [
                'max_length' => "Tên quá dài, vui lòng nhập {param} ký tự",
            ],

            'password' => [
                'max_length' => "Mật khẩu quá dài, vui lòng nhập {param} ký tự",
                'min_length' => "Mật khẩu quá ngắn, vui lòng nhập {param} ký tự !"
            ],
            'password_confirm' => [
                'matches' => "Mật khẩu không trùng khớp!"
            ]

        ];
        $this->validation->setRules($rule, $message);
        $this->validation->withRequest($requestData)->run();

        return $this->validation;
    }
}
