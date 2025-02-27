<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Create</title>
</head>
<body>
    <?php include 'header.php';?>
    <form action="login_process.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="username">Gebruikersnaam:</label>
            <input type="username" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Wachtwoord:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">inloggen</button>
    </form>
        <div>
            <p>heb je nog geen account? <a href="register.php">Registreer hier</a></p>
        </div>
    
</body>
</html>