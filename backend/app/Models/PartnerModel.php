<?php

namespace App\Models;

use CodeIgniter\Model;

class PartnerModel extends Model
{
    protected $table         = 'partners';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields  = [
        'slug', 'name', 'role', 'semblanza',
        'academico', 'profesional', 'publicaciones', 'links',
        'pending_review', 'position',
    ];

    protected array $casts = [
        'academico'      => 'json-array',
        'profesional'    => 'json-array',
        'publicaciones'  => 'json-array',
        'links'          => 'json-array',
        'pending_review' => 'boolean',
    ];

    public function getOrdered(): array
    {
        return $this->orderBy('position', 'ASC')->findAll();
    }

    public function findBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)->first();
    }
}
