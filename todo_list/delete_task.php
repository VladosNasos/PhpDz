<?php
require 'config.php';

$id = $_GET['id'];

$sql = 'DELETE FROM tasks WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header('Location: index.php');
?>
