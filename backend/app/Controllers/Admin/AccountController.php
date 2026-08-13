<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;
use CodeIgniter\HTTP\RedirectResponse;

class AccountController extends BaseController
{
    public function index(): string
    {
        $user = (new AdminUserModel())->find((int) session()->get('admin_user_id'));

        return view('admin/layouts/main', [
            'title'   => 'Mi cuenta',
            'content' => view('admin/account/index', ['user' => $user]),
        ]);
    }

    public function updateProfile(): RedirectResponse
    {
        $model  = new AdminUserModel();
        $userId = (int) session()->get('admin_user_id');

        $name  = trim((string) $this->request->getPost('name'));
        $email = trim((string) $this->request->getPost('email'));

        if ($name === '' || $email === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->to('/admin/account')->with('error', 'Nombre y correo válidos son obligatorios.');
        }

        $existing = $model->findByEmail($email);
        if ($existing && (int) $existing['id'] !== $userId) {
            return redirect()->to('/admin/account')->with('error', 'Ese correo ya está en uso por otra cuenta.');
        }

        $model->update($userId, ['name' => $name, 'email' => $email]);

        session()->set(['admin_user_name' => $name, 'admin_user_email' => $email]);

        return redirect()->to('/admin/account')->with('success', 'Datos actualizados.');
    }

    public function updatePassword(): RedirectResponse
    {
        $model  = new AdminUserModel();
        $userId = (int) session()->get('admin_user_id');
        $user   = $model->find($userId);

        $current = (string) $this->request->getPost('current_password');
        $new     = (string) $this->request->getPost('new_password');
        $confirm = (string) $this->request->getPost('new_password_confirm');

        if (! $user || ! password_verify($current, $user['password_hash'])) {
            return redirect()->to('/admin/account')->with('error', 'La contraseña actual no es correcta.');
        }

        if (strlen($new) < 8) {
            return redirect()->to('/admin/account')->with('error', 'La nueva contraseña debe tener al menos 8 caracteres.');
        }

        if ($new !== $confirm) {
            return redirect()->to('/admin/account')->with('error', 'La confirmación no coincide con la nueva contraseña.');
        }

        $model->update($userId, ['password_hash' => password_hash($new, PASSWORD_DEFAULT)]);

        return redirect()->to('/admin/account')->with('success', 'Contraseña actualizada.');
    }
}
