<?php

namespace App\Controllers;

use App\Models\PartnerModel;
use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    /** Static frontend routes (besides "/" and "nosotros/{slug}") with their own meta. */
    private const STATIC_ROUTES = [
        'aviso-de-privacidad' => [
            'title'       => 'Aviso de Privacidad | MAEWALLISCORP',
            'description' => 'Cómo tratamos los datos personales que nos compartes a través de este sitio.',
        ],
        'terminos-y-condiciones' => [
            'title'       => 'Términos y Condiciones | MAEWALLISCORP',
            'description' => 'Términos de uso de este sitio y de nuestros formularios de contacto.',
        ],
        'soporte' => [
            'title'       => 'Consulta tu ticket de soporte | MAEWALLISCORP',
            'description' => 'Consulta el estado de tu ticket de soporte con tu folio y correo.',
        ],
    ];

    public function index(): string|ResponseInterface
    {
        $path = trim((string) $this->request->getUri()->getPath(), '/');
        $meta = $this->defaultMeta();

        $isKnownRoute = $path === '';

        if (isset(self::STATIC_ROUTES[$path])) {
            $isKnownRoute = true;
            $meta         = array_merge($meta, self::STATIC_ROUTES[$path]);
        }

        if (preg_match('#^nosotros/([a-z0-9\-]+)$#', $path, $matches)) {
            $partner = (new PartnerModel())->findBySlug($matches[1]);

            if ($partner) {
                $isKnownRoute         = true;
                $meta['title']       = $partner['name'] . ' — ' . $partner['role'] . ' | MAEWALLISCORP';
                $meta['description'] = mb_strimwidth($partner['semblanza'], 0, 200, '…');
            }
        }

        $meta['url'] = current_url();

        // React Router renders its own 404 UI for unmatched paths; we still
        // want the HTTP status to be a real 404 for crawlers/link previews.
        if (! $isKnownRoute) {
            $this->response->setStatusCode(404);
            $meta['title']       = 'Página no encontrada | MAEWALLISCORP';
            $meta['description'] = 'La página que buscas no existe o fue movida.';
        }

        return view('app', $meta);
    }

    private function defaultMeta(): array
    {
        return [
            'title'       => 'MAEWALLISCORP — Desarrollo de software, consultoría tecnológica y soporte',
            'description' => 'Diseñamos, desarrollamos y damos soporte a plataformas de software para organizaciones que necesitan resolver procesos reales, no solo tener una app más.',
        ];
    }
}
