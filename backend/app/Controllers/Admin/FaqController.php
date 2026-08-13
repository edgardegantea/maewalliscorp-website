<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FaqModel;
use CodeIgniter\HTTP\RedirectResponse;

class FaqController extends BaseController
{
    public function index(): string
    {
        $model = new FaqModel();

        return view('admin/layouts/main', [
            'title'   => 'Preguntas frecuentes',
            'content' => view('admin/faqs/index', ['items' => $model->getOrdered()]),
        ]);
    }

    public function create(): string
    {
        return view('admin/layouts/main', [
            'title'   => 'Nueva pregunta',
            'content' => view('admin/faqs/form', ['item' => null]),
        ]);
    }

    public function store(): RedirectResponse
    {
        $this->save(new FaqModel());

        return redirect()->to('/admin/faqs')->with('success', 'Pregunta creada.');
    }

    public function edit(int $id): string
    {
        $item = (new FaqModel())->find($id);

        return view('admin/layouts/main', [
            'title'   => 'Editar pregunta',
            'content' => view('admin/faqs/form', ['item' => $item]),
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $this->save(new FaqModel(), $id);

        return redirect()->to('/admin/faqs')->with('success', 'Pregunta actualizada.');
    }

    public function delete(int $id): RedirectResponse
    {
        (new FaqModel())->delete($id);

        return redirect()->to('/admin/faqs')->with('success', 'Pregunta eliminada.');
    }

    private function save(FaqModel $model, ?int $id = null): void
    {
        $data = [
            'question' => trim((string) $this->request->getPost('question')),
            'answer'   => trim((string) $this->request->getPost('answer')),
            'position' => (int) $this->request->getPost('position'),
        ];

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
    }
}
