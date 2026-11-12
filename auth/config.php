<?php
declare(strict_types=1);

const RESET_TOKEN_LIFETIME_MINUTES = 30;
const RESET_PASSWORD_MIN_BYTES = 8;
const RESET_PASSWORD_MAX_BYTES = 72;

function app_config(string $name, string $default = ''): string
{
    $value = getenv($name);
    return $value === false ? $default : $value;
}

function database_connection(): PDO
{
    static $connection = null;

    if ($connection instanceof PDO) {
        return $connection;
    }

    $host = app_config('DB_HOST', '127.0.0.1');
    $database = app_config('DB_NAME', 'csc2130_project');
    $username = app_config('DB_USER', 'root');
    $password = app_config('DB_PASSWORD');
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $host, $database);

    $connection = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $connection;
}

function reset_base_url(): string
{
    $url = app_config(
        'PASSWORD_RESET_BASE_URL',
        'http://localhost/CSC2130-project/reset-password.php'
    );

    if (filter_var($url, FILTER_VALIDATE_URL) === false || !in_array(parse_url($url, PHP_URL_SCHEME), ['http', 'https'], true)) {
        throw new RuntimeException('PASSWORD_RESET_BASE_URL must be a valid HTTP or HTTPS URL.');
    }

    return $url;
}

function reset_sender_address(): string
{
    $address = app_config('PASSWORD_RESET_FROM');

    if (filter_var($address, FILTER_VALIDATE_EMAIL) === false) {
        throw new RuntimeException('Set PASSWORD_RESET_FROM to a valid sender email address.');
    }

    return $address;
}
