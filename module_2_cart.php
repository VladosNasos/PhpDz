<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Cart</title>
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
        .product button {
            background-color: green;
            color: white;
            width: 160px;
            height: 30px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
<?php
function displayProduct($name, $image, $count, $total_price) {
    echo "<div class='product'>";
    echo "<img src='$image' alt='$name'>";
    echo "<h3>$name</h3>";
    echo "<p>Count: $count Total price: \$$total_price</p>";
    echo "</div>";
}

function cart($products) {
    $cart = [];

    foreach ($products as $product) {
        $key = $product['name'];
        if (!isset($cart[$key])) {
            $cart[$key] = [
                'name' => $product['name'],
                'image' => $product['image'],
                'count' => 0,
                'total_price' => 0
            ];
        }
        $cart[$key]['count']++;
        $cart[$key]['total_price'] += $product['price'];
    }

    return $cart;
}

// Example products added to cart
$products = [
    ['name' => 'iPhone 7 64GB Rose Gold', 'image' => 'img/iphone.jpg', 'price' => 600],
    ['name' => 'Samsung Galaxy A8 64GB', 'image' => 'img/samsung.jpg', 'price' => 450],
    ['name' => 'iPhone 7 64GB Rose Gold', 'image' => 'img/iphone.jpg', 'price' => 600],
    ['name' => 'iPhone 7 64GB Rose Gold', 'image' => 'img/iphone.jpg', 'price' => 600],
    ['name' => 'Samsung Galaxy A8 64GB', 'image' => 'img/samsung.jpg', 'price' => 450],
    ['name' => 'iPhone 7 64GB Rose Gold', 'image' => 'img/iphone.jpg', 'price' => 600],
    ['name' => 'iPhone 7 64GB Rose Gold', 'image' => 'img/iphone.jpg', 'price' => 600],
    ['name' => 'Xiaomi Redmi 6A 64GB', 'image' => 'img/redmi.jpg', 'price' => 200]
];

// Get the cart summary
$cart_summary = cart($products);

// Display the cart summary
foreach ($cart_summary as $product) {
    displayProduct($product['name'], $product['image'], $product['count'], $product['total_price']);
}
?>
</body>
</html>
