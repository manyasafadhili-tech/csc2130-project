CREATE DATABASE IF NOT EXISTS csc2130_project
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE csc2130_project;

CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    email VARCHAR(254) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    reset_token_hash CHAR(64) DEFAULT NULL,
    reset_expires_at DATETIME DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY users_email_unique (email),
    KEY users_reset_token_hash_index (reset_token_hash)
) ENGINE=InnoDB;
