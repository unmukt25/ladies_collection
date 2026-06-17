<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\DashboardModel;
// use App\Models\Admin\SubscriptionModel;
use App\Models\Admin\PaymentHistoryModel;
use App\Models\DressModel;
use App\Models\UserModel;


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

        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/admin/login'));
        }

        $model = new DressModel();

        $data['dresses'] = $model
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $data['pager'] = $model->pager;

        return view("admin/dresses", $data);
    }

    public function addDress()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/admin/login'));
        }

        return view('admin/add_dress');
    }

    public function editDress($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/admin/login'));
        }

        $dressModel = new DressModel();

        $dress = $dressModel->find($id);

        if (!$dress) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Dress not found");
        }

        return view('admin/edit_dress', [
            'dress' => $dress
        ]);
    }

    public function category()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/admin/login'));
        }

        return view("admin/category");
    }

    public function users()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/admin/login'));
        }

        $userModel = new UserModel();

        $user = $userModel->find(session()->get('admin_id'));

        return view('admin/users', [
            'user' => $user
        ]);
    }

    public function profile()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/admin/login'));
        }

        return view("admin/profile");
    }

    public function subscription()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/admin/login'));
        }

        $userId = session()->get('admin_id');

        // Instantiate models
        $userModel = new UserModel();
        $payModel = new PaymentHistoryModel();

        // Pass parameters required by your view file variables
        $data['subscription'] = $userModel->getSubscriptionByOwner($userId);
        $data['payments'] = $payModel->getPaymentLogs($userId);

        return view("admin/subscription", $data);
    }

    public function verify_by_superadmin($id)
    {
        $userModel = new UserModel();
        
        $data['user'] = $userModel->find($id);

        if (!$data['user']) {
            return redirect()->to('admin/subscriptions')->with('error', 'User not found.');
        }

        return view('admin/verify_by_superadmin', $data);
    }


}
