<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\DashboardModel;
use App\Models\DressModel;

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

        $model = new DashboardModel();

        $data['stats'] = $model->getDashboardStats();
        $data['categories'] = $model->getCategoryCounts();
        $data['missing'] = $model->getMissingInfo();
        $data['latest'] = $model->getLatestDresses();

        return view("admin/index", $data);
        //
    }

    public function default()
    {

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/admin/login'));
        }

        return view("admin/default");
        //
    }

    public function dresses()
    {

        $model = new DressModel();

        $data['dresses'] = $model
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $data['pager'] = $model->pager;

        return view("admin/dresses",$data);
    }

    public function addDress(){

         return view('admin/add_dress');
    }

}
