<?php

require_once dirname(__DIR__) . '/inc/init.php';

class CategoryAteliers {
    public $id;
    public $created_at;
    public $modified_at;
    public $title;

    public function __construct($title) {
        $this->title = $title;
    }

    public function save() {
        global $pdo;
        try {
            $stmt = $pdo->prepare('INSERT INTO Category_Ateliers (title) VALUES (?)');
            return $stmt->execute([$this->title]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public static function findById($id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM Category_Ateliers WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findAll() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM Category_Ateliers');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        global $pdo;
        try {
            $stmt = $pdo->prepare('UPDATE Category_Ateliers SET title = ?, modified_at = NOW() WHERE id = ?');
            return $stmt->execute([$this->title, $this->id]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public static function deleteById($id) {
        global $pdo;
        try {
            $stmt = $pdo->prepare('DELETE FROM Category_Ateliers WHERE id = ?');
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}
?>
