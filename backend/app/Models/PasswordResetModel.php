<?php

namespace App\Models;

use CodeIgniter\Model;

class PasswordResetModel extends Model
{
    protected $table         = 'password_resets';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['email', 'code', 'expires_at', 'used'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    public function generateCode(string $email): string
    {
        $this->where('email', $email)->where('used', 0)->set(['used' => 1])->update();

        $code = (string) random_int(100000, 999999);

        $this->insert([
            'email'      => $email,
            'code'       => $code,
            'expires_at' => date('Y-m-d H:i:s', time() + 900),
            'used'       => 0,
        ]);

        return $code;
    }

    public function findValid(string $email, string $code): ?array
    {
        $row = $this->where('email', $email)
            ->where('code', $code)
            ->where('used', 0)
            ->where('expires_at >=', date('Y-m-d H:i:s'))
            ->orderBy('id', 'DESC')
            ->first();

        return $row ?: null;
    }

    public function markUsed(int $id): void
    {
        $this->update($id, ['used' => 1]);
    }
}
