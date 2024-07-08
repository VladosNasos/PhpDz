<?php
require 'config.php';

$title = $_POST['title'];
$description = $_POST['description'];
$category_id = $_POST['category_id'];

$sql = 'INSERT INTO tasks (title, description, category_id) VALUES (?, ?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->execute([$title, $description, $category_id]);

header('Location: index.php');
?>
