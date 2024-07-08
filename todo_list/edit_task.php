<?php
require 'config.php';

$id = $_GET['id'];
$task = $pdo->prepare('SELECT * FROM tasks WHERE id = ?');
$task->execute([$id]);
$task = $task->fetch();

$categories = $pdo->query('SELECT * FROM categories')->fetchAll();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Task</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Edit Task</h1>

    <form method="post" action="update_task.php">
        <input type="hidden" name="id" value="<?= $task['id'] ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($task['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-control" id="category" name="category_id">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= $category['id'] == $task['category_id'] ? 'selected' : '' ?>><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
