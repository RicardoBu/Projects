<?php
include_once('../config.php');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the noticia ID from the request
$id = $_GET['id'];

// Query to retrieve the noticia
$query = "SELECT * FROM noticias WHERE id = '$id'";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch the noticia data
$noticia = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($conn);

// Output the noticia content
echo $noticia['content'];



?>

