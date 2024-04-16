<?php
session_start();

// Controlla se l'utente è loggato
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ottieni il nome dell'utente loggato
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h2>Benvenuto <?php echo $username; ?>!</h2>
    <p>Questa è la tua home page.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
