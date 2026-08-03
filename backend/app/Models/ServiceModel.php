<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table         = 'services';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['icon', 'title', 'description', 'position'];

    public function getOrdered(): array
    {
        return $this->orderBy('position', 'ASC')->findAll();
    }
}
