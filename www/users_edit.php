<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You are not logged in, please login. ";
    echo "<a href='login.php'>Login here</a>";
    exit;
}

if ($_SESSION['role'] != 'admin') {
    echo "You are not allowed to view this page, please login as admin";
    exit;
}
require 'database.php';

try {
    // Haal alle gebruikers op uit de database
    $sql = "SELECT * FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Haal de resultaten op als een associatieve array
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Something went wrong: " . $e->getMessage();
    exit;
}

require 'header.php';
?>
<main>
    <div class="container">
        <form action="" method="post"></form>
        <div>
            <label for="firstname">Voornaam:</label>
            <input type="text" name="firstname" id="firstname" required>
        </div>
        <div>
            <label for="lastname">Achternaam:</label>
            <input type="text" name="lastname" id="lastname" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="username">Gebruikersnaam:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Wachtwoord:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="address">Adres:</label>
            <input type="text" name="address" id="address">
        </div>
        <div>
            <label for="city">Stad:</label>
            <input type="text" name="city" id="city">
        </div>
        <div>
            <label for="role">Rol:</label>
            <select name="role" id="role">
                <option value="admin">Admin</option>
                <option value="user">Gebruiker</option>
            </select>
        </div>
    </div>
</main>
<?php require 'footer.php' ?>