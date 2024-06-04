<?php

namespace App\Services;

use App\Common\ResultUtils;
use App\Models\PurchaseModel;
use Exception;

class PurchaseService extends BaseService
{

    private $purchases;
    /**
     * Construct
     */
    function __construct()
    {
        parent::__construct();
        $this->purchases = new PurchaseModel();
        $this->purchases->protect(false);
    }

    public function getAllpurchases()
    {
        return $this->purchases->findAll();
    }


    /**
     * Add new Purchase
     */
    public function addPurchaseInfo($requestData)
    {
        $validate = $this->validateAddPurchase($requestData);

        if ($validate->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => $validate->getErrors()
            ];
        }
        $dataSave = $requestData->getPost();
        try {
            $this->purchases->save($dataSave);
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

    public function updatePurchaseInfo($requestData)
    {
        $validate = $this->validateEditPurchase($requestData);

        if ($validate->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => $validate->getErrors()
            ];
        }
        $dataSave = $requestData->getPost();

        try {
            $this->purchases->save($dataSave);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'messages' => ['success' => 'Cập nhật dữ liệu thành công']
            ];
        } catch (Exception $e) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => ['success' => $e->getMessage()]
            ];
        }
    }

    public function getPurchaseByID($idPurchase)
    {
        return $this->purchases->where('id', $idPurchase)->first();
    }

    public function deletePurchase($id)
    {
        try {
            $this->purchases->delete($id);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'messageCode' => ResultUtils::MESSAGE_CODE_OK,
                'messages' => ['success' => 'Xóa dữ liệu thành công']
            ];
        } catch (Exception $e) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'messageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => ['success' => $e->getMessage()]
            ];
        }
    }

    private function validateAddPurchase($requestData)
    {
        $rule = [
            'name' => 'max_length[100]',
            'email_address' => 'max_length[100]',
            'storage' => 'max_length[100]',
            'databases' => 'max_length[100]',
            'domains' => 'max_length[100]',
            'price' => 'max_length[100]',
        ];
        $message = [
            'name' => [
                'max_length' => "Tên quá dài, vui lòng nhập {param} ký tự",
            ],
            'email_address' => [
                'max_length' => "Email quá dài, vui lòng nhập {param} ký tự",
            ],
            'storage' => [
                'max_length' => "Dung lượng quá dài, vui lòng nhập {param} ký tự",
            ],
            'databases' => [
                'max_length' => "Số lượng database quá dài, vui lòng nhập {param} ký tự",
            ],
            'domains' => [
                'max_length' => "Số lượng domains quá dài, vui lòng nhập {param} ký tự",
            ],
            'price' => [
                'max_length' => "Giá quá dài, vui lòng nhập {param} ký tự",
            ],

        ];
        $this->validation->setRules($rule, $message);
        $this->validation->withRequest($requestData)->run();

        return $this->validation;
    }

    private function validateEditPurchase($requestData)
    {
        $rule = [
            'name' => 'max_length[100]',
            'email_address' => 'max_length[100]',
            'storage' => 'max_length[100]',
            'databases' => 'max_length[100]',
            'domains' => 'max_length[100]',
            'price' => 'max_length[100]',
        ];
        $message = [
            'name' => [
                'max_length' => "Tên quá dài, vui lòng nhập {param} ký tự",
            ],
            'email_address' => [
                'max_length' => "Email quá dài, vui lòng nhập {param} ký tự",
            ],
            'storage' => [
                'max_length' => "Dung lượng quá dài, vui lòng nhập {param} ký tự",
            ],
            'databases' => [
                'max_length' => "Số lượng database quá dài, vui lòng nhập {param} ký tự",
            ],
            'domains' => [
                'max_length' => "Số lượng domains quá dài, vui lòng nhập {param} ký tự",
            ],
            'price' => [
                'max_length' => "Giá quá dài, vui lòng nhập {param} ký tự",
            ],

        ];


        $this->validation->setRules($rule, $message);
        $this->validation->withRequest($requestData)->run();

        return $this->validation;
    }
}
