<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin' ?> — MAEWALLISCORP</title>
    <style>
        :root {
            --blue: #4a5f83;
            --blue-dark: #333f56;
            --blue-darker: #232b3b;
            --pale: #eef1f6;
            --border: #dde2ec;
            --ink: #1c2230;
            --ink-muted: #5a6376;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            background: var(--pale);
            color: var(--ink);
        }
        a { color: inherit; }
        .admin-shell { display: flex; min-height: 100vh; }
        .admin-sidebar {
            width: 220px;
            flex-shrink: 0;
            background: var(--blue-darker);
            color: #fff;
            padding: 20px 0;
        }
        .admin-sidebar h1 {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.06em;
            padding: 0 20px 16px;
            margin: 0;
            border-bottom: 1px solid rgba(255,255,255,0.12);
        }
        .admin-nav { list-style: none; margin: 12px 0 0; padding: 0; }
        .admin-nav a {
            display: block;
            padding: 10px 20px;
            font-size: 14px;
            text-decoration: none;
            color: rgba(255,255,255,0.8);
        }
        .admin-nav a:hover, .admin-nav a.active { background: rgba(255,255,255,0.08); color: #fff; }
        .admin-main { flex: 1; padding: 28px 36px; }
        .admin-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .admin-topbar h2 { margin: 0; font-size: 22px; }
        .admin-topbar form { margin: 0; }
        .btn {
            display: inline-block;
            border: none;
            border-radius: 8px;
            padding: 9px 16px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-primary { background: var(--blue); color: #fff; }
        .btn-secondary { background: #fff; color: var(--ink); border: 1px solid var(--border); }
        .btn-danger { background: #c0392b; color: #fff; }
        .card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 10px 12px; border-bottom: 1px solid var(--border); font-size: 14px; vertical-align: top; }
        th { color: var(--ink-muted); font-weight: 600; font-size: 12.5px; text-transform: uppercase; letter-spacing: 0.03em; }
        .field { margin-bottom: 16px; }
        .field label { display: block; font-size: 13.5px; font-weight: 600; margin-bottom: 6px; }
        .field input[type=text], .field input[type=email], .field input[type=password], .field input[type=number], .field textarea {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
        }
        .field textarea { resize: vertical; }
        .field small { display: block; color: var(--ink-muted); margin-top: 4px; font-size: 12.5px; }
        .alert { padding: 10px 14px; border-radius: 8px; font-size: 14px; margin-bottom: 16px; }
        .alert-error { background: #fdecea; color: #c0392b; }
        .alert-success { background: #e8f6ee; color: #1e7e34; }
        .row-actions a { font-size: 13px; margin-right: 10px; }
        .empty-state { color: var(--ink-muted); font-size: 14px; padding: 20px 0; }
        .pill { display: inline-block; font-size: 12px; padding: 2px 8px; border-radius: 999px; background: var(--pale); color: var(--blue); font-weight: 600; }
    </style>
</head>
<body>
<div class="admin-shell">
    <aside class="admin-sidebar">
        <h1>MAEWALLISCORP<br>Admin</h1>
        <ul class="admin-nav">
            <li><a href="/admin">Dashboard</a></li>
            <li><a href="/admin/messages">Mensajes de contacto</a></li>
            <li><a href="/admin/services">Servicios</a></li>
            <li><a href="/admin/portfolio">Portafolio</a></li>
            <li><a href="/admin/partners">Socios</a></li>
            <li><a href="/admin/settings">Textos del sitio</a></li>
            <li><a href="/admin/account">Mi cuenta</a></li>
        </ul>
    </aside>
    <main class="admin-main">
        <div class="admin-topbar">
            <h2><?= $title ?? '' ?></h2>
            <form method="post" action="/admin/logout">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-secondary">Cerrar sesión</button>
            </form>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <?= $content ?? '' ?>
    </main>
</div>
</body>
</html>
