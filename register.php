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

// Controlla se il modulo di registrazione è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati inviati dal modulo di registrazione
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    try {
        // Prepara la query per inserire l'utente nel database
        $stmt = $pdo->prepare("INSERT INTO login_users (username, password) VALUES (:username, :password)");
        // Esegue la query con i dati forniti
        $stmt->execute(['username' => $username, 'password' => $password]);
        // Messaggio di registrazione avvenuta con successo
        echo "Registrazione avvenuta con successo!";
    } catch (PDOException $e) {
        // Gestione dell'errore durante la registrazione
        echo "Errore durante la registrazione: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>
<body>
    <h2>Registrazione</h2>
    <!-- Modulo di registrazione -->
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Registrati">
    </form>
    <!-- Link per passare alla pagina di login -->
    <p>Hai già un account? <a href="login.php">Accedi qui</a>.</p>
</body>
</html>
