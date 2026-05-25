<?php

namespace App\Models;

use CodeIgniter\Model;

class DressModel extends Model
{
    protected $table = 'dresses';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'product_name',
        'cat',
        'price',
        'old_price',
        'rating',
        'reviews',
        'badge',
        'style',
        'colors',
        'sizes',
        'img'
    ];
}