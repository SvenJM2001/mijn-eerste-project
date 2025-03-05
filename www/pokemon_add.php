<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Create</title>
</head>
<body>
    <?php include 'header.php';?>

    <form action="pokemon_add_process.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="name">Naam:</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="type">Type:</label>
            <select name="type" id="type">
                <option value="bug">Bug</option>
                <option value="dark">Dark</option>
                <option value="dragon">Dragon</option>
                <option value="electric">Electric</option>
                <option value="fairy">Fairy</option>
                <option value="fire">Fire</option>
                <option value="flying">Flying</option>
                <option value="ghost">Ghost</option>
                <option value="grass">Grass</option>
                <option value="ground">Ground</option>
                <option value="ice">Ice</option>
                <option value="normal">Normal</option>
                <option value="poison">Poison</option>
                <option value="psychic">Psychic</option>
                <option value="rock">Rock</option>
                <option value="steel">Steel</option>
                <option value="water">Water</option>
            </select>
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