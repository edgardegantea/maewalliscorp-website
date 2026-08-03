<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Temporary bootstrap credential — change the password immediately
        // after first login via /admin/account.
        $this->db->table('admin_users')->insert([
            'name'          => 'Administrador MAEWALLISCORP',
            'email'         => 'admin@maewalliscorp.org',
            'password_hash' => '$2y$12$oGFtC5FyLRPi93UD5lN50eX6r.zqGtO9.lFQ86kjiyBF0jmTyHbWu',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
