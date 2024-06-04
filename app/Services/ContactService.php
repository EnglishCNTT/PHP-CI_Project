<?php

namespace App\Services;

use App\Common\ResultUtils;
use App\Models\ContactModel;
use Exception;

class ContactService extends BaseService
{

    private $contacts;
    /**
     * Construct
     */
    function __construct()
    {
        parent::__construct();
        $this->contacts = new ContactModel();
        $this->contacts->protect(false);
    }

    public function getDataPaginateContact()
    {
        return $this->contacts->orderBy('id', 'DESC')->paginate(6);
    }

    public function getPagerContact()
    {
        return $this->contacts->pager;
    }
}
