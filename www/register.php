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

    <form action="register_process.php" method="post" enctype="multipart/form-data">
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
            <label for="adress">Adres:</label>
            <input type="text" name="adress" id="adress">
        </div>
        <div>
            <label for="city">Stad:</label>
            <input type="text" name="city" id="city">
        </div>
        <button type="submit">register</button>
    </form>
    
</body>
</html>