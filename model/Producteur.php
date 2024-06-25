<?php

require_once dirname(__DIR__) . '/inc/init.php';

class Producteur {
    public $id;
    public $created_at;
    public $modified_at;
    public $name;
    public $email;
    public $tel;
    public $password;
    public $location;
    public $profil_picture;
    public $description;
    public $cover_picture;
    public $raison_sociale;
    public $siret;
    public $adresse;

    public function __construct($name, $email, $tel, $password, $location, $profil_picture, $description, $cover_picture, $raison_sociale, $siret, $adresse) {
        $this->name = $name;
        $this->email = $email;
        $this->tel = $tel;
        $this->password = $password;
        $this->location = $location;
        $this->profil_picture = $profil_picture;
        $this->description = $description;
        $this->cover_picture = $cover_picture;
        $this->raison_sociale = $raison_sociale;
        $this->siret = $siret;
        $this->adresse = $adresse;
    }

    public function save() {
        global $pdo;
        try {
            $stmt = $pdo->prepare('INSERT INTO Producteurs (name, email, tel, password, location, profil_picture, description, cover_picture, raison_sociale, siret, adresse) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            return $stmt->execute([$this->name, $this->email, $this->tel, $this->password, $this->location, $this->profil_picture, $this->description, $this->cover_picture, $this->raison_sociale, $this->siret, $this->adresse]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public static function findById($id) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM Producteurs WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findAll() {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM Producteurs');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update() {
        global $pdo;
        try {
            $stmt = $pdo->prepare('UPDATE Producteurs SET name = ?, email = ?, tel = ?, password = ?, location = ?, profil_picture = ?, description = ?, cover_picture = ?, raison_sociale = ?, siret = ?, adresse = ?, modified_at = NOW() WHERE id = ?');
            return $stmt->execute([$this->name, $this->email, $this->tel, $this->password, $this->location, $this->profil_picture, $this->description, $this->cover_picture, $this->raison_sociale, $this->siret, $this->adresse, $this->id]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public static function deleteById($id) {
        global $pdo;
        try {
            $stmt = $pdo->prepare('DELETE FROM Producteurs WHERE id = ?');
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}

?>
