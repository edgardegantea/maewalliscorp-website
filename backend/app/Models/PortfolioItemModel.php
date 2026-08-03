<?php

namespace App\Models;

use CodeIgniter\Model;

class PortfolioItemModel extends Model
{
    protected $table         = 'portfolio_items';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['category', 'title', 'description', 'position'];

    public function getOrdered(): array
    {
        return $this->orderBy('position', 'ASC')->findAll();
    }
}
