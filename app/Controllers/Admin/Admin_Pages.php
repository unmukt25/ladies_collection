<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin_Pages extends BaseController
{
    public function login()
    {

        return view("admin/login");

    }

    public function index()
    {

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/admin/login'));
        }

        return view("admin/index");
        //
    }

}
