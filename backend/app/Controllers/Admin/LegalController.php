<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LegalPageModel;
use CodeIgniter\HTTP\RedirectResponse;

class LegalController extends BaseController
{
    private const ALLOWED_KEYS = ['privacy', 'terms'];

    public function edit(string $key): string
    {
        if (! in_array($key, self::ALLOWED_KEYS, true)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $page = (new LegalPageModel())->findByKey($key);

        return view('admin/layouts/main', [
            'title'   => $page['title'] ?? 'Página legal',
            'content' => view('admin/legal/form', ['page' => $page, 'key' => $key]),
        ]);
    }

    public function update(string $key): RedirectResponse
    {
        if (! in_array($key, self::ALLOWED_KEYS, true)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $model = new LegalPageModel();
        $page  = $model->findByKey($key);

        $data = [
            'page_key'   => $key,
            'title'      => trim((string) $this->request->getPost('title')),
            'content'    => trim((string) $this->request->getPost('content')),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($page) {
            $model->update($page['id'], $data);
        } else {
            $model->insert($data);
        }

        return redirect()->to('/admin/legal/' . $key)->with('success', 'Página actualizada.');
    }
}
