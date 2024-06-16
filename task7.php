<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 7</title>
    <style>
        .square {
            position: absolute;
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
<?php
$x = 50;
$y = 50;
$color = 'green';
$screen_width = 1920;
$screen_height = 1080;

if ($x >= 0 && $x + 50 <= $screen_width && $y >= 0 && $y + 50 <= $screen_height) {
    echo "<p>X = $x, Y = $y, Color = $color</p>";
    echo "<div class='square' style='left:{$x}px; top:{$y}px; background-color:{$color};'></div>";
} else {
    echo "<p>Coordinates are out of screen bounds.</p>";
}
?>
</body>
</html>
