<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost", "root", "", "www-structure-books");

$title = $_POST['title'];
$author = $_POST['author'];
$genre = $_POST['genre'];
$year = intval($_POST['year']);
$user_id = intval($_POST['user_id']);

$stmt = $conn->prepare("INSERT INTO books (title, author, genre, year, user_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssii", $title, $author, $genre, $year, $user_id);
$stmt->execute();

echo json_encode(["success" => true]);
$conn->close();
?>
