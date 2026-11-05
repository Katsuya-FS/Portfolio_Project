<?php
declare(strict_types=1);
?><!doctype html>
<html lang="en" data-theme="<?= EscapeHtml($Theme) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= EscapeHtml($Profile['pitch']) ?>">
    <meta property="og:title" content="<?= EscapeHtml($Profile['name']) ?> — <?= EscapeHtml($Profile['role']) ?>">
    <meta property="og:description" content="<?= EscapeHtml($Profile['pitch']) ?>">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="<?= $Theme === 'dark' ? '#0A0A0F' : '#F4FBF7' ?>">
    <title><?= EscapeHtml($Profile['name']) ?> — <?= EscapeHtml($Profile['role']) ?></title>
    <link rel="icon" type="image/svg+xml" href="<?= EscapeHtml(BuildAssetUrl('img/favicon.svg')) ?>?v=1">
    <script>
        if (!document.cookie.includes('theme=')) {
            document.documentElement.dataset.theme = matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= EscapeHtml(BuildAssetUrl('css/tokens.css')) ?>">
    <link rel="stylesheet" href="<?= EscapeHtml(BuildAssetUrl('css/base.css')) ?>">
    <link rel="stylesheet" href="<?= EscapeHtml(BuildAssetUrl('css/components.css')) ?>?v=2">
    <link rel="stylesheet" href="<?= EscapeHtml(BuildAssetUrl('css/themes.css')) ?>">
    <link rel="stylesheet" href="<?= EscapeHtml(BuildAssetUrl('css/responsive.css')) ?>?v=2">
    <link rel="stylesheet" href="<?= EscapeHtml(BuildAssetUrl('css/education-hero.css')) ?>?v=2">
    <link rel="stylesheet" href="<?= EscapeHtml(BuildAssetUrl('css/projects.css')) ?>?v=3">
    <link rel="stylesheet" href="<?= EscapeHtml(BuildAssetUrl('css/contact.css')) ?>?v=2">
    <link rel="stylesheet" href="<?= EscapeHtml(BuildAssetUrl('css/sections.css')) ?>?v=16">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/lenis@1.1.20/dist/lenis.min.js"></script>
    <script type="module" src="<?= EscapeHtml(BuildAssetUrl('js/main.js')) ?>?v=8"></script>
</head>
<body>
<a class="skip-link" href="#main-content">Skip to content</a>
<canvas class="ambient-canvas" aria-hidden="true"></canvas>
<?php require __DIR__ . '/partials/header.php'; ?>
<main id="main-content">
    <?php require __DIR__ . '/partials/hero.php'; ?>
    <?php require __DIR__ . '/partials/stack.php'; ?>
    <?php require __DIR__ . '/partials/education.php'; ?>
    <?php require __DIR__ . '/partials/projects.php'; ?>
    <?php require __DIR__ . '/partials/footer.php'; ?>
</main>
</body>
</html>


