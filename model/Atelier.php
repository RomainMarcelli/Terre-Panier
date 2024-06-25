<?php

require_once dirname(__DIR__) . '/inc/init.php';

class Atelier {
    public $id;
    public $created_at;
    public $modified_at;
    public $title;
    public $type;
    public $location;
    public $price;
    public $place;
    public $pictures;
    public $description;
    public $time;
    public $date;
    public $producteur_id;
    public $category_ateliers_id;

    public function __construct($title, $type, $location, $price, $place, $pictures, $description, $time, $date, $producteur_id, $category_ateliers_id) {
        $this->title = $title;
        $this->type = $type;
        $this->location = $location;
        $this->price = $price;
        $this->place = $place;
        $this->pictures = $pictures;
        $this->description = $description;
        $this->time = $time;
        $this->date = $date;
        $this->producteur_id = $producteur_id;
        $this->category_ateliers_id = $category_ateliers_id;
    }

    public function save() {
        global $pdo;
        try {
            $stmt = $pdo->prepare('INSERT INTO Ateliers (title, type, location, price, place, pictures, description, time, date, producteur_id, category_ateliers_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            return $stmt->execute([$this->title, $this->type, $this->location, $this->price, $this->place, $this->pictures, $this->description, $this->time, $this->date, $this->producteur_id, $this->category_ateliers_id]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public static function findById($id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM Ateliers WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findAll() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM Ateliers');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        global $pdo;
        try {
            $stmt = $pdo->prepare('UPDATE Ateliers SET title = ?, type = ?, location = ?, price = ?, place = ?, pictures = ?, description = ?, time = ?, date = ?, producteur_id = ?, category_ateliers_id = ?, modified_at = NOW() WHERE id = ?');
            return $stmt->execute([$this->title, $this->type, $this->location, $this->price, $this->place, $this->pictures, $this->description, $this->time, $this->date, $this->producteur_id, $this->category_ateliers_id, $this->id]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public static function deleteById($id) {
        global $pdo;
        try {
            $stmt = $pdo->prepare('DELETE FROM Ateliers WHERE id = ?');
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}

?>
