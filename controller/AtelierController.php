<?php
require_once dirname(__DIR__) . '/model/Atelier.php';
require_once dirname(__DIR__) . '/model/CategoryAteliers.php';
require_once dirname(__DIR__) . '/model/Producteur.php';

// session_start();

// Vérification de l'accès
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'producteur') {
    header('Location: view/connexion.php');
    exit;
}

class AtelierController {
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $type = $_POST['type'];
            $location = $_POST['location'];
            $price = $_POST['price'];
            $place = $_POST['place'];
            $pictures = $_POST['pictures'];
            $description = $_POST['description'];
            $time = $_POST['time'];
            $date = $_POST['date'];
            $producteur_id = $_POST['producteur_id'];
            $category_ateliers_id = $_POST['category_ateliers_id'];

            $atelier = new Atelier($title, $type, $location, $price, $place, $pictures, $description, $time, $date, $producteur_id, $category_ateliers_id);
            if ($atelier->save()) {
                header('Location: /mds-back/TerreOPanier/view/ateliers/list.php');
                // header('Location: /cours-mds/DigitalProject/view/ateliers/list.php');
                exit;
            } else {
                $msg = 'Error creating atelier';
                require dirname(__DIR__) . '/view/ateliers/create.php';
            }        } else {
            require dirname(__DIR__) . '/view/ateliers/create.php';
        }
    }

    public function read($id) {
        $atelier = Atelier::findById($id);
        require dirname(__DIR__) . '/view/ateliers/read.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $type = $_POST['type'];
            $location = $_POST['location'];
            $price = $_POST['price'];
            $place = $_POST['place'];
            $pictures = $_POST['pictures'];
            $description = $_POST['description'];
            $time = $_POST['time'];
            $date = $_POST['date'];
            $producteur_id = $_POST['producteur_id'];
            $category_ateliers_id = $_POST['category_ateliers_id'];

            $atelier = new Atelier($title, $type, $location, $price, $place, $pictures, $description, $time, $date, $producteur_id, $category_ateliers_id);
            $atelier->id = $id;
            if ($atelier->update()) {
                header('Location: /cours-mds/DigitalProject/view/ateliers/list.php');
                exit;
            } else {
                $msg = 'Error updating atelier';
                $atelier = Atelier::findById($id); // Recharger l'atelier pour avoir les données actuelles
                require dirname(__DIR__) . '/view/ateliers/update.php';
            }        } else {
            $atelier = Atelier::findById($id);
            require dirname(__DIR__) . '/view/ateliers/update.php';
        }
    }

    public function delete($id) {
        if (Atelier::deleteById($id)) {
            // header('Location: /cours-mds/DigitalProject/view/ateliers/list.php');
            header('Location: /mds_project/TerreOPanier/view/ateliers/list.php');
            exit;
        } else {
            $msg = 'Error deleting atelier';
            require dirname(__DIR__) . '/view/ateliers/delete.php';
        }
    }

    public function list() {
        $ateliers = Atelier::findAll();
        require dirname(__DIR__) . '/view/ateliers/list.php';
    }
}

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;
$controller = new AtelierController();

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