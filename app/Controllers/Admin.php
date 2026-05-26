<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function login(){

        return view("admin/login");

    }    

    public function index()
    {

        return view("admin/index");
        //
    }

}
