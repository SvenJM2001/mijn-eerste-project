<?php
session_start();

require 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Geen gegevens gevonden voor deze gebruiker.";
        exit();
    }
} else {
    echo "Geen gebruiker geselecteerd.";
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
            <?php if (isset($user)) : ?>
                <div class="user-detail">
                    <div class="row">
                        <div class="col">
                            <h3><?php echo $user['firstname']?> <?php echo $user['lastname']?></h3>
                            <p><?php echo $user['username'] ?></p>
                            <p><?php echo $user['email'] ?></p>
                            <p><?php echo $user['city'] ?> <?php echo $user['address'] ?></p>

                        </div>
                    </div>

                </div>
            <?php else : ?>
                <p>user not found.</p>
            <?php endif; ?>
        </div>
    </main>
</body>