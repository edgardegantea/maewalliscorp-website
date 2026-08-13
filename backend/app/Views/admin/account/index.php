<div class="card" style="max-width:420px;">
    <h3 style="margin-top:0;font-size:16px;">Datos de la cuenta</h3>

    <form method="post" action="/admin/account">
        <?= csrf_field() ?>

        <div class="field">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" value="<?= esc($user['name'] ?? '') ?>" required>
        </div>

        <div class="field">
            <label for="email">Correo</label>
            <input type="email" id="email" name="email" value="<?= esc($user['email'] ?? '') ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar datos</button>
    </form>
</div>

<div class="card" style="max-width:420px;">
    <h3 style="margin-top:0;font-size:16px;">Cambiar contraseña</h3>

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
