<?php

namespace App\Models;

use CodeIgniter\Model;

class FaqModel extends Model
{
    protected $table         = 'faqs';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['question', 'answer', 'position'];

    public function getOrdered(): array
    {
        return $this->orderBy('position', 'ASC')->findAll();
    }
}
