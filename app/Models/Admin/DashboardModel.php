<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $table = 'dresses';

    public function getDashboardStats()
    {
        $db = \Config\Database::connect();

        return [
            'total_dresses' => $db->table('dresses')->countAllResults(),

            'total_categories' => $db->table('dresses')
                ->select('cat')
                ->groupBy('cat')
                ->countAllResults(),

            'recent_dresses' => $db->table('dresses')
                ->where('created_at >=', date('Y-m-d H:i:s', strtotime('-7 days')))
                ->countAllResults(),

            'total_visitors' => $db->table('visitor_logs')
                ->where('visited_at >=', date('Y-m-d 00:00:00'))
                ->countAllResults()
        ];
    }

    public function getCategoryCounts()
    {
        return $this->db->table('dresses')
            ->select('cat, COUNT(*) as total')
            ->groupBy('cat')
            ->orderBy('total', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getMissingInfo()
    {
        $builder = $this->db->table('dresses');

        return [
            'style' => $builder
                ->groupStart()
                ->where('style IS NULL')
                ->orWhere('style', '[]')
                ->groupEnd()
                ->countAllResults(false),

            'colors' => $this->db->table('dresses')
                ->groupStart()
                ->where('colors IS NULL')
                ->orWhere('colors', '[]')
                ->groupEnd()
                ->countAllResults(),

            'sizes' => $this->db->table('dresses')
                ->groupStart()
                ->where('sizes IS NULL')
                ->orWhere('sizes', '[]')
                ->groupEnd()
                ->countAllResults(),

            'images' => $this->db->table('dresses')
                ->groupStart()
                ->where('img', '')
                ->orWhere('img IS NULL')
                ->groupEnd()
                ->countAllResults(),

            'badge' => $this->db->table('dresses')
                ->groupStart()
                ->where('badge', '')
                ->orWhere('badge IS NULL')
                ->groupEnd()
                ->countAllResults(),

            'old_price' => $this->db->table('dresses')
                ->where('old_price IS NULL')
                ->countAllResults()
        ];
    }

    public function getLatestDresses($limit = 10)
    {
        return $this->db->table('dresses')
            ->select('id,product_name,cat,price,created_at')
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }
}