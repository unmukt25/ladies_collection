<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorLogModel extends Model
{
    protected $table = 'visitor_logs';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'ip_address',
        'page_url',
        'category',
        'product_id',
        'user_agent'
    ];
}