<?php
require 'database.php';

if (isset($_SESSION['username'])) {
    // Haal de rol van de ingelogde gebruiker op
    $username = $_SESSION['username'];
    $query = "SELECT role FROM users WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindvalue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Als de gebruiker bestaat, haal de rol op
    if ($row) {
        $role = $row['role'];
    } else {
        $role = '';
    }
} else {
    $role = '';
}
?>
<header>
    <nav class="bg-gray-800 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-white text-2xl font-bold"><a href="index.php">Pokédex</a></div>
            <ul class="flex space-x-6">
                <li><a href="#" class="text-gray-300 hover:text-white">Mijn Verzameling</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Zeldzame Pokémon</a></li>
                <?php if ($role === 'admin') { ?>
                    <li class="dropdown">
                        <a href="#">Gebruikers</a>
                        <div class="dropdown-content">
                            <a href="users_index.php">Bekijken</a>
                            <a href="users_add.php">Toevoegen</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#">Kaarten</a>
                        <div>
                            <a href="pokemon_index.php">Bekijken</a>
                            <a href="pokemon_add.php">Toevoegen</a>
                        </div>
                    </li>
                <?php } ?>
                <li><a href="#" class="text-gray-300 hover:text-white">Over Ons</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Contact</a></li>
                    <div class="dropdown">
                        <button class="dropdown_button">
                            <?php
                            if(isset($_SESSION['username'])){
                            ?>
                            <a href="#"><?php echo $_SESSION['username'] ?></a>
                            <?php
                            } else {
                            ?>
                            <a href="login.php">Inloggen</a>
                            <?php   
                            }
                            ?>
                        </button>
                        <ul class="dropdown_content">
                            <li><a href="#">Mijn gegevens</a></li>
                            <?php
                            if(isset($_SESSION['username'])){
                            ?>
                            <li><a href="logout.php" class="btn btn-danger">Uitloggen</a></li>
                            <?php
                            } else {
                            ?>
                            <li><button id="login_button" onclick="window.location.href = 'login.php';">Login</button></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>