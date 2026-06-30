    <!DOCTYPE html>
    <html>

    <head>
        <title>CI4 Tailwind</title>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;family=DM+Sans:wght@700&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
        <link
            rel="stylesheet"
            href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <link rel="stylesheet" href="http://localhost:8080/build/assets/app-D2a9PzBZ.css">
<script type="module" src="http://localhost:8080/build/assets/app-LFPsXGkn.js"></script>
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
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>