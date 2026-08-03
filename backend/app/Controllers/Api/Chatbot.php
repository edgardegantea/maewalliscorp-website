<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Libraries\ChatbotResponder;
use CodeIgniter\HTTP\ResponseInterface;

class Chatbot extends BaseController
{
    public function message(): ResponseInterface
    {
        $rules = [
            'message'    => ['label' => 'Mensaje', 'rules' => 'required|string|min_length[1]|max_length[1000]'],
            'session_id' => ['label' => 'Sesión', 'rules' => 'permit_empty|string|max_length[64]'],
        ];

        if (! $this->validate($rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $message   = trim((string) $this->request->getJsonVar('message'));
        $sessionId = (string) ($this->request->getJsonVar('session_id') ?? bin2hex(random_bytes(8)));

        $responder = new ChatbotResponder();
        $reply     = $responder->reply($message);

        return $this->response->setStatusCode(200)->setJSON([
            'session_id' => $sessionId,
            'reply'      => $reply['text'],
            'intent'     => $reply['intent'],
            'escalate'   => $reply['escalate'],
        ]);
    }
}
