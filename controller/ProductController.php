<?php
require_once dirname(__DIR__) . '/model/Product.php';
require_once dirname(__DIR__) . '/model/CategoryProduct.php';
require_once dirname(__DIR__) . '/model/Producteur.php';
class ProductController {
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $pictures = $_POST['pictures'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $caracteristique = $_POST['caracteristique'];
            $nutri_score = $_POST['nutri_score'];
            $category_product_id = $_POST['category_product_id'];
            $quantity = $_POST['quantity'];
            $producteurs_id = $_POST['producteurs_id'];
            $poids = $_POST['poids'];
            $poids_kg = $_POST['poids_kg'];
            $reduction = $_POST['reduction'];
            $product = new Product($title, $pictures, $price, $description, $caracteristique, $nutri_score, $category_product_id, $quantity, $producteurs_id, $poids, $poids_kg, $reduction);
            if ($product->save()) {
                header('Location: /cours-mds/DigitalProject/view/products/list.php');
                exit;
            } else {
                $msg = 'Error creating product';
                require dirname(__DIR__) . '/view/products/create.php';
            }
        } else {
            require dirname(__DIR__) . '/view/products/create.php';
        }
    }
    public function read($id) {
        $product = Product::findById($id);
        require dirname(__DIR__) . '/view/products/read.php';
    }
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $pictures = $_POST['pictures'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $caracteristique = $_POST['caracteristique'];
            $nutri_score = $_POST['nutri_score'];
            $category_product_id = $_POST['category_product_id'];
            $quantity = $_POST['quantity'];
            $producteurs_id = $_POST['producteurs_id'];
            $poids = $_POST['poids'];
            $poids_kg = $_POST['poids_kg'];
            $reduction = $_POST['reduction'];

            $product = new Product($title, $pictures, $price, $description, $caracteristique, $nutri_score, $category_product_id, $quantity, $producteurs_id, $poids, $poids_kg, $reduction);
            $product->id = $id;
            if ($product->update()) {
                // header('Location: /cours-mds/DigitalProject/view/products/list.php');
                header('Location: /cours-mds/DigitalProject/view/products/list.php');
                exit;
            } else {
                $msg = 'Error updating product';
                $product = Product::findById($id); // Recharger le produit pour avoir les données actuelles
                require dirname(__DIR__) . '/view/products/update.php';
            }$title = $_POST['title'];
            $pictures = $_POST['pictures'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $caracteristique = $_POST['caracteristique'];
            $nutri_score = $_POST['nutri_score'];
            $category_product_id = $_POST['category_product_id'];
            $quantity = $_POST['quantity'];
            $producteurs_id = $_POST['producteurs_id'];
            $poids = $_POST['poids'];
            $poids_kg = $_POST['poids_kg'];
            $reduction = $_POST['reduction'];

            $product = new Product($title, $pictures, $price, $description, $caracteristique, $nutri_score, $category_product_id, $quantity, $producteurs_id, $poids, $poids_kg, $reduction);
            $product->id = $id;
            if ($product->update()) {
                header('Location: /cours-mds/DigitalProject/view/products/list.php');
                exit;
            } else {
                $msg = 'Error updating product';
                $product = Product::findById($id); // Recharger le produit pour avoir les données actuelles
                require dirname(__DIR__) . '/view/products/update.php';
            }
        } else {
            $product = Product::findById($id);
            require dirname(__DIR__) . '/view/products/update.php';
        }
    }
    public function delete($id) {
        if (Product::deleteById($id)) {
            header('Location: /cours-mds/DigitalProject/view/products/list.php');
            exit;
        } else {
            $msg = 'Error deleting product';
            require dirname(__DIR__) . '/view/products/delete.php';
        }
    }
    public function list() {
        $products = Product::findAll();
        require dirname(__DIR__) . '/view/products/list.php';
    }
}
// session_start();
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
$controller = new ProductController();
switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'read':
        $controller->read($id);
        break;
    case 'update':
        $controller->update($id);
        break;
    case 'delete':
        $controller->delete($id);
        break;
    default:
        $controller->list();
        break;
}

?>