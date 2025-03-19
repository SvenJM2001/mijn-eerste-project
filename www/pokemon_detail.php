<?php
session_start();

require 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cards WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $card = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$card) {
        echo "Geen gegevens gevonden voor deze kaart.";
        exit();
    }
} else {
    echo "Geen kaart geselecteerd.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Verzameling</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<?php require 'header.php'; ?>
    <main>
        <div class="container">
            <?php if (isset($card)) : ?>
                <div class="card-detail">
                    <div class="row">
                        <div class="col">
                            <img src="<?php echo isset($card['image']) ? 'uploads/' . $card['image'] : 'https://placehold.co/200' ?>" alt="<?php echo $card['name'] ?>">
                        </div>
                        <div class="col">
                            <h3><?php echo $card['name'] ?></h3>
                            <p><?php echo $card['type'] ?></p>
                            <p><?php echo $card['rarity'] ?></p>
                            <p><?php echo $card['description'] ?></p>
                            <p>€ <?php echo number_format($card['price'] / 100, 2, ',', '') ?></p>
                            <p>
                                <a href="add_to_cart.php?id=<?php echo $card['id']; ?>" class="btn">Bestel</a>
                            </p>
                        </div>
                    </div>

                </div>
            <?php else : ?>
                <p>card not found.</p>
            <?php endif; ?>
        </div>
    </main>
</body>