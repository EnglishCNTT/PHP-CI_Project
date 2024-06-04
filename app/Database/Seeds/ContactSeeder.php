<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $data = [];

        for ($i = 0; $i < 50; $i++) {
            array_push($data, [
                'name' => 'James Fernaldo',
                'email' => 'emailcontacts' . $i . '@gmail.com',
                'phone' => '0987654321' . $i,
                'content' => 'Nội dung' . $i,
            ]);
        }

        $this->db->table('contacts')->insertBatch($data);
    }
}
