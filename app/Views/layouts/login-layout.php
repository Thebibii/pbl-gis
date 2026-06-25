<!DOCTYPE html>
<html>

<head>
    <title>CI4 Tailwind</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;family=DM+Sans:wght@700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <?= vite_assets() ?>
</head>

<body>
    <?= $this->renderSection('content') ?>
    <?= $this->renderSection('scripts') ?>
</body>

</html>