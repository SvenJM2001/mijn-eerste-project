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

// Basis SQL-query
$sql = "SELECT * FROM type WHERE 1";

// Voeg zoekfilter toe
if (!empty($search)) {
    $sql .= " AND name LIKE :search";
}

$stmt = $conn->prepare($sql);

// Bind de zoekparameter
if (!empty($search)) {
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
}

$stmt->execute();
$types = $stmt->fetchAll(PDO::FETCH_ASSOC);

require 'header.php';
?>
<main>
    <div>
    <form method="GET" action="pokemon_index.php">
    <div>
        <label for="search">Zoeken op naam:</label>
        <input type="text" name="search" id="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
    </div>
    <button type="submit">Zoeken</button>
</form>
    </div>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Afbeelding</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($types as $type) : ?>
                    <tr>
                        <td><?php echo $type['name'] ?></td>
                        <td><img src="./uploads/<?php echo $type['image']?>" alt=<?php echo $type['name']?>></td>
                        <td>
                            <?php echo "<a href='types_edit.php?id=" . $type['id'] . "'>Wijzig</a>";?>
                            <?php echo "<a href='types_delete.php?id=" . $type['id'] . "'>Verwijder</a>";?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>