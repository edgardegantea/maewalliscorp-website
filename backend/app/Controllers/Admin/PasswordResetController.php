<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;
use App\Models\PasswordResetModel;
use CodeIgniter\HTTP\RedirectResponse;

class PasswordResetController extends BaseController
{
    public function forgot()
    {
        return view('admin/password_reset/forgot', [
            'error'   => session()->getFlashdata('error'),
            'success' => session()->getFlashdata('success'),
        ]);
    }

    public function sendCode(): RedirectResponse
    {
        $email = trim((string) $this->request->getPost('email'));

        $userModel = new AdminUserModel();
        $user      = $userModel->findByEmail($email);

        if ($user) {
            $code = (new PasswordResetModel())->generateCode($email);

            $emailService = service('email');
            $emailService->setTo($email);
            $emailService->setFrom(env('email.fromEmail', 'no-reply@maewalliscorp.com'), env('email.fromName', 'MAEWALLISCORP'));
            $emailService->setSubject('Código para restablecer tu contraseña');
            $emailService->setMessage(view('admin/password_reset/email_code', ['code' => $code]));
            $emailService->send();
        }

        session()->set('reset_email', $email);

        return redirect()->to('/admin/password/verify')
            ->with('success', 'Si el correo existe, se envió un código de verificación.');
    }

    public function verify()
    {
        $email = session()->get('reset_email');

        if (! $email) {
            return redirect()->to('/admin/password/forgot');
        }

        return view('admin/password_reset/verify', [
            'error'   => session()->getFlashdata('error'),
            'success' => session()->getFlashdata('success'),
        ]);
    }

    public function reset(): RedirectResponse
    {
        $email    = (string) session()->get('reset_email');
        $code     = trim((string) $this->request->getPost('code'));
        $password = (string) $this->request->getPost('password');
        $confirm  = (string) $this->request->getPost('password_confirm');

        if (! $email) {
            return redirect()->to('/admin/password/forgot');
        }

        if (strlen($password) < 8) {
            return redirect()->to('/admin/password/verify')->with('error', 'La contraseña debe tener al menos 8 caracteres.');
        }

        if ($password !== $confirm) {
            return redirect()->to('/admin/password/verify')->with('error', 'Las contraseñas no coinciden.');
        }

        $resetModel = new PasswordResetModel();
        $reset      = $resetModel->findValid($email, $code);

        if (! $reset) {
            return redirect()->to('/admin/password/verify')->with('error', 'Código inválido o expirado.');
        }

        $userModel = new AdminUserModel();
        $user      = $userModel->findByEmail($email);

        if (! $user) {
            return redirect()->to('/admin/password/forgot')->with('error', 'No se encontró la cuenta.');
        }

        $userModel->update($user['id'], ['password_hash' => password_hash($password, PASSWORD_DEFAULT)]);
        $resetModel->markUsed($reset['id']);
        session()->remove('reset_email');

        return redirect()->to('/admin/login')->with('error', 'Contraseña actualizada. Ya puedes iniciar sesión.');
    }
}
