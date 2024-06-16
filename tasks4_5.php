<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tasks 4, 5</title>
</head>
<body>

<h2>Task 4</h2>
<?php
$year = 2024;
if (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) {
    echo "$year is a leap year";
} else {
    echo "$year is not a leap year";
}
?>

<h2>Task 5</h2>
<?php
$a = 9;
$b = 6;
if ($a % 3 == 0 && $b % 3 == 0) {
    echo "The sum of $a and $b is " . ($a + $b);
} elseif ($b != 0) {
    echo "The result of division $a by $b is " . ($a / $b);
} else {
    echo "Invalid input: division by zero";
}
?>

</body>
</html>
