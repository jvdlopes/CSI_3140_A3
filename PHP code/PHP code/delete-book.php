<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost", "root", "", "www-structure-books");

$id = intval($_POST['id']);
$stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(["success" => true]);
$conn->close();
?>