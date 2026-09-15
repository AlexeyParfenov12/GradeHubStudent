<?php

$dbHost = getenv('DB_HOST') ?: 'localhost';
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$dbName = getenv('DB_NAME');

if (!$dbUser || !$dbPassword || !$dbName) {
    die('Database configuration is missing.');
}

$connect = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($connect->connect_error) {
    die('Connection failed: ' . $connect->connect_error);
}
