<!DOCTYPE html>
<html>
<head>
    <title>Product Management</title>
</head>
<body>
<?php
// Define the Product class
class Product {
    public $name;
    public $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function getProduct() {
        return "Name: {$this->name}; Price: {$this->price}";
    }

    public static function searchByName($products, $name) {
        foreach ($products as $product) {
            if (strcasecmp($product->name, $name) == 0) {
                return $product;
            }
        }
        return null;
    }
}

// Start the session
session_start();

// Initialize products array in session if not already set
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = array();
}

// Handle form submission for adding a new product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    if (!empty($name) && !empty($price)) {
        $newProduct = new Product($name, $price);
        $_SESSION['products'][] = $newProduct;
    }
}

// Handle form submission for searching a product
$searchResult = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_product'])) {
    $searchName = $_POST['search_name'];
    if (!empty($searchName)) {
        $searchResult = Product::searchByName($_SESSION['products'], $searchName);
    }
}
?>

<h1>Product Management</h1>

<h2>Add a new product</h2>
<form method="post">
    Name: <input type="text" name="name" required>
    Price: <input type="text" name="price" required>
    <button type="submit" name="add_product">Add</button>
</form>

<h2>Current Products</h2>
<ul>
    <?php
    foreach ($_SESSION['products'] as $product) {
        echo "<li>" . $product->getProduct() . "</li>";
    }
    ?>
</ul>

<h2>Search for a product</h2>
<form method="post">
    Name: <input type="text" name="search_name" required>
    <button type="submit" name="search_product">Search</button>
</form>

<?php
if ($searchResult) {
    echo "<h2>Search Result</h2>";
    echo "<p>" . $searchResult->getProduct() . "</p>";
} elseif (isset($searchName)) {
    echo "<h2>Search Result</h2>";
    echo "<p>No product found with the name '$searchName'.</p>";
}
?>
</body>
</html>
