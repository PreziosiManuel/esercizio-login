<?php
include __DIR__ . "/db.php";


// Controlla se il modulo di login è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati inviati dal modulo di login
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        // Prepara la query per ottenere l'utente dal database
        $stmt = $pdo->prepare("SELECT * FROM login_users WHERE username = :username");
        // Esegue la query con i dati forniti
        $stmt->execute(['username' => $username]);
        // Ottiene l'utente dalla query
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Imposta la variabile di sessione per l'utente loggato
            $_SESSION['username'] = $username;
            // Reindirizza alla pagina home dopo il login
            header("Location: home.php");
            exit;
        } else {
            // Messaggio di errore per credenziali errate
            echo "Username o password errati.";
        }
    } catch (PDOException $e) {
        // Gestione dell'errore durante il login
        echo "Errore durante il login: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <!-- Modulo di login -->
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Accedi">
    </form>
    <!-- Link per passare alla pagina di registrazione -->
    <p>Non hai un account? <a href="register.php">Registrati qui</a>.</p>
</body>
</html>
