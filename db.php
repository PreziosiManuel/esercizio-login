<?php
// Avvio della sessione
session_start();

// Credenziali di connessione al database
$host = 'localhost'; // Host del database
$db   = 'database_utenti'; // Nome del database
$user = 'root'; // Nome utente del database
$pass = ''; // Password del database

// Stringa di connessione al database usando PDO
$dsn = "mysql:host=$host;dbname=$db";

// Opzioni per la connessione PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Connessione al database
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Gestione dell'errore di connessione
    die("Connessione al database fallita: " . $e->getMessage());
}