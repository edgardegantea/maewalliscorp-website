<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión — MAEWALLISCORP Admin</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            background: linear-gradient(160deg, #232b3b 0%, #4a5f83 100%);
        }
        .login-card {
            background: #fff;
            border-radius: 14px;
            padding: 36px;
            width: 100%;
            max-width: 360px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.25);
        }
        .login-card h1 { font-size: 18px; margin: 0 0 4px; }
        .login-card p { margin: 0 0 24px; color: #5a6376; font-size: 14px; }
        .field { margin-bottom: 16px; }
        .field label { display: block; font-size: 13.5px; font-weight: 600; margin-bottom: 6px; }
        .field input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #dde2ec;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 11px;
            border: none;
            border-radius: 8px;
            background: #4a5f83;
            color: #fff;
            font-weight: 600;
            font-size: 14.5px;
            cursor: pointer;
        }
        .alert-error { background: #fdecea; color: #c0392b; padding: 10px 14px; border-radius: 8px; font-size: 13.5px; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>MAEWALLISCORP</h1>
        <p>Panel de administración</p>

        <?php if (! empty($error)): ?>
            <div class="alert-error"><?= esc($error) ?></div>
        <?php endif; ?>

        <form method="post" action="/admin/login">
            <?= csrf_field() ?>
            <div class="field">
                <label for="email">Correo</label>
                <input type="email" id="email" name="email" required autofocus>
            </div>
            <div class="field">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
