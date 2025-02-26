<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Create</title>
</head>
<body>
    <nav class="bg-gray-800 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-white text-2xl font-bold">Pokédex</div>
            <ul class="flex space-x-6">
                <li><a href="index.php" class="text-gray-300 hover:text-white">Home</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Mijn Verzameling</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Zeldzame Pokémon</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Over Ons</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Contact</a></li>
                <li><a href="#" class="text-gray-300 hover:text-white">Maak Kaart</a></li>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li><a href="logout.php">Uitloggen</a></li>
                <?php else : ?>
                    <li><a href="login.php">Inloggen</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <form action="pokemon_create_process.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="name">Naam:</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="type">Type:</label>
            <input type="text" name="type" id="type">
        </div>
        <div>
            <label for="rarity">Zeldzaamheid:</label>
            <select name="rarity" id="rarity">
                <option value="common">common</option>
                <option value="uncommon">uncommon</option>
                <option value="rare">rare</option>
                <option value="epic">epic</option>
                <option value="legendary">legendary</option>
            </select>
        </div>
        <div>
            <label for="description">Beschrijving:</label>
            <input type="text" name="description" id="description">

        </div>
        <div>
            <label for="price">Prijs:</label>
            <input type="number" name="price" id="price">
        </div>
        <div>
            <label for="image">Afbeelding:</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit">Toevoegen</button>
    </form>
    
</body>
</html>