<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Services\PurchaseService;

class PurchaseController extends BaseController
{
    /**
     * @var Service
     */
    private $service;
    public function __construct()
    {
        $this->service = new PurchaseService();
    }
    public function list(): string
    {
        $data = [];
        // dd($data['users']);
        $cssFiles = [
            'https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css',
            base_url() . '/assets/admin/css/datatable.css',
        ];
        $jsFiles = [
            'http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js',
            base_url() . '/assets/admin/js/datatable.js',
            base_url() . '/assets/admin/js/event.js'
        ];
        $dataLayout['purchases'] = $this->service->getAllpurchases();
        // dd($dataLayout);

        $data = $this->loadMasterLayout($data, 'Danh sách gói dịch vụ', 'admin/pages/purchase/list', $dataLayout, $cssFiles, $jsFiles);
        return view('admin/main', $data);
    }

    public function add()
    {
        $data = [];

        $data = $this->loadMasterLayout($data, 'Thêm gói dịch vụ', 'admin/pages/purchase/add');
        return view('admin/main', $data);
    }

    public function create()
    {
        $result = $this->service->addPurchaseInfo($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'], $result['messages']);
    }

    public function edit($id)
    {
        $purchase = $this->service->getPurchaseByID($id);
        if (!$purchase) {
            return redirect('error/404');
        }

        $data = [];
        $dataLayout['purchase'] = $purchase;
        $jsFiles = [
            base_url() . '/assets/admin/js/event.js'
        ];
        $data = $this->loadMasterLayout($data, 'Chỉnh sửa gói dịch vụ', 'admin/pages/purchase/edit', $dataLayout, [], $jsFiles);
        return view('admin/main', $data);
    }

    public function update()
    {
        $result = $this->service->updatePurchaseInfo($this->request);
        return redirect()->back()->withInput()->with($result['messageCode'], $result['messages']);
    }

    public function delete($id)
    {
        $purchase = $this->service->getPurchaseByID($id);
        if (!$purchase) {
            return redirect('error/404');
        }
        $result = $this->service->deletePurchase($id);
        return redirect('admin/purchase/list')->with($result['messageCode'], $result['messages']);
    }
}
