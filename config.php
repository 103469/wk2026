<?php
// Foutmeldingen zichtbaar maken
ini_set('display_errors', 1);
error_reporting(E_ALL);

// De naam van de SQLite database
$db = 'wk2026.db';

try {
    $conn = new PDO("sqlite:$db");
} catch (PDOException $e) {
    echo $e->getMessage();
}
