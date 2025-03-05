<?php
include 'database.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $type = htmlspecialchars($_POST['type']);
    $rarity = htmlspecialchars($_POST['rarity']);
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
 
        // Check if file is an actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Check file size (limit to 5MB)
            if ($_FILES["image"]["size"] <= 5000000) {
                // Allow certain file formats
                if (in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
                    // Move the file to the target directory
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                        $image = basename($_FILES["image"]["name"]);
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                }
            } else {
                echo "Sorry, your file is too large.";
            }
        } else {
            echo "File is not an image.";
        }
    } else {
        echo "No file uploaded or there was an error uploading the file.";
    }
 
    // Here you can add code to save the form data to a database or perform other actions
    // For example:
    // $sql = "INSERT INTO pokemon (name, type, rarity, price, image) VALUES ('$name', '$type', '$rarity', '$price', '$target_file')";
    // Execute the SQL query...
    
    $sql = "INSERT INTO cards (name, type, rarity, description, price, image) 
            VALUES (:name, :type, :rarity, :description, :price, :image)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':rarity', $rarity);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image', $image);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: pokemon_index.php");
        exit;
    } else {
        echo "Fout: " . $stmt->errorInfo()[2]; // Show the specific error message
    }
} else {
echo "Invalid request method.";
}
?>