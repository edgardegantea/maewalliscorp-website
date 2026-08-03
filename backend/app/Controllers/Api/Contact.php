<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Contact extends BaseController
{
    public function store(): ResponseInterface
    {
        $rules = [
            'name'    => 'required|min_length[2]',
            'email'   => 'required|valid_email',
            'message' => 'required|min_length[5]',
        ];

        if (! $this->validate($rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'errors' => $this->validator->getErrors(),
            ]);
        }

        // TODO: persist lead / send notification / trigger CRM & support workflow.

        return $this->response->setStatusCode(201)->setJSON([
            'message' => 'Gracias por contactarnos, te responderemos pronto.',
        ]);
    }
}
