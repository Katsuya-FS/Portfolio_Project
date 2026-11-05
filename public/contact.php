<?php
declare(strict_types=1);

require dirname(__DIR__) . '/src/helpers.php';
header('Content-Type: application/json; charset=utf-8');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params(['httponly' => true, 'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off', 'samesite' => 'Lax']);
    session_start();
}
$SendJsonResponse = static function (int $StatusCode, array $ResponseBody): never {
    http_response_code($StatusCode);
    echo json_encode($ResponseBody, JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE);
    exit;
};
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $SendJsonResponse(405, ['ok' => false, 'message' => 'Please send the form to contact.php.']);
}
if (!ValidateCsrfToken($_POST['csrf_token'] ?? null)) {
    $SendJsonResponse(403, ['ok' => false, 'message' => 'Your session expired. Refresh the page and try again.']);
}
if (!empty($_POST['website'] ?? '')) {
    $SendJsonResponse(200, ['ok' => true, 'message' => 'Thanks for reaching out.']);
}
if (isset($_SESSION['contact_sent_at']) && time() - (int) $_SESSION['contact_sent_at'] < 60) {
    $SendJsonResponse(429, ['ok' => false, 'message' => 'Please wait a minute before sending another message.']);
}

$SenderName = trim((string) ($_POST['name'] ?? ''));
$SenderEmail = trim((string) ($_POST['email'] ?? ''));
$MessageText = trim((string) ($_POST['message'] ?? ''));
$SenderName = preg_replace('/[\r\n\x00-\x1F\x7F]/u', '', $SenderName) ?? '';
$SenderEmail = preg_replace('/[\r\n\x00-\x1F\x7F]/u', '', $SenderEmail) ?? '';
$MessageText = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $MessageText) ?? '';
$IsValidUtf8 = static fn (string $Text): bool => preg_match('//u', $Text) === 1;
$GetTextLength = static fn (string $Text): int => function_exists('mb_strlen') ? mb_strlen($Text, 'UTF-8') : strlen($Text);

if (
    !$IsValidUtf8($SenderName)
    || !$IsValidUtf8($SenderEmail)
    || !$IsValidUtf8($MessageText)
    || $SenderName === ''
    || $GetTextLength($SenderName) > 100
    || !filter_var($SenderEmail, FILTER_VALIDATE_EMAIL)
    || $GetTextLength($SenderEmail) > 254
    || $GetTextLength($MessageText) < 10
    || $GetTextLength($MessageText) > 5000
) {
    $SendJsonResponse(422, ['ok' => false, 'message' => 'Check your name, email, and message (10–5000 characters), then try again.']);
}

$_SESSION['contact_sent_at'] = time();
$SiteConfig = require dirname(__DIR__) . '/src/config.php';
$RecipientEmail = $SiteConfig['mail_to'];
$WasEmailSent = false;

if ($RecipientEmail !== '' && filter_var($RecipientEmail, FILTER_VALIDATE_EMAIL)) {
    $EmailSubject = 'Portfolio contact from ' . $SenderName;
    $EmailBody = "Name: {$SenderName}\nEmail: {$SenderEmail}\n\n{$MessageText}";
    $MailHeaders = [
        'From: Portfolio contact <' . $RecipientEmail . '>',
        'Reply-To: ' . $SenderEmail,
        'Content-Type: text/plain; charset=UTF-8',
    ];
    $WasEmailSent = mail($RecipientEmail, $EmailSubject, $EmailBody, implode("\r\n", $MailHeaders));
}

if (!$WasEmailSent) {
    $SendJsonResponse(503, ['ok' => false, 'message' => 'Messages are not configured yet. Please email me directly.']);
}

$SendJsonResponse(200, ['ok' => true, 'message' => 'Thanks! Your message is on its way.']);
