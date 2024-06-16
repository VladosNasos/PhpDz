<?php
session_start();

// Инициализация session_id если он не установлен
if (!isset($_SESSION['session_id'])) {
    $_SESSION['session_id'] = 0;
}

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $_SESSION['session_id'] = 1;
        header("Location: " . $_SERVER['PHP_SELF']); // Перезагрузка страницы для отображения обновленного состояния
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 6</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 50px;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            max-width: 300px;
        }
        .form-container label,
        .form-container input {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    if ($_SESSION['session_id'] == 0) {
        echo '<h1>Please register</h1>';
        echo '<p>Session ID: ' . $_SESSION['session_id'] . '</p>';
        echo '<form class="form-container" method="POST">
                <label for="login">Login</label>
                <input type="text" id="login" name="login" placeholder="Login" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="submit" value="Register">
              </form>';
    } else {
        echo '<h1>You are already registered.</h1>';
        echo '<p>Session ID: ' . $_SESSION['session_id'] . '</p>';
        echo '<a href="#">Login</a>';
    }
    ?>
</div>
</body>
</html>
