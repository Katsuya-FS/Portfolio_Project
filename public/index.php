<?php
declare(strict_types=1);

require dirname(__DIR__) . '/src/helpers.php';
$CookieTheme = $_COOKIE['theme'] ?? null;
$Theme = in_array($CookieTheme, ['dark', 'light'], true) ? $CookieTheme : 'dark';
$SiteConfig = require dirname(__DIR__) . '/src/config.php';
$Profile = require dirname(__DIR__) . '/src/data/profile.php';
$Stack = require dirname(__DIR__) . '/src/data/stack.php';
$Education = require dirname(__DIR__) . '/src/data/education.php';
try {
    $Projects = require dirname(__DIR__) . '/src/data/projects.php';
} catch (Throwable $ProjectDataError) {
    error_log('Portfolio project data could not be loaded: ' . $ProjectDataError->getMessage());
    $Projects = [];
}

if (!is_array($Projects)) {
    $Projects = [];
}

$Projects = array_values(array_filter($Projects, 'is_array'));

RenderTemplate('layout', [
    'Theme' => $Theme,
    'SiteConfig' => $SiteConfig,
    'Profile' => $Profile,
    'Stack' => $Stack,
    'Education' => $Education,
    'Projects' => $Projects,
]);
