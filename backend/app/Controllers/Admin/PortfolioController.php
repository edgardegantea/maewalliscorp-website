<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PortfolioItemModel;
use CodeIgniter\HTTP\RedirectResponse;

class PortfolioController extends BaseController
{
    public function index(): string
    {
        $model = new PortfolioItemModel();

        return view('admin/layouts/main', [
            'title'   => 'Portafolio',
            'content' => view('admin/portfolio/index', ['items' => $model->getOrdered()]),
        ]);
    }

    public function create(): string
    {
        return view('admin/layouts/main', [
            'title'   => 'Nuevo proyecto',
            'content' => view('admin/portfolio/form', ['item' => null]),
        ]);
    }

    public function store(): RedirectResponse
    {
        $this->save(new PortfolioItemModel());

        return redirect()->to('/admin/portfolio')->with('success', 'Proyecto creado.');
    }

    public function edit(int $id): string
    {
        $item = (new PortfolioItemModel())->find($id);

        return view('admin/layouts/main', [
            'title'   => 'Editar proyecto',
            'content' => view('admin/portfolio/form', ['item' => $item]),
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $this->save(new PortfolioItemModel(), $id);

        return redirect()->to('/admin/portfolio')->with('success', 'Proyecto actualizado.');
    }

    public function delete(int $id): RedirectResponse
    {
        (new PortfolioItemModel())->delete($id);

        return redirect()->to('/admin/portfolio')->with('success', 'Proyecto eliminado.');
    }

    private function save(PortfolioItemModel $model, ?int $id = null): void
    {
        $data = [
            'category'    => trim((string) $this->request->getPost('category')),
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
