<?php
include "database.php";

// Retrieve POST data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = 'user';
$address = $_POST['adress'];
$city = $_POST['city'];

$sql = "INSERT INTO users (firstname, lastname, email, username, password, role, address, city) 
VALUES (:firstname, :lastname, :email, :username, :password, :role, :address, :city)";

$stmt = $conn->prepare($sql);
    $stmt->execute([
        ':email'=> $email,
        ':username'=> $username,
        ':password'=> $password,
        ':firstname'=> $firstname,
        ':lastname'=> $lastname,
        ':role'=> $role,
        ':address'=> $address,
        ':city'=> $city,
    ]);

// Redirect to the index page
header("Location: login.php");
exit();