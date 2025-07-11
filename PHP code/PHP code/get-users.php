<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost", "root", "", "www-structure-books");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Connection failed"]);
    exit;
}

$result = $conn->query("SELECT id, username FROM users");
$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
$conn->close();
?>