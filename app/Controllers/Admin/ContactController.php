<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Services\ContactService;

class ContactController extends BaseController
{
    /**
     * @var Service
     */
    private $service;
    public function __construct()
    {
        $this->service = new ContactService();
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
        $dataLayout['contacts'] = $this->service->getDataPaginateContact();
        $dataLayout['pager'] = $this->service->getPagerContact();

        $data = $this->loadMasterLayout($data, 'Danh sách liên hệ', 'admin/pages/contact/list', $dataLayout, $cssFiles, $jsFiles);
        return view('admin/main', $data);
    }
}
