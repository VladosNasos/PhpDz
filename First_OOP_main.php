<?php
require_once 'First_OOP_Category.php';

session_start();

// Retrieve categories from session or initialize an empty array
$categories = isset($_SESSION['categories']) ? $_SESSION['categories'] : [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
        $category_name = $_POST['category_name'];
        $new_category = new Category($category_name);
        $categories[] = $new_category;
        $_SESSION['categories'] = $categories; // Save categories to session
    } elseif (isset($_POST['product_name']) && isset($_POST['selected_category'])) {
        $product_name = $_POST['product_name'];
        $selected_category_name = $_POST['selected_category'];
        $selected_category = Category::searchCategory($categories, $selected_category_name);
        if ($selected_category) {
            $selected_category->addProduct($product_name);
            $_SESSION['categories'] = $categories; // Update categories in session
        }
    }
}

if (isset($_GET['category'])) {
    $selected_category_name = $_GET['category'];
    $selected_category = Category::searchCategory($categories, $selected_category_name);
    $display_products = $selected_category ? $selected_category->getCategoryProducts() : [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Category Management</title>
</head>
<body>
<form method="post">
    <input type="text" name="category_name" placeholder="Enter category name">
    <button type="submit">Add Category</button>
</form>

<h2>Categories</h2>
<ul>
    <?php foreach ($categories as $category): ?>
        <li><a href="?category=<?= $category->getCategoryName() ?>"><?= $category->getCategoryName() ?></a></li>
    <?php endforeach; ?>
</ul>

<?php if (isset($selected_category)): ?>
    <h2>Products in <?= htmlspecialchars($selected_category_name) ?></h2>
    <ul>
        <?php foreach ($display_products as $product): ?>
            <li><?= htmlspecialchars($product) ?></li>
        <?php endforeach; ?>
    </ul>

    <form method="post">
        <input type="hidden" name="selected_category" value="<?= htmlspecialchars($selected_category_name) ?>">
        <input type="text" name="product_name" placeholder="Enter product name">
        <button type="submit">Add Product</button>
    </form>
<?php endif; ?>
</body>
</html>
