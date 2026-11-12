<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/response.php';

require_post_request();

$email = trim((string) ($_POST['email'] ?? ''));
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false || strlen($email) > 254) {
    render_message(400, 'Check your email address', 'Enter a valid email address and try again.');
}

try {
    $pdo = database_connection();
    $statement = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
    $statement->execute(['email' => $email]);
    $user = $statement->fetch();

    if ($user !== false) {
        $token = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $token);
        $expiresAt = (new DateTimeImmutable('now', new DateTimeZone('UTC')))
            ->modify('+' . RESET_TOKEN_LIFETIME_MINUTES . ' minutes')
            ->format('Y-m-d H:i:s');

        $statement = $pdo->prepare(
            'UPDATE users
             SET reset_token_hash = :token_hash, reset_expires_at = :expires_at
             WHERE id = :id'
        );
        $statement->execute([
            'token_hash' => $tokenHash,
            'expires_at' => $expiresAt,
            'id' => $user['id'],
        ]);

        try {
            $resetUrl = reset_base_url() . '?token=' . rawurlencode($token);
            $subject = 'Reset your Fadhili Software Engineering password';
            $body = "We received a request to reset the password for your account.\n\n"
                . "Use this link within " . RESET_TOKEN_LIFETIME_MINUTES . " minutes:\n"
                . $resetUrl . "\n\n"
                . "If you did not request a password reset, you can ignore this email.";
            $headers = 'From: ' . reset_sender_address() . "\r\n"
                . "Content-Type: text/plain; charset=UTF-8\r\n";

            if (!mail($email, $subject, $body, $headers)) {
                throw new RuntimeException('PHP mail() could not send the password reset email.');
            }
        } catch (Throwable $error) {
            $statement = $pdo->prepare(
                'UPDATE users
                 SET reset_token_hash = NULL, reset_expires_at = NULL
                 WHERE id = :id AND reset_token_hash = :token_hash'
            );
            $statement->execute(['id' => $user['id'], 'token_hash' => $tokenHash]);
            throw $error;
        }
    }
} catch (Throwable $error) {
    log_server_error($error);
    render_message(503, 'Password reset unavailable', 'The password reset service is temporarily unavailable. Please try again later.');
}

render_message(
    200,
    'Check your email',
    'If an account exists for that email address, a password reset link will arrive shortly. The link is valid for 30 minutes.'
);
