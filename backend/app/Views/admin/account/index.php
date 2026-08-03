<div class="card" style="max-width:420px;">
    <p style="margin-top:0;color:#5a6376;font-size:14px;">
        Sesión: <?= esc(session()->get('admin_user_email')) ?>
    </p>

    <form method="post" action="/admin/account/password">
        <?= csrf_field() ?>

        <div class="field">
            <label for="current_password">Contraseña actual</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>

        <div class="field">
            <label for="new_password">Nueva contraseña</label>
            <input type="password" id="new_password" name="new_password" minlength="8" required>
            <small>Mínimo 8 caracteres.</small>
        </div>

        <div class="field">
            <label for="new_password_confirm">Confirmar nueva contraseña</label>
            <input type="password" id="new_password_confirm" name="new_password_confirm" minlength="8" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar contraseña</button>
    </form>
</div>
