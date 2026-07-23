<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIS Sekolah</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;family=DM+Sans:wght@700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <?= vite_assets() ?>
</head>

<body>
    <?= $this->include('components/home/navbar.php') ?>
    <?= $this->renderSection('content') ?>

    <?php
    $currentRoute = service('router')->getMatchedRouteOptions()['as'] ?? '';
    ?>
    <?php if ($currentRoute !== 'peta'): ?>
        <?= $this->include('components/home/footer.php') ?>
    <?php endif; ?>
    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    <!-- Toast Alert System (vanilla JS) -->
    <script>
        (function() {
            const ICONS = {
                success: '<svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                error: '<svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                warning: '<svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                info: '<svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
            };

            const STYLES = {
                success: 'bg-green-50 border-green-500 text-green-800',
                error: 'bg-red-50 border-red-500 text-red-800',
                warning: 'bg-yellow-50 border-yellow-500 text-yellow-800',
                info: 'bg-blue-50 border-blue-500 text-blue-800'
            };

            function ensureContainer() {
                let container = document.getElementById('toast-container');
                if (!container) {
                    container = document.createElement('div');
                    container.id = 'toast-container';
                    container.className =
                        'fixed z-[9999] flex flex-col gap-2 ' +
                        'bottom-0 left-0 right-0 p-3 ' +
                        'sm:bottom-auto sm:left-auto sm:right-4 sm:top-8 sm:p-0 sm:w-full sm:max-w-sm';
                    document.body.appendChild(container);
                }
                return container;
            }

            function showAlert(type, message, duration = 4000) {
                type = STYLES[type] ? type : 'info';
                const container = ensureContainer();

                const toast = document.createElement('div');
                toast.className =
                    `flex items-start gap-3 border-l-4 rounded-lg shadow-lg p-4
                    transform transition-all duration-300 ease-out opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-4
                    ${STYLES[type]}`;

                toast.innerHTML = `
                    ${ICONS[type]}
                    <div class="flex-1 text-sm font-medium break-words"></div>
                    <button type="button" class="toast-close flex-shrink-0 text-current opacity-60 hover:opacity-100">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                `;

                // XSS-safe: textContent, bukan innerHTML, untuk isi pesan
                toast.querySelector('div.flex-1').textContent = message;

                container.appendChild(toast);

                requestAnimationFrame(() => {
                    toast.classList.remove('opacity-0', 'translate-y-2', 'sm:translate-x-4');
                });

                function remove() {
                    toast.classList.add('opacity-0', 'translate-y-2', 'sm:translate-y-0', 'sm:translate-x-4');
                    setTimeout(() => toast.remove(), 300);
                }

                toast.querySelector('.toast-close').addEventListener('click', remove);

                if (duration > 0) {
                    setTimeout(remove, duration);
                }

                return toast;
            }

            window.showAlert = showAlert;
        })();

        // Auto-trigger dari flashdata CI4
        document.addEventListener('DOMContentLoaded', () => {
            <?php foreach (['success', 'error', 'warning', 'info'] as $type): ?>
                <?php if (session()->getFlashdata($type)): ?>
                    showAlert('<?= $type ?>', <?= json_encode(session()->getFlashdata($type), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT) ?>);
                <?php endif; ?>
            <?php endforeach; ?>
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>