<?php

$localhost = "localhost";
$root = "root";
$password = ""; 
$db = "LuluDB";  

$conn = mysqli_connect($localhost, $root, $password, $db);

if ($conn->error) {
    die("Connection failed: " . $conn->error);
}

?>
