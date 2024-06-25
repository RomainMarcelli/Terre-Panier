<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__DIR__, 2) . '/model/Product.php';
require_once dirname(__DIR__, 2) . '/model/CategoryProduct.php';
require_once dirname(__DIR__, 2) . '/model/Producteur.php';

if (!isset($_GET['id'])) {
    die('Produit requis');
}

$id = $_GET['id'];
$product = Product::findById($id);

if (!$product) {
    die('Produit inexistant');
}
$averageRating = Product::getAverageRating($product['id']);
$category = CategoryProduct::findById($product['category_product_id']);
$producteur = Producteur::findById($product['producteurs_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
</head>
<body>
    <h1>View Product</h1>
    <p><strong>Pictures:</strong> <?php echo htmlspecialchars($product['pictures']); ?></p>
    <p><strong>Caracteristique:</strong> <?php echo htmlspecialchars($product['caracteristique']); ?></p>
    <p><strong>Nutri Score:</strong> <?php echo htmlspecialchars($product['nutri_score']); ?></p>
    <p><strong>Category:</strong> <?php echo htmlspecialchars($category['title']); ?></p>
    <p><strong>Quantity:</strong> <?php echo htmlspecialchars($product['quantity']); ?></p>
    <p><strong>Producteur:</strong> <?php echo htmlspecialchars($producteur['name']); ?></p>
    <p><strong>Poids:</strong> <?php echo htmlspecialchars($product['poids']); ?></p>
    <p><strong>Poids KG:</strong> <?php echo htmlspecialchars($product['poids_kg']); ?></p>
    <p><a href="list.php">Back to list</a></p>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
    <link rel="shortcut icon" href="../img/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/produit.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&family=Swanky+and+Moo+Moo&display=swap"
        rel="stylesheet">
</head>

<body>
    <nav class="flex">
        <div class="logo_burger">
            <div id="mySidenav" class="sidenav">
                <a id="closeBtn" href="#" class="close">×</a>
                <ul>
                    <li class="icon_burger"><a href=""><img src="../img/favoris.svg" alt=""></a></li>
                    <li class="icon_burger"><a href=""><img src="../img/profile.svg" alt=""></a></li>
                    <li class="icon_burger"><a href=""><img src="../img/panier.svg" alt=""></a></li>
                    <li><a href="view/fruit.html">Fruits & Légumes</a></li>
                    <li><a href="view/viandes_blanches.html">Viande & Charcuteries</a></li>
                    <li><a href="view/poissons.html">Poisson & Fruits de mer</a></li>
                    <li><a href="./view/productPages/epicerie.php">Epicerie</a></li>
                    <li><a href="./view/productPages/cremerie.php">Crémerie</a></li>
                    <li><a href="./view/productPages/boisson.php">Boissons</a></li>
                    <li><a href="">Bons Plans</a></li>
                    <li><a href="">Ateliers</a></li>
                    <li><a href="">Producteurs</a></li>
                </ul>
            </div>

            <a href="#" id="openBtn">
                <span class="burger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            <a href="" id="logo"><img id="logo_img" src="../img/Logo final V2 SVG.svg" alt=""></a>
        </div>
        <div class="flex right-nav">
            <a href=""><img src="../img/favoris.svg" alt=""></a>
            <a href=""><img src="../img/profile.svg" alt=""></a>
            <a href=""><img src="../img/panier.svg" alt=""></a>
        </div>
    </nav>

    <div class="flex" id="menu">
        <a href="view/fruit_legume.html">Fruits & Légumes</a>
        <a href="view/viandes_blanches.html">Viande & Charcuteries</a>
        <a href="view/poissons.html">Poisson & Fruits de mer</a>
        <a href="">Epicerie</a>
        <a href="">Crémerie</a>
        <a href="">Boissons</a>
        <a href="">Bons Plans</a>
        <a href="">Ateliers</a>
        <a href="">Carte</a>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Rechercher...">
        <a href="#" class="search-icon">
            <i class="fa fa-search"></i>
        </a>
    </div>

    <div class="chemin_acces">
        <p><span>< <?php echo htmlspecialchars($category['title']); ?></span></p>
    </div>

    <div class="leProduit">
        <div class="img_txt">
            <div class="img">
            </div>
            <div class="txt">
                <div class="fav">
                    <img src="../img/favoris.svg" alt="">
                </div>
                <h3> <?php echo htmlspecialchars($product['title']); ?> <br> <?php echo htmlspecialchars($product['poids']); ?></h3>
                <div class="price">
                    <p>Avis client : <?php echo $averageRating ? number_format($averageRating, 2) : 'Pas encore de note'; ?>/5</p>
                    <p class="prix"><?php echo htmlspecialchars($product['price']); ?>€</p>
                </div>
                <div class="poid">
                    <p><?php echo htmlspecialchars($product['poids_kg']); ?></p>
                </div>
                <button>Ajouter au panier</button>
            </div>
        </div>
        <div class="details">
            <div class="description">
                <h4>Description du produit</h4>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
            </div>
            <div class="caracteristique">
                <h4>Caractéristiques</h4>
                <ul>
                    <li><p><?php echo htmlspecialchars($product['poids']); ?></p></li>
                    <li><p><?php echo htmlspecialchars($product['poids_kg']); ?></p></li>
                    <li><p><?php echo htmlspecialchars($product['nutri_score']); ?></p></li>
                </ul>
            </div>
            <div class="valeur">
                <h4>Valeurs nutritionnelles pour 100g</h4>
                <p><?php echo htmlspecialchars($product['caracteristique']); ?></p>
            </div>
        </div>
    </div>

    <footer>
        <div class="links_reseaux">
            <div id="footer">
                <div class="flex links-section">
                    <div class="links">
                        <p>Nous contacter</p>
                        <p>01.00.00.00.00</p>
                        <p>Terreôpanier@gmail.com</p>
                        <p>40 Rue du Chemin Vert - 75011 Paris</p>
                    </div>
                    <div class="links">
                        <p>Le service client</p>
                        <a href="">Livraisons</a>
                        <a href="">Remboursements</a>
                        <a href="">Commandes</a>
                    </div>
                    <div class="links">
                        <p>Notre société</p>
                        <a href="">Nos engagements</a>
                        <a href="">L'équipe</a>
                        <a href="">Nous rejoindre</a>
                    </div>
                </div>
            </div>
            <h6>Suivez-nous sur les réseaux</h6>
            <div class="flex reseaux">
                <span><a href="https://www.facebook.com/people/Terre-Ô-Panier/61557170597906/" target="_blank"><img
                            src="../img/facebook_f_logo_icon_145290.png" alt=""></a></span>
                <span><a href="https://www.instagram.com/terreopanier?igsh=a2Y3OHc5OHk1ZGEx" target="_blank"><img
                            src="../img/b9f2a640b168cdb9f865185facee4cd3.png" alt=""></a></span>
            </div>
        </div>
        <div id="mentions" class="flex">
            <a href="">Conditions générales de vente</a>
            <a href="">Informations légales</a>
            <a href="">Données personnelles</a>
            <a href="">Politique de cookies</a>
        </div>
    </footer>
    <script src="script.js"></script>
</body>

</html>