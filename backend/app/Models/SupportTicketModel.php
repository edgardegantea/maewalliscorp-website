<?php

namespace App\Models;

use CodeIgniter\Model;

class SupportTicketModel extends Model
{
    public const STATUSES = ['abierto', 'en_progreso', 'cerrado'];

    protected $table         = 'support_tickets';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'folio', 'name', 'email', 'subject', 'description',
        'status', 'partner_id', 'admin_notes', 'source',
    ];

    public function generateFolio(): string
    {
        do {
            $folio = 'TCK-' . strtoupper(bin2hex(random_bytes(3)));
        } while ($this->where('folio', $folio)->first());

        return $folio;
    }

    public function findByFolioAndEmail(string $folio, string $email): ?array
    {
        return $this->where('folio', $folio)->where('email', $email)->first();
    }

    public function getOrdered(): array
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }
}
