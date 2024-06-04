<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Dùng thử',
                'price' => '$0/Tháng',
                'email_address' => '250',
                'storage' => '125GB',
                'databases' => '140',
                'domains' => '60',
                'support' => '24/7 trong ngày',
            ],
            [
                'name' => 'Gói thanh toán theo năm',
                'price' => '$400/Năm',
                'email_address' => '500',
                'storage' => '250GB',
                'databases' => '60',
                'domains' => '30',
                'support' => '24/7 trong ngày',
            ],
            [
                'name' => 'Vĩnh viễn',
                'price' => '$5000/1 lần duy nhất',
                'email_address' => '250',
                'storage' => '125GB',
                'databases' => '140',
                'domains' => '60',
                'support' => '24/7 trong ngày',
            ],
        ];
        $this->db->table('purchases')->insertBatch($data);
    }
}
