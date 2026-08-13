<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProcessStepModel;
use CodeIgniter\HTTP\RedirectResponse;

class ProcessController extends BaseController
{
    public function index(): string
    {
        $model = new ProcessStepModel();

        return view('admin/layouts/main', [
            'title'   => 'Cómo trabajamos',
            'content' => view('admin/process/index', ['items' => $model->getOrdered()]),
        ]);
    }

    public function create(): string
    {
        return view('admin/layouts/main', [
            'title'   => 'Nuevo paso',
            'content' => view('admin/process/form', ['item' => null]),
        ]);
    }

    public function store(): RedirectResponse
    {
        $this->save(new ProcessStepModel());

        return redirect()->to('/admin/process')->with('success', 'Paso creado.');
    }

    public function edit(int $id): string
    {
        $item = (new ProcessStepModel())->find($id);

        return view('admin/layouts/main', [
            'title'   => 'Editar paso',
            'content' => view('admin/process/form', ['item' => $item]),
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $this->save(new ProcessStepModel(), $id);

        return redirect()->to('/admin/process')->with('success', 'Paso actualizado.');
    }

    public function delete(int $id): RedirectResponse
    {
        (new ProcessStepModel())->delete($id);

        return redirect()->to('/admin/process')->with('success', 'Paso eliminado.');
    }

    private function save(ProcessStepModel $model, ?int $id = null): void
    {
        $data = [
            'title'       => trim((string) $this->request->getPost('title')),
            'description' => trim((string) $this->request->getPost('description')),
            'position'    => (int) $this->request->getPost('position'),
        ];

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
    }
}
