<?php
declare(strict_types=1);

function BuildSiteUrl(string $RelativePath = ''): string
{
    $ScriptPath = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? ''));
    $BasePath = rtrim(dirname($ScriptPath), '/.');
    if (str_ends_with($BasePath, '/public')) {
        $BasePath = substr($BasePath, 0, -7);
    }

    return $BasePath . '/' . ltrim($RelativePath, '/');
}

function BuildAssetUrl(string $AssetPath): string
{
    return BuildSiteUrl('assets/' . ltrim($AssetPath, '/'));
}
