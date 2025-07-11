<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost", "root", "", "www-structure-books");

$query = isset($_GET['query']) ? $_GET['query'] : '';
$genre = isset($_GET['genre']) ? $_GET['genre'] : 'all';
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 'all';

$sql = "SELECT b.id, b.title, b.author, b.genre, b.year, u.username
        FROM books b
        JOIN users u ON b.user_id = u.id
        WHERE (LOWER(b.title) LIKE LOWER(?) OR LOWER(b.author) LIKE LOWER(?))";

$params = ["%$query%", "%$query%"];
$types = "ss";

if ($genre !== "all") {
    $sql .= " AND b.genre = ?";
    $params[] = $genre;
    $types .= "s";
}

if ($user_id !== "all") {
    $sql .= " AND b.user_id = ?";
    $params[] = $user_id;
    $types .= "i";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

echo json_encode($books);
$conn->close();
?>
