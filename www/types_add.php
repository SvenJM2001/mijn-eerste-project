<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Create</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <?php include 'header.php';?>

    <form action="types_add_process.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="name">Naam:</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="image">Afbeelding:</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit">Toevoegen</button>
    </form>
    
</body>
</html>