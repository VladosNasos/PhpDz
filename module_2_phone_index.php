<?php
session_start();

// Function to add product to cart
function addToCart($name, $image, $price) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $productKey = md5($name . $image); // Unique key for each product

    if (isset($_SESSION['cart'][$productKey])) {
        $_SESSION['cart'][$productKey]['count']++;
        $_SESSION['cart'][$productKey]['total_price'] += $price;
    } else {
        $_SESSION['cart'][$productKey] = [
            'name' => $name,
            'image' => $image,
            'count' => 1,
            'total_price' => $price
        ];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['AddCart'])) {
    $name = $_POST['name'];
    $image = $_POST['image'];
    $price = $_POST['price'];

    addToCart($name, $image, $price);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Display</title>
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
        .cart-button {
            clear: both;
            margin: 20px 0;
        }
    </style>
</head>
<body>
<?php
function displayProduct($name, $image, $price) {
    echo "<form method='post' style='display:inline-block;'>";
    echo "<div class='product'>";
    echo "<img src='$image' alt='$name'>";
    echo "<h3>$name</h3>";
    echo "<p>\$$price</p>";
    echo "<input type='hidden' name='name' value='$name'>";
    echo "<input type='hidden' name='image' value='$image'>";
    echo "<input type='hidden' name='price' value='$price'>";
    echo "<button type='submit' name='AddCart' value='AddCart'>Add to Cart</button>";
    echo "</div>";
    echo "</form>";
}

// Example usage
displayProduct("iPhone 7 64GB Rose Gold", "img/iphone.jpg", 600);
displayProduct("Samsung Galaxy A8 64GB", "img/samsung.jpg", 450);
displayProduct("Xiaomi Redmi 6A 64GB", "img/redmi.jpg", 200);
?>
<div class="cart-button">
    <a href="module_2_phonestuff.php"><button>Go to Cart</button></a>
</div>
</body>
</html>
