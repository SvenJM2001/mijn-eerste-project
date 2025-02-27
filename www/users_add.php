<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Create</title>
</head>
<body>
    <?php include 'header.php';?>

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
        <button type="submit">inloggen</button>
    </form>
    
</body>
</html>