<?php
declare(strict_types=1);

function render_message(int $status, string $title, string $message): never
{
    http_response_code($status);
    header('Cache-Control: no-store, private');
    header('Content-Type: text/html; charset=UTF-8');
    header('Referrer-Policy: no-referrer');
    $safeTitle = htmlspecialchars($title, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $safeMessage = htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

    echo '<!doctype html><html lang="en"><head><meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>' . $safeTitle . ' | Fadhili Software Engineering</title>';
    echo '<style>body{margin:0;background:#f4f8fb;color:#243b53;font:16px/1.6 Arial,sans-serif}main{box-sizing:border-box;width:min(560px,calc(100% - 32px));margin:12vh auto;padding:32px;border-radius:14px;background:#fff;box-shadow:0 8px 24px #102a4310}h1{color:#102a43}a{color:#176b87}</style>';
    echo '</head><body><main><h1>' . $safeTitle . '</h1><p>' . $safeMessage . '</p>';
    echo '<p><a href="../index.html">Return to the home page</a></p></main></body></html>';
    exit;
}

function require_post_request(): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
        header('Allow: POST');
        render_message(405, 'Method not allowed', 'Submit this form using the page provided.');
    }
}

function log_server_error(Throwable $error): void
{
    error_log(sprintf('[password-reset] %s: %s', get_class($error), $error->getMessage()));
}
