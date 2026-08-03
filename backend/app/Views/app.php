<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= esc($description) ?>">
    <title><?= esc($title) ?></title>

    <link rel="canonical" href="<?= esc($url) ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="MAEWALLISCORP">
    <meta property="og:title" content="<?= esc($title) ?>">
    <meta property="og:description" content="<?= esc($description) ?>">
    <meta property="og:url" content="<?= esc($url) ?>">
    <meta property="og:image" content="<?= esc(base_url('og-image.jpg')) ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="es_MX">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc($title) ?>">
    <meta name="twitter:description" content="<?= esc($description) ?>">
    <meta name="twitter:image" content="<?= esc(base_url('og-image.jpg')) ?>">

    <script>
        (function () {
            try {
                var stored = localStorage.getItem('mwc-theme');
                var theme = stored || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
                document.documentElement.setAttribute('data-theme', theme);
            } catch (e) {}
        })();
    </script>
</head>
<body>
    <div id="root"></div>

    <?= vite_assets() ?>
</body>
</html>
