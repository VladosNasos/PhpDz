<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Homework</title>
    <style>
        nav {
            margin-bottom: 20px;
        }
        nav a {
            margin-right: 10px;
        }
        section {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>

<nav>
    <a href="#task1">Task 1</a>
    <a href="#task2">Task 2</a>
    <a href="#task3">Task 3</a>
    <a href="#task4">Task 4</a>
    <a href="#task5">Task 5</a>
    <a href="#task6">Task 6</a>
</nav>

<section id="task1">
    <h2>Task 1</h2>
    <?php
    $name = 'Vlados';
    echo "Hello! My name is '$name'";
    ?>
</section>

<section id="task2">
    <h2>Task 2</h2>
    <?php
    $name = 'Vlados';
    $age = 18;
    echo "Hello! My name is '$name'<br>";
    echo "I'm $age";
    ?>
</section>

<section id="task3">
    <h2>Task 3</h2>
    <?php
    $a = 5;
    $b = 10;
    $rez = $a + $b;
    echo "'$a' + '$b' = '$rez'";
    ?>
</section>

<section id="task4">
    <h2>Task 4</h2>
    <?php
    $a = 5;
    $b = 10;
    $a = $a + $b;
    $b = $a - $b;
    $a = $a - $b;
    echo "a = $a, b = $b";
    ?>
</section>

<section id="task5">
    <h2>Task 5</h2>
    <?php
    $answers = [
        'q1' => 'b',
        'q2' => ['a', 'd'],
        'q3' => 'Polymorphism allows objects to be treated as instances of their parent class rather than their actual class.'
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $score = 0;

        if (isset($_POST['q1']) && $_POST['q1'] == $answers['q1']) {
            $score++;
        }

        if (isset($_POST['q2']) && array_diff($answers['q2'], $_POST['q2']) === array_diff($_POST['q2'], $answers['q2'])) {
            $score++;
        }

        if (isset($_POST['q3']) && !empty($_POST['q3'])) {
            $score++;
        }

        echo "<p>Your score: $score/3</p>";
    }
    ?>
    <form method="POST">
        <!-- Вопрос 1 -->
        <p>1. What is the capital of France?</p>
        <input type="radio" name="q1" value="a"> London<br>
        <input type="radio" name="q1" value="b"> Paris<br>
        <input type="radio" name="q1" value="c"> Berlin<br>
        <input type="radio" name="q1" value="d"> Madrid<br>

        <!-- Вопрос 2 -->
        <p>2. Which of the following are programming languages?</p>
        <input type="checkbox" name="q2[]" value="a"> Python<br>
        <input type="checkbox" name="q2[]" value="b"> HTML<br>
        <input type="checkbox" name="q2[]" value="c"> CSS<br>
        <input type="checkbox" name="q2[]" value="d"> Java<br>

        <!-- Вопрос 3 -->
        <p>3. Explain the concept of polymorphism in OOP.</p>
        <textarea name="q3"></textarea><br>

        <input type="submit" value="Submit">
    </form>
</section>

<section id="task6">
    <h2>Task 6</h2>
    <?php
    $tag = 'div';
    $background_color = 'blue';
    $color = 'white';
    $width = '200px';
    $height = '100px';

    echo "<$tag style='background-color: $background_color; color: $color; width: $width; height: $height;'>Hello World</$tag>";
    ?>
</section>

</body>
</html>
