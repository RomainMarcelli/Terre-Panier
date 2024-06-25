<?php

require_once dirname(__DIR__) . '/inc/init.php';

class Product {
    public $id;
    public $created_at;
    public $modified_at;
    public $title;
    public $pictures;
    public $price;
    public $description;
    public $caracteristique;
    public $nutri_score;
    public $category_product_id;
    public $quantity;
    public $producteurs_id;
    public $poids;
    public $poids_kg;
    public $reduction;

    public function __construct($title, $pictures, $price, $description, $caracteristique, $nutri_score, $category_product_id, $quantity, $producteurs_id, $poids, $poids_kg, $reduction) {
        $this->title = $title;
        $this->pictures = $pictures;
        $this->price = $price;
        $this->description = $description;
        $this->caracteristique = $caracteristique;
        $this->nutri_score = $nutri_score;
        $this->category_product_id = $category_product_id;
        $this->quantity = $quantity;
        $this->producteurs_id = $producteurs_id;
        $this->poids = $poids;
        $this->poids_kg = $poids_kg;
        $this->reduction = $reduction;
    }

    public function save() {
        global $pdo;
        try {
            $stmt = $pdo->prepare('INSERT INTO Products (title, pictures, price, description, caracteristique, nutri_score, category_product_id, quantity, producteurs_id, poids, poids_kg, reduction) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            return $stmt->execute([$this->title, $this->pictures, $this->price, $this->description, $this->caracteristique, $this->nutri_score, $this->category_product_id, $this->quantity, $this->producteurs_id, $this->poids, $this->poids_kg, $this->reduction]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public static function findById($id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM Products WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findAll() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM Products');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        global $pdo;
        try {
            $stmt = $pdo->prepare('UPDATE Products SET title = ?, pictures = ?, price = ?, description = ?, caracteristique = ?, nutri_score = ?, category_product_id = ?, quantity = ?, producteurs_id = ?, poids = ?, poids_kg = ?, reduction = ?, modified_at = NOW() WHERE id = ?');
            return $stmt->execute([$this->title, $this->pictures, $this->price, $this->description, $this->caracteristique, $this->nutri_score, $this->category_product_id, $this->quantity, $this->producteurs_id, $this->poids, $this->poids_kg, $this->reduction, $this->id]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public static function deleteById($id) {
        global $pdo;
        try {
            $stmt = $pdo->prepare('DELETE FROM Products WHERE id = ?');
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    
    public static function getAverageRating($id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT AVG(rating) as avg_rating FROM User_Ratings_Products WHERE product_id = ?');
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['avg_rating'] ?? null;
    }
}

?>
