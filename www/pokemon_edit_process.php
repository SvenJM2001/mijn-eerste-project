<?php
require 'database.php';

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verkrijg de gegevens van het formulier
    $id = $_GET['id'];  // Haal de id uit de URL
    $name = $_POST['name'];
    $type = $_POST['type'];
    $rarity = $_POST['rarity'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Image uploaden (optioneel)
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imagePath = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        $imagePath = null;
    }

    try {
        // Update query
        $sql = "UPDATE cards SET name = :name, type = :type, rarity = :rarity, description = :description, price = :price";
        
        // Voeg afbeelding toe aan query als die bestaat
        if ($imagePath) {
            $sql .= ", image = :image";
        }

        $sql .= " WHERE id = :id";

        $stmt = $conn->prepare($sql);

        // Bind de parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':rarity', $rarity);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        if ($imagePath) {
            $stmt->bindParam(':image', $imagePath);
        }
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        // Redirect naar pokemon_index.php na succesvolle update
        header("Location: pokemon_index.php");
        exit;
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
    }
}

$conn = null;
?>