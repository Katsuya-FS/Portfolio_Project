<?php
declare(strict_types=1);

function EscapeHtml(string $Value): string
{
    return htmlspecialchars($Value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
