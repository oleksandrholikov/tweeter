<?php
$dsn = 'mysql:dbname=twitter;host=127.0.0.1';

$user = 'sasha';
$password = 'losos';
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}