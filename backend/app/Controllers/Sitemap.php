<?php

namespace App\Controllers;

use App\Models\PartnerModel;
use CodeIgniter\HTTP\ResponseInterface;

class Sitemap extends BaseController
{
    public function index(): ResponseInterface
    {
        $urls = [
            ['loc' => base_url('/'), 'priority' => '1.0'],
            ['loc' => base_url('/#servicios'), 'priority' => '0.6'],
            ['loc' => base_url('/#proyectos'), 'priority' => '0.6'],
            ['loc' => base_url('/#nosotros'), 'priority' => '0.6'],
            ['loc' => base_url('/#contacto'), 'priority' => '0.6'],
            ['loc' => base_url('/aviso-de-privacidad'), 'priority' => '0.3'],
            ['loc' => base_url('/terminos-y-condiciones'), 'priority' => '0.3'],
        ];

        foreach ((new PartnerModel())->getOrdered() as $partner) {
            $urls[] = [
                'loc'      => base_url('/nosotros/' . $partner['slug']),
                'priority' => '0.5',
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . esc($url['loc']) . '</loc>' . "\n";
            $xml .= '    <priority>' . $url['priority'] . '</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        return $this->response->setContentType('application/xml')->setBody($xml);
    }
}
