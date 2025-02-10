<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$specific_id = 100; // Example product ID

// SQL to get the image path
$sql = "SELECT image FROM products WHERE id = $specific_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imagePath = $row['image'];
    // Display the image
    echo '<img src="'.$imagePath.'" alt="Product Image">';
} else {
    echo "No image found.";
}

$conn->close();
?>
