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

        // 1. Get the core user profile details (id, user_name, email, subscription_status)
        $user = $userModel->find($userId);

        // 2. Fetch the latest active/successful transaction dates to get subscription timeline
        $db = \Config\Database::connect();
        $latestPaymentDates = $db->table('payment_history')
            ->select('subscription_starts_at, subscription_ends_at')
            ->where('shop_owner_id', $userId)
            ->where('payment_status', 'success')
            ->orderBy('id', 'DESC') // Get the most recent valid transaction
            ->get()
            ->getRowArray();

        // 3. Merge them together so your view array keys don't break
        $data['subscription'] = [
            'id' => $user['id'] ?? '',
            'user_name' => $user['user_name'] ?? '',
            'email' => $user['email'] ?? '',
            'subscription_status' => $user['subscription_status'] ?? 'pending',
            'subscription_starts_at' => $latestPaymentDates['subscription_starts_at'] ?? null,
            'subscription_ends_at' => $latestPaymentDates['subscription_ends_at'] ?? null,
        ];

        // 4. Pass down payment log details for history tables
        $data['payments'] = $payModel->where('shop_owner_id', $userId)
            ->orderBy('id', 'DESC')
            ->findAll();

        return view("admin/subscription", $data);
    }

    public function verify_by_superadmin()
    {
        $db = \Config\Database::connect();

        // Query all pending payments joined with user profiles
        $data['pending_payments'] = $db->table('payment_history')
            ->select('payment_history.*, users.user_name, users.email, users.subscription_status')
            ->join('users', 'users.id = payment_history.shop_owner_id')
            ->where('payment_history.payment_status', 'pending')
            ->orderBy('payment_history.payment_date', 'ASC') // Oldest requests first
            ->get()
            ->getResultArray();

        return view('admin/verify_by_superadmin', $data);
    }



}
