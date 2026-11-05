<?php
declare(strict_types=1);

function RenderTemplate(string $TemplateName, array $ViewData = []): void
{
    $TemplatePath = dirname(__DIR__, 2) . '/templates/' . $TemplateName . '.php';
    if (!is_file($TemplatePath)) {
        throw new RuntimeException('Template not found.');
    }

    extract($ViewData, EXTR_SKIP);
    require $TemplatePath;
}
