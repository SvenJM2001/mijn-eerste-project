<?php
session_start();
require 'database.php';
require 'vendor/autoload.php';

use Carbon\Carbon;

printf("Now: %s", Carbon::now());

// Verkrijg de zoek- en filterwaarden uit de URL
$search = isset($_GET['search']) ? $_GET['search'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

// Basis SQL-query
$sql = "SELECT * FROM cards WHERE 1";

// Voeg zoekfilter toe
if (!empty($search)) {
    $sql .= " AND name LIKE :search";
}

// Voeg typefilter toe
if (!empty($type)) {
    $sql .= " AND type = :type";
}

$stmt = $conn->prepare($sql);

// Bind de zoekparameter
if (!empty($search)) {
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
}

// Bind de typeparameter
if (!empty($type)) {
    $stmt->bindParam(':type', $type, PDO::PARAM_STR);
}

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
    <?php include 'header.php'; ?>


    <!-- Main Content -->
    <div class="w-full">
        <!-- Hero Section -->
        <div class="bg-blue-600 text-white py-20 px-8">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl font-bold mb-4">Welkom bij mijn Pokémon Verzameling</h1>
                <p class="text-xl">Ontdek de wonderlijke wereld van Pokémon en bekijk mijn uitgebreide collectie!</p>
            </div>
        </div>

        
        <!-- Zoek en filter sectie -->
        <div class="w-full bg-gray-200 py-8 px-8">
            <div class="max-w-4xl mx-auto flex justify-between items-center">
                <form method="GET" action="index.php" class="flex items-center space-x-4">
                    <input type="text" name="search" id="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" placeholder="Zoek op naam" class="p-2 border border-gray-300 rounded">
                    <select name="type" id="type" class="p-2 border border-gray-300 rounded">
                        <option value="">Alle types</option>
                        <option value="bug" <?php echo isset($_GET['type']) && $_GET['type'] == 'bug' ? 'selected' : ''; ?>>Bug</option>
                        <option value="dark" <?php echo isset($_GET['type']) && $_GET['type'] == 'dark' ? 'selected' : ''; ?>>Dark</option>
                        <option value="dragon" <?php echo isset($_GET['type']) && $_GET['type'] == 'dragon' ? 'selected' : ''; ?>>Dragon</option>
                        <option value="electric" <?php echo isset($_GET['type']) && $_GET['type'] == 'electric' ? 'selected' : ''; ?>>Electric</option>
                        <option value="fairy" <?php echo isset($_GET['type']) && $_GET['type'] == 'fairy' ? 'selected' : ''; ?>>Fairy</option>
                        <option value="fire" <?php echo isset($_GET['type']) && $_GET['type'] == 'fire' ? 'selected' : ''; ?>>Fire</option>
                        <option value="flying" <?php echo isset($_GET['type']) && $_GET['type'] == 'flying' ? 'selected' : ''; ?>>Flying</option>
                        <option value="ghost" <?php echo isset($_GET['type']) && $_GET['type'] == 'ghost' ? 'selected' : ''; ?>>Ghost</option>
                        <option value="grass" <?php echo isset($_GET['type']) && $_GET['type'] == 'grass' ? 'selected' : ''; ?>>Grass</option>
                        <option value="ground" <?php echo isset($_GET['type']) && $_GET['type'] == 'ground' ? 'selected' : ''; ?>>Ground</option>
                        <option value="ice" <?php echo isset($_GET['type']) && $_GET['type'] == 'ice' ? 'selected' : ''; ?>>Ice</option>
                        <option value="normal" <?php echo isset($_GET['type']) && $_GET['type'] == 'normal' ? 'selected' : ''; ?>>Normal</option>
                        <option value="poison" <?php echo isset($_GET['type']) && $_GET['type'] == 'poison' ? 'selected' : ''; ?>>Poison</option>
                        <option value="psychic" <?php echo isset($_GET['type']) && $_GET['type'] == 'psychic' ? 'selected' : ''; ?>>Psychic</option>
                        <option value="rock" <?php echo isset($_GET['type']) && $_GET['type'] == 'rock' ? 'selected' : ''; ?>>Rock</option>
                        <option value="steel" <?php echo isset($_GET['type']) && $_GET['type'] == 'steel' ? 'selected' : ''; ?>>Steel</option>
                        <option value="water" <?php echo isset($_GET['type']) && $_GET['type'] == 'water' ? 'selected' : ''; ?>>Water</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white p-2 rounded">Zoeken</button>
                </form>
            </div>
        </div>

        <!-- Pokemon Grid -->
        <div class="max-w-7xl mx-auto px-8 py-12">
            <h2 class="text-3xl font-bold mb-8">Mijn Favoriete Pokémon</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($cards as $card): ?>
                    <!-- Pokemon Card  -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="./uploads/<?php echo $card['image']?>" alt="<?php echo $card['name']?>" class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2"><?php echo $card['name']?></h3>
                            <p class="text-gray-600 mb-4"><?php echo $card['description']?></p>
                            <a href="pokemon_detail.php?id=<?php echo $card['id']; ?>" class="text-blue-600 hover:text-blue-800">Meer informatie →</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h4 class="text-xl font-bold mb-4">Over Ons</h4>
                <p class="text-gray-400">Wij zijn gepassioneerde Pokémon verzamelaars die onze liefde voor deze geweldige wezens willen delen met de wereld.</p>
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
</body>

</html>
