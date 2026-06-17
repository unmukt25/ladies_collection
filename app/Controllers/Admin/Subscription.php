<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

use App\Models\Admin\PaymentHistoryModel;

class Subscription extends BaseController
{


    /**
     * Submit manual payment verification log
     * POST /admin/subscription/submit
     */
    public function submitUpiCode()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('/admin/login'));
        }

        $userId = session()->get('admin_id');
        $payModel = new PaymentHistoryModel();

        // Server validation check
        if (!$this->validate(['transaction_id' => 'required|alpha_numeric|min_length[8]|max_length[50]'])) {
            return redirect()->back()->with('error', 'Please enter a valid Transaction/UTR ID.');
        }

        $transactionId = strtoupper(trim($this->request->getPost('transaction_id')));

        // Check duplicates using model method
        if ($payModel->isDuplicateTransaction($transactionId)) {
            return redirect()->back()->withInput()->with('error', 'This Reference ID has already been submitted.');
        }

        // Insert log record
        $payModel->insert([
            'shop_owner_id' => $userId,
            'amount' => 500.00,
            'currency' => 'INR',
            'gateway_payment_id' => $transactionId,
            'status' => 'pending',
            'payment_date' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/admin/subscription')->with('success', 'Reference code saved! Access will activate once verified.');
    }

}