<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ContactMessageModel;
use CodeIgniter\HTTP\ResponseInterface;

class Contact extends BaseController
{
    public function store(): ResponseInterface
    {
        $rules = [
            'name'    => ['label' => 'Nombre', 'rules' => 'required|min_length[2]|max_length[150]'],
            'email'   => ['label' => 'Correo', 'rules' => 'required|valid_email|max_length[255]'],
            'message' => ['label' => 'Mensaje', 'rules' => 'required|min_length[5]'],
        ];

        if (! $this->validate($rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $model = new ContactMessageModel();

        $model->insert([
            'name'       => trim((string) $this->request->getVar('name')),
            'email'      => trim((string) $this->request->getVar('email')),
            'message'    => trim((string) $this->request->getVar('message')),
            'ip_address' => $this->request->getIPAddress(),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $this->response->setStatusCode(201)->setJSON([
            'message' => 'Gracias por contactarnos, te responderemos pronto.',
        ]);
    }
}
