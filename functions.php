<?php
// Function to generate an array with random values
function generateRandomArray($count_elem, $min_val, $max_val) {
    // Swap values if min_val is greater than max_val
    if ($min_val > $max_val) {
        list($min_val, $max_val) = array($max_val, $min_val);
    }

    $array = [];
    for ($i = 0; $i < $count_elem; $i++) {
        $array[] = rand($min_val, $max_val);
    }
    return $array;
}

// Function to raise a number to a given power
function power($base, $exponent) {
    return pow($base, $exponent);
}

// Function to swap the values of two variables by reference
function swap(&$a, &$b) {
    $temp = $a;
    $a = $b;
    $b = $temp;
}
// 1. Generate random array
$count_elem = 10;
$min_val = 1;
$max_val = 100;
$randomArray = generateRandomArray($count_elem, $min_val, $max_val);
echo "Random Array: ";
print_r($randomArray);
echo "<br><br>";

// 2. Raise number to a power
$base = 2;
$exponent = 8;
$result = power($base, $exponent);
echo "$base raised to the power of $exponent is: $result<br><br>";

// 3. Swap values
$x = 5;
$y = 10;
echo "Before swap: x = $x, y = $y<br>";
swap($x, $y);
echo "After swap: x = $x, y = $y<br>";
?>
