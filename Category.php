<?php
class Category {
    private $name;
    private $list_products;

    public function __construct($name, $list_products = []) {
        $this->name = $name;
        $this->list_products = $list_products;
    }

    public function getCategoryName() {
        return $this->name;
    }

    public function getCategoryProducts() {
        return $this->list_products;
    }

    public function addProduct($product) {
        $this->list_products[] = $product;
    }

    public static function searchCategory($categories, $name) {
        foreach ($categories as $category) {
            if ($category->getCategoryName() == $name) {
                return $category;
            }
        }
        return null;
    }
}
?>
