<?php

if (!function_exists('vite_assets')) {
    function vite_assets(string $entry = 'resources/js/app.js'): string
    {
        $isDev = ENVIRONMENT !== 'production';
        if ($isDev) {
            $devUrl = 'http://localhost:5173';
            return <<<HTML
            <script type="module" src="{$devUrl}/@vite/client"></script>
            <script type="module" src="{$devUrl}/{$entry}"></script>
            HTML;
        }

        $manifestPath = ROOTPATH . 'public/build/.vite/manifest.json';
        if (!file_exists($manifestPath)) {
            return '<!-- Vite manifest not found. Silakan jalankan: npm run build -->';
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);
        $output = '';

        if (isset($manifest[$entry])) {
            $file = $manifest[$entry]['file']; // sudah include "assets/..."
            $output .= "<script type=\"module\" src=\"" . base_url("build/{$file}") . "\"></script>";

            if (isset($manifest[$entry]['css'])) {
                foreach ($manifest[$entry]['css'] as $css) {
                    $output .= "<link rel=\"stylesheet\" href=\"" . base_url("build/{$css}") . "\">";
                }
            }
        }

        return $output;
    }
}
