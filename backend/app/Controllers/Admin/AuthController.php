<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;
use CodeIgniter\HTTP\RedirectResponse;

class AuthController extends BaseController
{
    /**
     * @return RedirectResponse|string
     */
    public function login()
    {
        if (session()->get('admin_user_id')) {
            return redirect()->to('/admin');
        }

        return view('admin/login', ['error' => session()->getFlashdata('error')]);
    }

    public function attempt(): RedirectResponse
    {
        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        $model = new AdminUserModel();
        $user  = $model->findByEmail($email);

        if (! $user || ! password_verify($password, $user['password_hash'])) {
            return redirect()->to('/admin/login')->with('error', 'Correo o contraseña incorrectos.');
        }

        session()->set([
            'admin_user_id'    => $user['id'],
            'admin_user_name'  => $user['name'],
            'admin_user_email' => $user['email'],
        ]);

        return redirect()->to('/admin');
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();

        return redirect()->to('/admin/login');
    }
}
