<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; // Or 'object' if you prefer StdClass
    protected $useSoftDeletes   = false;

    // Allowed fields for mass assignment (INSERT/UPDATE)
    protected $allowedFields = [
        'user_name',
        'email',
        'password',
        'subscription_status',
        'subscription_starts_at',
        'subscription_ends_at'
    ];

    // Dates configuration
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation Rules
    protected $validationRules = [
        'user_name'           => 'required|alpha_numeric_space|min_length[3]|max_length[100]',
        'email'               => 'required|valid_email|is_unique[users.email,id,{id}]|max_length[100]',
        'password'            => 'required|min_length[8]|max_length[255]',
        'subscription_status' => 'permit_empty|in_list[active,expired,pending]',
        'subscription_starts_at' => 'permit_empty|valid_date[Y-m-d H:i:s]',
        'subscription_ends_at'   => 'permit_empty|valid_date[Y-m-d H:i:s]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Sorry, that email address is already registered.'
        ],
        'subscription_status' => [
            'in_list' => 'The subscription status must be either active, expired, or pending.'
        ]
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    /**
     * Automatically hash the user password before saving to the database
     */
    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }

        // Only hash if it isn't already hashed
        if (password_get_info($data['data']['password'])['algo'] === 0) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }

    /**
     * Get the subscription record for a specific user
     */
    public function getSubscriptionByOwner($userId)
    {
        return $this->where('id', $userId)->first();
    }
}