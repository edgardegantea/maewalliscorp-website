<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PartnerModel;
use App\Models\PortfolioItemModel;
use App\Models\ServiceModel;
use App\Models\SiteSettingModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Public, read-only endpoints that let the React frontend render content
 * managed from /admin, without requiring authentication.
 */
class Content extends BaseController
{
    public function services(): ResponseInterface
    {
        return $this->response->setJSON((new ServiceModel())->getOrdered());
    }

    public function portfolio(): ResponseInterface
    {
        return $this->response->setJSON((new PortfolioItemModel())->getOrdered());
    }

    public function partners(): ResponseInterface
    {
        $partners = array_map(
            fn (array $partner) => $this->presentPartner($partner),
            (new PartnerModel())->getOrdered()
        );

        return $this->response->setJSON($partners);
    }

    public function partner(string $slug): ResponseInterface
    {
        $partner = (new PartnerModel())->findBySlug($slug);

        if (! $partner) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Socio no encontrado.']);
        }

        return $this->response->setJSON($this->presentPartner($partner));
    }

    public function settings(): ResponseInterface
    {
        return $this->response->setJSON((new SiteSettingModel())->getAllAsMap());
    }

    private function presentPartner(array $partner): array
    {
        return [
            'slug'          => $partner['slug'],
            'name'          => $partner['name'],
            'role'          => $partner['role'],
            'semblanza'     => $partner['semblanza'],
            'academico'     => $partner['academico'] ?? [],
            'profesional'   => $partner['profesional'] ?? [],
            'publicaciones' => $partner['publicaciones'] ?? [],
            'links'         => $partner['links'] ?? [],
            'pendingReview' => (bool) $partner['pending_review'],
        ];
    }
}
