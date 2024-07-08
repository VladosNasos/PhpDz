<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_category'])) {
        $category = $_POST['category'];

        $stmt = $pdo->prepare('INSERT INTO categories (name) VALUES (?)');
        $stmt->execute([$category]);

        header('Location: index.php');
        exit;
    }
}
?>
