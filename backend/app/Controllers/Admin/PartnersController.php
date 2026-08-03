<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PartnerModel;
use CodeIgniter\HTTP\RedirectResponse;

class PartnersController extends BaseController
{
    public function index(): string
    {
        $model = new PartnerModel();

        return view('admin/layouts/main', [
            'title'   => 'Socios',
            'content' => view('admin/partners/index', ['items' => $model->getOrdered()]),
        ]);
    }

    public function create(): string
    {
        return view('admin/layouts/main', [
            'title'   => 'Nuevo socio',
            'content' => view('admin/partners/form', ['item' => null]),
        ]);
    }

    public function store(): RedirectResponse
    {
        $this->save(new PartnerModel());

        return redirect()->to('/admin/partners')->with('success', 'Socio creado.');
    }

    public function edit(int $id): string
    {
        $item = (new PartnerModel())->find($id);

        return view('admin/layouts/main', [
            'title'   => 'Editar socio',
            'content' => view('admin/partners/form', ['item' => $item]),
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $this->save(new PartnerModel(), $id);

        return redirect()->to('/admin/partners')->with('success', 'Socio actualizado.');
    }

    public function delete(int $id): RedirectResponse
    {
        (new PartnerModel())->delete($id);

        return redirect()->to('/admin/partners')->with('success', 'Socio eliminado.');
    }

    /** Splits a textarea (one item per line) into a clean string array. */
    private function linesToArray(?string $raw): array
    {
        $lines = preg_split('/\r\n|\r|\n/', (string) $raw) ?: [];

        return array_values(array_filter(array_map('trim', $lines), static fn ($line) => $line !== ''));
    }

    /** Parses "Label|https://url" lines into [{label,url}]. */
    private function linesToLinks(?string $raw): array
    {
        $links = [];

        foreach ($this->linesToArray($raw) as $line) {
            [$label, $url] = array_pad(explode('|', $line, 2), 2, '');
            $label = trim($label);
            $url   = trim($url);

            if ($label !== '' && $url !== '') {
                $links[] = ['label' => $label, 'url' => $url];
            }
        }

        return $links;
    }

    private function save(PartnerModel $model, ?int $id = null): void
    {
        $data = [
            'slug'           => trim((string) $this->request->getPost('slug')),
            'name'           => trim((string) $this->request->getPost('name')),
            'role'           => trim((string) $this->request->getPost('role')),
            'semblanza'      => trim((string) $this->request->getPost('semblanza')),
            'academico'      => $this->linesToArray($this->request->getPost('academico')),
            'profesional'    => $this->linesToArray($this->request->getPost('profesional')),
            'publicaciones'  => $this->linesToArray($this->request->getPost('publicaciones')),
            'links'          => $this->linesToLinks($this->request->getPost('links')),
            'pending_review' => $this->request->getPost('pending_review') ? 1 : 0,
            'position'       => (int) $this->request->getPost('position'),
        ];

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }
    }
}
