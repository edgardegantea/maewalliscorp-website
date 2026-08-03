<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiteSettingModel;
use CodeIgniter\HTTP\RedirectResponse;

class SettingsController extends BaseController
{
    /** Keys editable from the settings screen, with their form labels. */
    private const FIELDS = [
        'hero_eyebrow'          => 'Hero — texto pequeño superior',
        'hero_title'            => 'Hero — título principal',
        'hero_description'      => 'Hero — descripción',
        'about_text'            => 'Sobre nosotros — párrafo',
        'contact_response_time' => 'Contacto — tiempo de respuesta',
        'contact_support_note'  => 'Contacto — nota de soporte',
    ];

    public function index(): string
    {
        $current = (new SiteSettingModel())->getAllAsMap();

        return view('admin/layouts/main', [
            'title'   => 'Textos del sitio',
            'content' => view('admin/settings/index', [
                'fields'  => self::FIELDS,
                'current' => $current,
            ]),
        ]);
    }

    public function update(): RedirectResponse
    {
        $model = new SiteSettingModel();

        foreach (array_keys(self::FIELDS) as $key) {
            $model->setValue($key, trim((string) $this->request->getPost($key)));
        }

        return redirect()->to('/admin/settings')->with('success', 'Textos actualizados.');
    }
}
