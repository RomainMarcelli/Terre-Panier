<?php
require_once '../inc/init.php';

class User {
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $location;

    public function __construct($firstname, $lastname, $email, $password, $location) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->location = $location;
    }

    public static function findByEmail($email) {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM Users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save() {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO Users (firstname, lastname, email, password, location) VALUES (?, ?, ?, ?, ?)');
        return $stmt->execute([$this->firstname, $this->lastname, $this->email, $this->password, $this->location]);
    }
}
?>
