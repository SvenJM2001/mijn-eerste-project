<?php

//database connection   
$dbhost = "mariadb";
$dbuser = "root";
$dbpass = "password";
$dbname = "pokemon_db";

$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);