<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $path = trim((string) $request->getUri()->getPath(), '/');

        $publicPaths = ['admin/login', 'admin/password/forgot', 'admin/password/send-code', 'admin/password/verify', 'admin/password/reset'];

        if (in_array($path, $publicPaths, true)) {
            return;
        }

        $session = session();

        if (! $session->get('admin_user_id')) {
            return redirect()->to('/admin/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing to do.
    }
}
