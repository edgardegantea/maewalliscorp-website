<?php

if (! function_exists('vite_assets')) {
    /**
     * Emits the <script>/<link> tags needed to load the React frontend.
     * In development it points at the Vite dev server for HMR; in
     * production it reads frontend/manifest.json and links the hashed
     * build output that lives in public/build.
     */
    function vite_assets(string $entry = 'src/main.tsx'): string
    {
        $devServer = 'http://localhost:5173';

        if (ENVIRONMENT === 'development' && vite_dev_server_is_running($devServer)) {
            return <<<HTML
                <script type="module">
                    import RefreshRuntime from "{$devServer}/@react-refresh"
                    RefreshRuntime.injectIntoGlobalHook(window)
                    window.\$RefreshReg\$ = () => {}
                    window.\$RefreshSig\$ = () => (type) => type
                    window.__vite_plugin_react_preamble_installed__ = true
                </script>
                <script type="module" src="{$devServer}/@vite/client"></script>
                <script type="module" src="{$devServer}/{$entry}"></script>
                HTML;
        }

        $manifestPath = FCPATH . 'build/.vite/manifest.json';

        if (! is_file($manifestPath)) {
            return '<!-- Vite manifest not found. Run `npm run build` in frontend/. -->';
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);

        if (! isset($manifest[$entry])) {
            return "<!-- Vite manifest is missing entry: {$entry} -->";
        }

        $chunk = $manifest[$entry];
        $tags  = [];

        foreach ($chunk['css'] ?? [] as $cssFile) {
            $tags[] = '<link rel="stylesheet" href="/build/' . $cssFile . '">';
        }

        $tags[] = '<script type="module" src="/build/' . $chunk['file'] . '"></script>';

        return implode("\n    ", $tags);
    }
}

if (! function_exists('vite_dev_server_is_running')) {
    function vite_dev_server_is_running(string $url): bool
    {
        $handle = @fsockopen('localhost', 5173, $errno, $errstr, 0.2);

        if ($handle) {
            fclose($handle);

            return true;
        }

        return false;
    }
}
