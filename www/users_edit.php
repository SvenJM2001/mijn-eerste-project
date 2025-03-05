<?php
require 'database.php';
session_start();

// Controleer of er een 'id' parameter in de URL zit
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL-query om de gegevens van de gebruiker op te halen op basis van de id
    $sql = "
        SELECT *
        FROM users
        WHERE id = :id;
    ";

    // Prepare en voer de query uit
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Als er geen resultaten zijn, laat een bericht zien
    if (!$user) {
        echo "Geen gegevens gevonden voor deze gebruiker.";
        exit();
    }
} else {
    echo "Geen gebruiker geselecteerd.";
    exit();
}

$conn = null;  // Sluit de databaseverbinding
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Wijzigen</title>
</head>
<body>
    <?php include 'header.php';?>

    <form action="users_edit_process.php?id=<?php echo $user['id']; ?>" method="post" enctype="multipart/form-data">
    <div>
            <label for="firstname">Voornaam:</label>
            <input type="text" name="firstname" id="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>">
        </div>
        <div>
            <label for="lastname">Achternaam:</label>
            <input type="text" name="lastname" id="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>">
        </div>
        <div>
            <label for="username">Gebruikersnaam:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>">
        </div>
        <div>
            <label for="password">Wachtwoord:</label>
            <input type="password" name="password" id="password" placeholder="Voer hier een nieuw wachtwoord in (indien gewenst)">
        </div>
        <div>
            <label for="address">Adres:</label>
            <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($user['address']); ?>">
        </div>
        <div>
            <label for="city">Stad:</label>
            <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($user['city']); ?>">
        </div>
        <div>
            <label for="role">Rol:</label>
            <select name="role" id="role">
                <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>Gebruiker</option>
            </select>
        </div>
        <button type="submit">Bijwerken</button>
    </form>

</body>
</html>