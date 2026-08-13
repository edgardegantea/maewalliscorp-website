<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\SupportTicketModel;
use CodeIgniter\HTTP\ResponseInterface;

class Tickets extends BaseController
{
    public function store(): ResponseInterface
    {
        $rules = [
            'name'        => ['label' => 'Nombre', 'rules' => 'required|min_length[2]|max_length[150]'],
            'email'       => ['label' => 'Correo', 'rules' => 'required|valid_email|max_length[255]'],
            'subject'     => ['label' => 'Asunto', 'rules' => 'required|min_length[3]|max_length[200]'],
            'description' => ['label' => 'Descripción', 'rules' => 'required|min_length[5]'],
        ];

        if (! $this->validate($rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $model = new SupportTicketModel();
        $folio = $model->generateFolio();

        $model->insert([
            'folio'       => $folio,
            'name'        => trim((string) $this->request->getJsonVar('name')),
            'email'       => trim((string) $this->request->getJsonVar('email')),
            'subject'     => trim((string) $this->request->getJsonVar('subject')),
            'description' => trim((string) $this->request->getJsonVar('description')),
            'source'      => (string) ($this->request->getJsonVar('source') ?? 'chatbot'),
            'status'      => 'abierto',
        ]);

        return $this->response->setStatusCode(201)->setJSON([
            'folio'   => $folio,
            'message' => 'Tu ticket fue creado. Guarda tu folio para consultar su estado.',
        ]);
    }

    public function lookup(): ResponseInterface
    {
        $folio = trim((string) $this->request->getGet('folio'));
        $email = trim((string) $this->request->getGet('email'));

        if ($folio === '' || $email === '') {
            return $this->response->setStatusCode(422)->setJSON(['message' => 'Folio y correo son obligatorios.']);
        }

        $ticket = (new SupportTicketModel())->findByFolioAndEmail($folio, $email);

        if (! $ticket) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'No encontramos un ticket con esos datos.']);
        }

        return $this->response->setJSON([
            'folio'      => $ticket['folio'],
            'subject'    => $ticket['subject'],
            'status'     => $ticket['status'],
            'created_at' => $ticket['created_at'],
            'updated_at' => $ticket['updated_at'],
        ]);
    }
}
