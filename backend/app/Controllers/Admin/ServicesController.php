<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ServiceModel;
use CodeIgniter\HTTP\RedirectResponse;

class ServicesController extends BaseController
{
    public function index(): string
    {
        $model = new ServiceModel();

        return view('admin/layouts/main', [
            'title'   => 'Servicios',
            'content' => view('admin/services/index', ['items' => $model->getOrdered()]),
        ]);
    }

    public function create(): string
    {
        return view('admin/layouts/main', [
            'title'   => 'Nuevo servicio',
            'content' => view('admin/services/form', ['item' => null]),
        ]);
    }

    public function store(): RedirectResponse
    {
        $this->save(new ServiceModel());

        return redirect()->to('/admin/services')->with('success', 'Servicio creado.');
    }

    public function edit(int $id): string
    {
        $item = (new ServiceModel())->find($id);

        return view('admin/layouts/main', [
            'title'   => 'Editar servicio',
            'content' => view('admin/services/form', ['item' => $item]),
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $this->save(new ServiceModel(), $id);

        return redirect()->to('/admin/services')->with('success', 'Servicio actualizado.');
    }

    public function delete(int $id): RedirectResponse
    {
        (new ServiceModel())->delete($id);

        return redirect()->to('/admin/services')->with('success', 'Servicio eliminado.');
    }

    private function save(ServiceModel $model, ?int $id = null): void
    {
        $data = [
            'icon'        => trim((string) $this->request->getPost('icon')),
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
