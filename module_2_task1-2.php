<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Functions</title>
</head>
<body>
<?php
// Function to highlight negative numbers in red
function highlightNegatives($arr) {
    if (!is_array($arr)) {
        return false;
    }

    echo "<h1>";
    foreach ($arr as $num) {
        if ($num < 0) {
            echo "<span style='color:red'>$num</span>, ";
        } else {
            echo "$num, ";
        }
    }
    echo "</h1>";
    return true;
}

// Function to convert a number to text
function numberToText($num) {
    $ones = array(
        0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four',
        5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine'
    );
    $teens = array(
        11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen',
        15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen'
    );
    $tens = array(
        10 => 'ten', 20 => 'twenty', 30 => 'thirty', 40 => 'forty',
        50 => 'fifty', 60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
    );
    $thousands = array(
        1000 => 'thousand', 1000000 => 'million', 1000000000 => 'billion'
    );

    if (!is_numeric($num)) {
        return false;
    }

    if ($num == 0) {
        return $ones[0];
    }

    $text = '';

    if ($num >= 1000) {
        foreach ($thousands as $key => $value) {
            if ($num < $key) break;
            $text .= numberToText(floor($num / $key)) . ' ' . $value . ' ';
            $num %= $key;
        }
    }

    if ($num >= 100) {
        $text .= $ones[floor($num / 100)] . ' hundred ';
        $num %= 100;
    }

    if ($num > 10 && $num < 20) {
        $text .= $teens[$num] . ' ';
        $num = 0;
    }

    if ($num >= 10) {
        $text .= $tens[floor($num / 10) * 10] . ' ';
        $num %= 10;
    }

    if ($num > 0) {
        $text .= $ones[$num] . ' ';
    }

    return trim($text);
}

// Example usage
$array = [5, 10, -6, 9, -3, 0, 11, 25];
highlightNegatives($array);

$number = 4520;
echo "<h3>$number - " . ucfirst(numberToText($number)) . "</h3>";
?>
</body>
</html>
