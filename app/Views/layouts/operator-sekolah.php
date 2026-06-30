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
    <div class="flex h-screen w-full">
        <?= $this->include('components/panel-control/operator-sekolah.php') ?>
        <main class="flex-1 flex flex-col relative overflow-y-auto">
            <?= $this->include('components/panel-control/top_bar.php') ?>
            <?= $this->renderSection('content') ?>
        </main>

    </div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>