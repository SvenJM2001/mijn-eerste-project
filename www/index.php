<?php
session_start();
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

$sql = "SELECT * FROM cards";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Verzameling</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Navigatie -->
    <nav class="bg-gray-800 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-white text-2xl font-bold">Pokédex</div>
            <ul class="flex space-x-6">
                <li><a href="#" class="text-gray-300 hover:text-white">Home</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Mijn Verzameling</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Zeldzame Pokémon</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Over Ons</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Contact</a></li>
                <li><a href="pokemon_create.php" class="text-gray-300 hover:text-white">Maak Kaart</a></li>
                <li><a class="nav" href="over_ons.php">Over Ons</a></li>
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

    <!-- Main Content -->
    <div class="w-full">
        <!-- Hero Section -->
        <div class="bg-blue-600 text-white py-20 px-8">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl font-bold mb-4">Welkom bij mijn Pokémon Verzameling</h1>
                <p class="text-xl">Ontdek de wonderlijke wereld van Pokémon en bekijk mijn uitgebreide collectie!</p>
            </div>
        </div>

        <!-- Pokemon Grid -->
        <div class="max-w-7xl mx-auto px-8 py-12">
            <h2 class="text-3xl font-bold mb-8">Mijn Favoriete Pokémon</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($cards as $card):?>
                    <!-- Pokemon Card  -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="./uploads/<?php echo $card['image']?>" alt=<?php echo $card['name']?>
                            class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2"><?php echo $card['name']?></h3>
                            <p class="text-gray-600 mb-4"><?php echo $card['description']?></p>
                            <a href="#" class="text-blue-600 hover:text-blue-800">Meer informatie →</a>
                        </div>
                    </div>
                <?php endforeach;?>
        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12">
            <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h4 class="text-xl font-bold mb-4">Over Ons</h4>
                    <p class="text-gray-400">Wij zijn gepassioneerde Pokémon verzamelaars die onze liefde voor deze
                        geweldige wezens willen delen met de wereld.</p>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-4">Snelle Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Verzameling</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-4">Contact</h4>
                    <p class="text-gray-400">Email: info@pokemon-verzameling.nl</p>
                    <p class="text-gray-400">Tel: +31 (0)6 12345678</p>
                    <p class="text-gray-400">Locatie: Amsterdam, Nederland</p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>