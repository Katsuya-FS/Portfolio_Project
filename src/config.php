<?php
declare(strict_types=1);

$LocalConfigPath = dirname(__DIR__) . '/config.local.php';
$LocalSettings = is_file($LocalConfigPath) ? require $LocalConfigPath : [];
$LocalSettings = is_array($LocalSettings) ? $LocalSettings : [];
$ContactEmail = getenv('PORTFOLIO_EMAIL') ?: ($LocalSettings['email'] ?? 'alcordo.cyronejames11@gmail.com');
$SocialLinks = $LocalSettings['socials'] ?? [];

return [
    'name' => 'Cyrone James Alcordo',
    'role' => 'SOFTWARE DEVELOPER',
    'email' => $ContactEmail,
    'socials' => [
        'github' => getenv('PORTFOLIO_GITHUB') ?: ($SocialLinks['github'] ?? 'https://github.com/Katsuya-FS'),
        'linkedin' => getenv('PORTFOLIO_LINKEDIN') ?: ($SocialLinks['linkedin'] ?? ''),
        'facebook' => getenv('PORTFOLIO_FACEBOOK') ?: ($SocialLinks['facebook'] ?? 'https://web.facebook.com/alcordo.cyronejames'),
    ],
    'mail_to' => getenv('PORTFOLIO_EMAIL') ?: ($LocalSettings['mail_to'] ?? ''),
];
