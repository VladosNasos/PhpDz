<?php
session_start();

function displayCartProduct($name, $image, $count, $total_price) {
    echo "<div class='product'>";
    echo "<img src='$image' alt='$name'>";
    echo "<h3>$name</h3>";
    echo "<p>Count: $count Total price: \$$total_price</p>";
    echo "</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <style>
        .product {
            float: left;
            border: 1px solid green;
            margin: 10px;
            padding: 10px;
        }
        .product img {
            height: 250px;
        }
    </style>
</head>
<body>
<?php
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product) {
        displayCartProduct($product['name'], $product['image'], $product['count'], $product['total_price']);
    }
} else {
    echo "<p>Your cart is empty.</p>";
}
?>
</body>
</html>
