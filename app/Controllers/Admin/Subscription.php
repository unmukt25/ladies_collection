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

        // Insert log record mapping your updated database schema columns
        $payModel->insert([
            'shop_owner_id' => $userId,
            'amount' => 500.00,
            'currency' => 'INR',
            'gateway_payment_id' => $transactionId,
            'payment_status' => 'pending', // Changed from 'status' to 'payment_status'
            // 'payment_date' can be omitted if you want MariaDB to handle it automatically, 
            // but included here explicitly matching your schema structure.
            'payment_date' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/admin/subscription')->with('success', 'Reference code saved! Access will activate once verified.');
    }

     /**
     * Process the action (Approve/Reject) for a specific payment ID
     */
    public function process_payment_action($paymentId)
    {
        $db = \Config\Database::connect();

        // Find target payment row
        $payment = $db->table('payment_history')->where('id', $paymentId)->get()->getRowArray();
        if (!$payment) {
            return redirect()->back()->with('error', 'Transaction record not found.');
        }

        $action = $this->request->getPost('status_action'); // 'active' (Approve) or 'failed' (Reject)

        $db->transStart();

        if ($action === 'active') {
            $startsAt = date('Y-m-d H:i:s');
            $endsAt = date('Y-m-d H:i:s', strtotime('+30 days')); // Defaulting to 30 days subscription tier

            // 1. Update target row inside payment log
            $db->table('payment_history')->where('id', $paymentId)->update([
                'payment_status' => 'success',
                'subscription_starts_at' => $startsAt,
                'subscription_ends_at' => $endsAt
            ]);

            // 2. Mark corresponding user profile as active
            $db->table('users')->where('id', $payment['shop_owner_id'])->update([
                'subscription_status' => 'active'
            ]);

            $message = 'Payment successfully verified and subscription activated!';
        } else {
            // Rejection Path
            $db->table('payment_history')->where('id', $paymentId)->update([
                'payment_status' => 'failed'
            ]);

            $db->table('users')->where('id', $payment['shop_owner_id'])->update([
                'subscription_status' => 'expired'
            ]);

            $message = 'Transaction rejected successfully.';
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Database execution failure. Transact rolled back.');
        }

        return redirect()->to('admin/subscription/verify')->with('success', $message);
    }

}