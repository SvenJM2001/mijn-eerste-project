<?php
require 'database.php';
session_start();

// Controleer of er een 'id' parameter in de URL zit
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL-query om de gegevens van de gebruiker op te halen op basis van de id
    $sql = "
        SELECT *
        FROM cards
        WHERE id = :id;
    ";

    // Prepare en voer de query uit
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $card = $stmt->fetch(PDO::FETCH_ASSOC);

    // Als er geen resultaten zijn, laat een bericht zien
    if (!$card) {
        echo "Geen gegevens gevonden voor deze kaart.";
        exit();
    }
} else {
    echo "Geen kaart geselecteerd.";
    exit();
}

$conn = null;  // Sluit de databaseverbinding
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Wijzigen</title>
</head>
<body>
    <?php include 'header.php';?>

    <form action="pokemon_edit_process.php?id=<?php echo $card['id']; ?>" method="post" enctype="multipart/form-data">
        <div>
            <label for="name">Naam:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($card['name']); ?>" required>
        </div>
        <div>
            <label for="type">Type:</label>
            <select name="type" id="type">
                <option value="bug" <?php echo $card['type'] == 'bug' ? 'selected' : ''; ?>>Bug</option>
                <option value="dark" <?php echo $card['type'] == 'dark' ? 'selected' : ''; ?>>Dark</option>
                <option value="dragon" <?php echo $card['type'] == 'dragon' ? 'selected' : ''; ?>>Dragon</option>
                <option value="electric" <?php echo $card['type'] == 'electric' ? 'selected' : ''; ?>>Electric</option>
                <option value="fairy" <?php echo $card['type'] == 'fairy' ? 'selected' : ''; ?>>Fairy</option>
                <option value="fire" <?php echo $card['type'] == 'fire' ? 'selected' : ''; ?>>Fire</option>
                <option value="flying" <?php echo $card['type'] == 'flying' ? 'selected' : ''; ?>>Flying</option>
                <option value="ghost" <?php echo $card['type'] == 'ghost' ? 'selected' : ''; ?>>Ghost</option>
                <option value="grass" <?php echo $card['type'] == 'grass' ? 'selected' : ''; ?>>Grass</option>
                <option value="ground" <?php echo $card['type'] == 'ground' ? 'selected' : ''; ?>>Ground</option>
                <option value="ice" <?php echo $card['type'] == 'ice' ? 'selected' : ''; ?>>Ice</option>
                <option value="normal" <?php echo $card['type'] == 'normal' ? 'selected' : ''; ?>>Normal</option>
                <option value="poison" <?php echo $card['type'] == 'poison' ? 'selected' : ''; ?>>Poison</option>
                <option value="psychic" <?php echo $card['type'] == 'psychic' ? 'selected' : ''; ?>>Psychic</option>
                <option value="rock" <?php echo $card['type'] == 'rock' ? 'selected' : ''; ?>>Rock</option>
                <option value="steel" <?php echo $card['type'] == 'steel' ? 'selected' : ''; ?>>Steel</option>
                <option value="water" <?php echo $card['type'] == 'water' ? 'selected' : ''; ?>>Water</option>
            </select>
        </div>
        <div>
            <label for="rarity">Zeldzaamheid:</label>
            <select name="rarity" id="rarity">
                <option value="common" <?php echo $card['rarity'] == 'common' ? 'selected' : ''; ?>>Common</option>
                <option value="uncommon" <?php echo $card['rarity'] == 'uncommon' ? 'selected' : ''; ?>>Uncommon</option>
                <option value="rare" <?php echo $card['rarity'] == 'rare' ? 'selected' : ''; ?>>Rare</option>
                <option value="epic" <?php echo $card['rarity'] == 'epic' ? 'selected' : ''; ?>>Epic</option>
                <option value="legendary" <?php echo $card['rarity'] == 'legendary' ? 'selected' : ''; ?>>Legendary</option>
            </select>
        </div>
        <div>
            <label for="description">Beschrijving:</label>
            <input type="text" name="description" id="description" value="<?php echo htmlspecialchars($card['description']); ?>" required>
        </div>
        <div>
            <label for="price">Prijs:</label>
            <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($card['price']); ?>" required>
        </div>
        <div>
            <label for="image">Afbeelding:</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit">Bijwerken</button>
    </form>

</body>
</html>