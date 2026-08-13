<?php

namespace App\Models;

use CodeIgniter\Model;

class LegalPageModel extends Model
{
    protected $table         = 'legal_pages';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['page_key', 'title', 'content', 'updated_at'];

    public function findByKey(string $key): ?array
    {
        return $this->where('page_key', $key)->first();
    }
}
