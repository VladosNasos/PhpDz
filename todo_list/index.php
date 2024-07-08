<?php
require 'db.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_task'])) {
        $category_id = $_POST['category_id'];
        $task = $_POST['task'];

        $stmt = $pdo->prepare('INSERT INTO tasks (category_id, task) VALUES (?, ?)');
        $stmt->execute([$category_id, $task]);
    } elseif (isset($_POST['edit_task'])) {
        $id = $_POST['id'];
        $category_id = $_POST['category_id'];
        $task = $_POST['task'];

        $stmt = $pdo->prepare('UPDATE tasks SET category_id = ?, task = ? WHERE id = ?');
        $stmt->execute([$category_id, $task, $id]);
    } elseif (isset($_POST['delete_task'])) {
        $id = $_POST['id'];

        $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ?');
        $stmt->execute([$id]);
    } elseif (isset($_POST['add_category'])) {
        $category = $_POST['category'];

        $stmt = $pdo->prepare('INSERT INTO categories (name) VALUES (?)');
        $stmt->execute([$category]);
    }
}

// Fetch categories and tasks
$categories = $pdo->query('SELECT * FROM categories')->fetchAll();
$tasks = $pdo->query('SELECT tasks.id, tasks.task, categories.name as category, tasks.category_id FROM tasks JOIN categories ON tasks.category_id = categories.id')->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
</head>
<body>
<h1>To-Do List</h1>

<h2>Add Task</h2>
<form method="POST">
    <label for="category_id">Category:</label>
    <select name="category_id" id="category_id" required>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <label for="task">Task:</label>
    <input type="text" name="task" id="task" required>
    <button type="submit" name="add_task">Add Task</button>
</form>

<h2>Tasks</h2>
<ul>
    <?php foreach ($tasks as $task): ?>
        <li>
            <strong><?= $task['category'] ?>:</strong> <?= $task['task'] ?>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                <input type="hidden" name="category_id" value="<?= $task['category_id'] ?>">
                <input type="text" name="task" value="<?= $task['task'] ?>" required>
                <button type="submit" name="edit_task">Edit</button>
            </form>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                <button type="submit" name="delete_task">Delete</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<h2>Add Category</h2>
<form method="POST">
    <label for="category">Category Name:</label>
    <input type="text" name="category" id="category" required>
    <button type="submit" name="add_category">Add Category</button>
</form>

<h2>Categories</h2>
<ul>
    <?php foreach ($categories as $category): ?>
        <li>
            <?= $category['name'] ?>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>
