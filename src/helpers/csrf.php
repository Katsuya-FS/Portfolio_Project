<?php
declare(strict_types=1);

function CreateCsrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return (string) $_SESSION['csrf_token'];
}

function ValidateCsrfToken(?string $CsrfToken): bool
{
    return is_string($CsrfToken)
        && isset($_SESSION['csrf_token'])
        && hash_equals((string) $_SESSION['csrf_token'], $CsrfToken);
}
