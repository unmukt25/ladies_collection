<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PaymentHistoryModel extends Model
{
    protected $table = 'payment_history';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['shop_owner_id', 'amount', 'currency', 'gateway_payment_id', 'status', 'payment_date'];

    protected $useTimestamps = false; // Custom datetime values used below

    /**
     * Get historical payment logs for a shop owner ordered by latest date
     */
    public function getPaymentLogs($userId)
    {
        return $this->where('shop_owner_id', $userId)
            ->orderBy('payment_date', 'DESC')
            ->findAll();
    }

    /**
     * Check if a specific transaction reference key has already been logged
     */
    public function isDuplicateTransaction($transactionId)
    {
        return $this->where('gateway_payment_id', $transactionId)->countAllResults() > 0;
    }
}