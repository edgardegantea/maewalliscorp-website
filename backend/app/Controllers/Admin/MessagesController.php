<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContactMessageModel;
use CodeIgniter\HTTP\RedirectResponse;

class MessagesController extends BaseController
{
    public function index(): string
    {
        $model = new ContactMessageModel();

        return view('admin/layouts/main', [
            'title'   => 'Mensajes de contacto',
            'content' => view('admin/messages/index', [
                'messages' => $model->orderBy('created_at', 'DESC')->findAll(),
            ]),
        ]);
    }

    public function delete(int $id): RedirectResponse
    {
        (new ContactMessageModel())->delete($id);

        return redirect()->to('/admin/messages')->with('success', 'Mensaje eliminado.');
    }
}
