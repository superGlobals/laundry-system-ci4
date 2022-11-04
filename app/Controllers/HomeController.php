<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomersModel;

class HomeController extends BaseController
{
    public function index()
    {   
        $db = db_connect();
        $data['customer'] = $db->table('tbl_customers')->select('gender')->countAll('female');
        return view('admin/home', $data);
    }
}
