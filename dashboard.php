<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Commencez la session avant toute sortie
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/model/Atelier.php';
require_once __DIR__ . '/model/CategoryAteliers.php';
require_once __DIR__ . '/model/Producteur.php';
require_once __DIR__ . '/model/Product.php';
require_once __DIR__ . '/model/CategoryProduct.php';

// Vérification de l'accès
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'producteur') {
    header('Location: view/connexion.php');
    exit;
}

// Récupérer tous les ateliers
$ateliers = Atelier::findAll();

// Récupérer toutes les catégories de produits
$categories = CategoryProduct::findAll();

// Récupérer tous les produits
$products = Product::findAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Hello World</p>
    <p><a href="view/profile.php">Profile</a></p>

    <!-- Lien pour créer un atelier -->
    <p><a href="view/ateliers/create.php">Create Atelier</a></p>
    <form action="view/logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>
    <!-- Liste des ateliers -->
    <h2>Liste des Ateliers</h2>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Type</th>
                <th>Location</th>
                <th>Prix</th>
                <th>Place</th>
                <th>Date</th>
                <th>Time</th>
                <th>Producteur</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ateliers as $atelier): ?>
                <?php 
                    $producteur = Producteur::findById($atelier['producteur_id']);
                    $category = CategoryAteliers::findById($atelier['category_ateliers_id']);
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($atelier['title']); ?></td>
                    <td><?php echo htmlspecialchars($atelier['type']); ?></td>
                    <td><?php echo htmlspecialchars($atelier['location']); ?></td>
                    <td><?php echo htmlspecialchars($atelier['price']); ?></td>
                    <td><?php echo htmlspecialchars($atelier['place']); ?></td>
                    <td><?php echo htmlspecialchars($atelier['date']); ?></td>
                    <td><?php echo htmlspecialchars($atelier['time']); ?></td>
                    <td><?php echo htmlspecialchars($producteur['name']); ?></td>
                    <td><?php echo htmlspecialchars($category['title']); ?></td>
                    <td>
                        <a href="controller/AtelierController.php?action=read&id=<?php echo $atelier['id']; ?>">View</a>
                        <a href="controller/AtelierController.php?action=update&id=<?php echo $atelier['id']; ?>">Edit</a>
                        <a href="controller/AtelierController.php?action=delete&id=<?php echo $atelier['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Lien pour créer un produit -->
    <p><a href="view/products/create.php">Create a Product</a></p>

    <!-- Liste des produits -->
    <h2>List of Products</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Pictures</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Caracteristique</th>
                <th>Nutri Score</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Producteur</th>
                <th>Poids</th>
                <th>Poids KG</th>
                <th>Reduction</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <?php 
                    $producteur = Producteur::findById($product['producteurs_id']);
                    $category = CategoryProduct::findById($product['category_product_id']);
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['title']); ?></td>
                    <td><?php echo htmlspecialchars($product['pictures']); ?></td>
                    <td><?php echo htmlspecialchars($product['price']); ?></td>
                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                    <td><?php echo htmlspecialchars($product['caracteristique']); ?></td>
                    <td><?php echo htmlspecialchars($product['nutri_score']); ?></td>
                    <td><?php echo htmlspecialchars($category['title']); ?></td>
                    <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($producteur['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['poids']); ?></td>
                    <td><?php echo htmlspecialchars($product['poids_kg']); ?></td>
                    <td><?php echo htmlspecialchars($product['reduction']); ?></td>
                    <td>
                        <a href="controller/ProductController.php?action=read&id=<?php echo $product['id']; ?>">View</a>
                        <a href="controller/ProductController.php?action=update&id=<?php echo $product['id']; ?>">Edit</a>
                        <a href="controller/ProductController.php?action=delete&id=<?php echo $product['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
