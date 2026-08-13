<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcessStepModel extends Model
{
    protected $table         = 'process_steps';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['title', 'description', 'position'];

    public function getOrdered(): array
    {
        return $this->orderBy('position', 'ASC')->findAll();
    }
}
