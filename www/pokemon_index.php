<?php
session_start();

if (!isset($_SESSION['id'])) {
    echo "You are not logged in, please login. ";
    echo "<a href='login.php'>Login here</a>";
    exit;
}

if ($_SESSION['role'] != 'admin') {
    echo "You are not allowed to view this page, please login as admin";
    exit;
}

require 'database.php';

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

require 'header.php';
?>
<main>
    <div>
    <form method="GET" action="pokemon_index.php">
    <div>
        <label for="search">Zoeken op naam:</label>
        <input type="text" name="search" id="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
    </div>
    <div>
        <label for="type">Filter op type:</label>
        <select name="type" id="type">
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
    </div>
    <button type="submit">Zoeken en Filteren</button>
</form>
    </div>
    <div class="container">


        <table>
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Type</th>
                    <th>Zeldzaamheid</th>
                    <th>Beschrijving</th>
                    <th>Prijs</th>
                    <th>Afbeelding</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cards as $card) : ?>
                    <tr>
                        <td><?php echo $card['name'] ?></td>
                        <td><?php echo $card['type'] ?></td>
                        <td><?php echo $card['rarity'] ?></td>
                        <td><?php echo $card['description']?></td>
                        <td><?php echo $card['price'] ?></td>
                        <td><img src="./uploads/<?php echo $card['image']?>" alt=<?php echo $card['name']?>></td>
                        <td>
                            <a href="pokemon_detail.php?id=<?php echo $card['id'] ?>">Bekijk</a>
                            <?php echo "<a href='pokemon_edit.php?id=" . $card['id'] . "'>Wijzig</a>";?>
                            <?php echo "<a href='pokemon_delete.php?id=" . $card['id'] . "'>Verwijder</a>";?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>