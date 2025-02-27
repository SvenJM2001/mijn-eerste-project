<?php
include "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Haal de ingevoerde gegevens op
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Zoek naar de gebruiker in de database
    $sql = "SELECT id, username, password, role FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);

    // Bind de parameters
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);

    // Voer de query uit
    if ($stmt->execute()) {
        // Als de gebruiker wordt gevonden
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Controleer of het ingevoerde wachtwoord klopt
            if (password_verify($password, $user['password'])) {
                // Sessie starten
                session_start();

                // Zet de sessiegegevens
                $_SESSION['username'] = $user['username'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                // Redirect naar de homepagina of een andere pagina
                header("Location: index.php");
                exit();
            } else {
                echo "Onjuist wachtwoord!";
            }
        } else {
            echo "Gebruiker niet gevonden!";
        }
    } else {
        echo "Er is een fout opgetreden bij het uitvoeren van de query.";
    }
}
?>