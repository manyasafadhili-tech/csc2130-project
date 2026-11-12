<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/response.php';

require_post_request();

$token = (string) ($_POST['token'] ?? '');
$password = (string) ($_POST['password'] ?? '');
$confirmation = (string) ($_POST['password_confirmation'] ?? '');

if (preg_match('/\A[a-f0-9]{64}\z/', $token) !== 1) {
    render_message(400, 'Invalid reset link', 'Request a new password reset link and try again.');
}

if (strlen($password) < RESET_PASSWORD_MIN_BYTES || strlen($password) > RESET_PASSWORD_MAX_BYTES) {
    render_message(400, 'Password does not meet the requirements', 'Choose a password between 8 and 72 bytes long.');
}

if (!hash_equals($password, $confirmation)) {
    render_message(400, 'Passwords do not match', 'Enter the same password in both fields and try again.');
}

try {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    if ($passwordHash === false) {
        throw new RuntimeException('PHP could not hash the new password.');
    }

    $statement = database_connection()->prepare(
        'UPDATE users
         SET password_hash = :password_hash,
             reset_token_hash = NULL,
             reset_expires_at = NULL
         WHERE reset_token_hash = :token_hash
           AND reset_expires_at > UTC_TIMESTAMP()'
    );
    $statement->execute([
        'password_hash' => $passwordHash,
        'token_hash' => hash('sha256', $token),
    ]);

    if ($statement->rowCount() !== 1) {
        render_message(400, 'Reset link expired or already used', 'Request a new password reset link and try again.');
    }
} catch (Throwable $error) {
    log_server_error($error);
    render_message(503, 'Password reset unavailable', 'The password reset service is temporarily unavailable. Please try again later.');
}

render_message(200, 'Password changed', 'Your password has been changed. You can now use your new password.');
