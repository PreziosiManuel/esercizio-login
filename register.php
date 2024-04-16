<?php

include __DIR__ . "/db.php";


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
