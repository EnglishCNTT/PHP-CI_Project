<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Services\UserService;

class UserController extends BaseController
{
    /**
     * @var Service
     */
    private $service;
    public function __construct()
    {
        $this->service = new UserService();
    }
    public function list(): string
    {
        $data = [];
        // dd($data['users']);
        $cssFiles = [
            'https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css',
            base_url() . '/assets/admin/css/datatable.css'
        ];
        $jsFiles = [
            'http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js',
            base_url() . '/assets/admin/js/datatable.js'
        ];
        $dataLayout['users'] = $this->service->getAllUsers();
        $data = $this->loadMasterLayout($data, 'Danh sách tài khoản', 'admin/pages/user/list', $dataLayout, $cssFiles, $jsFiles);
        return view('admin/main', $data);
    }

    public function add()
    {
        $data = [];

        $data = $this->loadMasterLayout($data, 'Thêm tài khoản', 'admin/pages/user/add');
        return view('admin/main', $data);
    }

    public function create()
    {
        $result = $this->service->addUserInfo($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'], $result['messages']);
    }

    public function edit($id)
    {
        $user = $this->service->getUserByID($id);

        if (!$user) {
            return redirect('error/404');
        }
        $data = [];

        $data = $this->loadMasterLayout($data, 'Sửa tài khoản', 'admin/pages/user/edit');
        return view('admin/main', $data);
    }
}
