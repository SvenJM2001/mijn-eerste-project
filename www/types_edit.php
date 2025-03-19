<?php
require 'database.php';
session_start();

// Controleer of er een 'id' parameter in de URL zit
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL-query om de gegevens van de gebruiker op te halen op basis van de id
    $sql = "
        SELECT *
        FROM type
        WHERE id = :id;
    ";

    // Prepare en voer de query uit
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $type = $stmt->fetch(PDO::FETCH_ASSOC);

    // Als er geen resultaten zijn, laat een bericht zien
    if (!$type) {
        echo "Geen gegevens gevonden voor deze type.";
        exit();
    }
} else {
    echo "Geen type geselecteerd.";
    exit();
}

$conn = null;  // Sluit de databaseverbinding
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Type Wijzigen</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <?php include 'header.php';?>

    <form action="types_edit_process.php?id=<?php echo $type['id']; ?>" method="post" enctype="multipart/form-data">
        <div>
            <label for="name">Naam:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($type['name']); ?>">
        </div>
        <div>
            <label for="image">Afbeelding:</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit">Bijwerken</button>
    </form>

</body>
</html>