<?php
require 'database.php';
session_start();

// Controleer of de 'id' parameter in de URL zit
if (!isset($_GET['id'])) {
    echo "Geen gebruiker geselecteerd.";
    exit();
}

$id = $_GET['id'];

// Haal de gegevens van het formulier op
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];  // Wachtwoord
$address = $_POST['address'];
$city = $_POST['city'];
$role = $_POST['role'];

// Controleer of het wachtwoord is ingevuld
if (!empty($password)) {
    // Hasht het wachtwoord als het is ingevuld
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
} else {
    // Haal het huidige wachtwoord uit de database (indien geen nieuw wachtwoord)
    $sql = "SELECT password FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Geen gebruiker gevonden met dit ID.";
        exit();
    }

    $hashedPassword = $user['password'];  // Gebruik het bestaande wachtwoord
}

// Update query
$sql = "
    UPDATE users 
    SET firstname = :firstname, 
        lastname = :lastname, 
        email = :email, 
        username = :username, 
        password = :password, 
        address = :address, 
        city = :city, 
        role = :role 
    WHERE id = :id
";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $hashedPassword);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':city', $city);
$stmt->bindParam(':role', $role);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

try {
    // Voer de query uit
    $stmt->execute();

    // Redirect naar de gebruikerslijst of een andere pagina
    header("Location: users_index.php");  // Of een andere pagina zoals je dat wilt
    exit;
} catch (PDOException $e) {
    echo "Fout bij het bijwerken van de gegevens: " . $e->getMessage();
}

$conn = null;  // Sluit de databaseverbinding
?>