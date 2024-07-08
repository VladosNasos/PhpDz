<?php
require 'config.php';

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$category_id = $_POST['category_id'];

$sql = 'UPDATE tasks SET title = ?, description = ?, category_id = ? WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$title, $description, $category_id, $id]);

header('Location: index.php');
?>
