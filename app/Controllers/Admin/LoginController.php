<?php

namespace App\Controllers\Admin;

use App\Common\ResultUtils;
use App\Controllers\BaseController;
use App\Services\LoginService;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{
    /**
     * @var service
     */

    private $service;

    public function __construct()
    {
        $this->service = new LoginService();
    }
    public function index()
    {
        if (session()->has('user_login')) {
            return redirect('admin/home');
        }
        return view('admin/pages/login');
    }

    public function login()
    {
        $result = $this->service->hasLoginInfo($this->request);

        if ($result['status'] === ResultUtils::STATUS_CODE_OK) {
            return redirect('admin/home');
        } elseif ($result['status'] === ResultUtils::STATUS_CODE_ERR) {
            return redirect('login')->with($result['messageCode'], $result['messages']);
        }
    }

    public function logout()
    {
        $this->service->logoutUser();
        return redirect('login');
    }
}
