<?php
require_once 'inc/init.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'user') {
    header('Location: view/connexion.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Récupérer les produits aimés par l'utilisateur
$stmt = $pdo->prepare('SELECT p.* FROM Products p JOIN User_Favorite_Products ufp ON p.id = ufp.product_id WHERE ufp.user_id = ?');
$stmt->execute([$user_id]);
$likedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les ateliers aimés par l'utilisateur
$stmt = $pdo->prepare('SELECT a.* FROM Ateliers a JOIN User_Favorite_Ateliers ufa ON a.id = ufa.atelier_id WHERE ufa.user_id = ?');
$stmt->execute([$user_id]);
$likedAteliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les producteurs aimés par l'utilisateur
$stmt = $pdo->prepare('SELECT pr.* FROM Producteurs pr JOIN User_Favorite_Producteurs ufp ON pr.id = ufp.producteur_id WHERE ufp.user_id = ?');
$stmt->execute([$user_id]);
$likedProducteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Favoris</title>
    <link rel="shortcut icon" href="img/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/commande.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&family=Swanky+and+Moo+Moo&display=swap" rel="stylesheet">
</head>

<style>

</style>
<body>
    <header>
        <nav class="flex">
            <div class="logo_burger">
                <div id="mySidenav" class="sidenav">
                    <a id="closeBtn" href="#" class="close">×</a>
                    <ul>
                        <li class="icon_burger"><a href=""><img src="img/favoris.svg" alt=""></a></li>
                        <li class="icon_burger"><a href=""><img src="img/profile.svg" alt=""></a></li>
                        <li class="icon_burger"><a href=""><img src="img/panier.svg" alt=""></a></li>
                        <li><a href="../productPages/fruit.php">Fruits & Légumes</a></li>
                        <li><a href="../productPages/viandes.php">Viande & Charcuteries</a></li>
                        <li><a href="../productPages/poissons.php">Poisson & Fruits de mer</a></li>
                        <li><a href="../productPages/epicerie.php">Epicerie</a></li>
                        <li><a href="../productPages/cremerie.php">Crémerie</a></li>
                        <li><a href="../productPages/boisson.php">Boissons</a></li>
                        <li><a href="">Bons Plans</a></li>
                        <li><a href="">Ateliers</a></li>
                        <li><a href="">Carte</a></li>
                    </ul>
                </div>



                <a href="#" id="openBtn">
                    <span class="burger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="" id="logo"><img id="logo_img" src="img/Logo final V2 SVG.svg" alt=""></a>
            </div>
            <div class="flex right-nav">
                <a href=""><img src="img/favoris.svg" alt=""></a>
                <a href=""><img src="img/profile.svg" alt=""></a>
                <a href=""><img src="img/panier.svg" alt=""></a>
            </div>
        </nav>

        <div class="flex" id="menu">
            <a href="../productPages/fruit.php">Fruits & Légumes</a>
            <a href="../productPages/viandes.php">Viande & Charcuteries</a>
            <a href="../productPages/poissons.php">Poisson & Fruits de mer</a>
            <a href="../productPages/epicerie.php">Epicerie</a>
            <a href="../productPages/cremerie.php">Crémerie</a>
            <a href="../productPages/boisson.php">Boissons</a>
            <a href="">Bons Plans</a>
            <a href="">Ateliers</a>
            <a href="">Carte</a>
        </div>
    </header>


    <main>
        <div class="cmd">

            <div class="chemin_acces" id="hidden">
                <p><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                    </svg> Mon compte</p>
            </div>
            <div class="complet" id="complet_fav">
                <div class="bar_filtre">
                    <div class="trier" id="bar_fav">
                        <a href=".infoPerso.php">
                            <p>Mes informations personnelles</p>
                        </a>
                        <a href="adresseLivraison.php">
                            <p>Mes adresses de livraison</p>
                        </a>
                        <a href="./commande.php">
                            <p>Mes commandes</p>
                        </a>
                        <a href="./favoris.php">
                            <p class="gras">Mes favoris</p>
                        </a>
                        <a href="./avis.php">
                            <p>Mes avis</p>
                        </a>    
                    </div>
                </div>
                <!-- <h2 class="hidden">Mes Commandes</h2> -->
                <div class="commande">
                    <h2>Mes Favoris</h2>
                    <div id="produits">

                    <?php foreach ($likedProducts as $product): ?>
                        <div class="produit">
                            <div>
                            <?php if (!empty($product['pictures'])): ?>
                                <img src="<?php echo htmlspecialchars($product['pictures']); ?>" alt="Photo du produit">
                            <?php endif; ?>
                            </div>
                            <div class="description-produit">
                                <section class="all_title">
                                    <p>Le Verger de l’Azur</p>
                                    <p>Produit</p>
                                </section>
                                <p class="title"><?php echo htmlspecialchars($product['title']); ?></p>
                                <div class="price_btn">
                                    <section class="uniteG">
                                        <p>Quantité: <?php echo htmlspecialchars($product['quantity']); ?></p>
                                        <p class="gramme"><?php echo htmlspecialchars($product['poids']); ?>g</p>
                                    </section>
                                    <form action="unlike_product.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <button type="submit" class="unlike-button"><img src="img/heart.svg" alt=""></button>
                                    </form>
                                    <p class="price"><?php echo htmlspecialchars($product['price']); ?>€</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php foreach ($likedAteliers as $atelier): ?>
                        <div class="produit">
                            <div>
                            <?php if (!empty($atelier['pictures'])): ?>
                                <img src="<?php echo htmlspecialchars($atelier['pictures']); ?>" alt="Photo du produit">
                            <?php endif; ?>
                            </div>
                            <div class="description-produit">
                                <section class="all_title">
                                    <p>Le Verger de l’Azur</p>
                                    <p><?php echo htmlspecialchars($atelier['type']); ?></p>
                                </section>
                                <p class="title"><?php echo htmlspecialchars($atelier['title']); ?></p>
                                <div class="price_btn">
                                    <section class="uniteG">
                                        <p><?php echo htmlspecialchars($atelier['date']); ?> <?php echo htmlspecialchars($atelier['time']); ?></p>
                                        <p class="gramme"><?php echo htmlspecialchars($atelier['location']); ?> <?php echo htmlspecialchars($atelier['place']); ?></p>
                                    </section>
                                    <form action="unlike_atelier.php" method="POST">
                                        <input type="hidden" name="atelier_id" value="<?php echo $atelier['id']; ?>">
                                        <button type="submit" class="unlike-button"><img src="img/heart.svg" alt=""></button>
                                    </form>
                                    <p class="price"></strong> <?php echo htmlspecialchars($atelier['price']); ?>€</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php foreach ($likedProducteurs as $producteur): ?>   
                        <div class="produit">
                            <div>
                            <?php if (!empty($producteur['profil_picture'])): ?>
                                <img src="<?php echo htmlspecialchars($producteur['profil_picture']); ?>" alt="Profil Picture">
                            <?php endif; ?>
                            </div>
                            <div class="description-produit">
                                <section class="all_title">
                                    <p>Producteur</p>
                                    <p><?php echo htmlspecialchars($producteur['name']); ?></p>
                                </section>
                                <p class="title"><?php echo htmlspecialchars($producteur['location']); ?></p>
                                <div class="price_btn">
                                    <section class="uniteG">
                                        <p>Unité</p>
                                        <p class="gramme">340g</p>
                                    </section>
                                    <form action="unlike_producteur.php" method="POST">
                                        <input type="hidden" name="producteur_id" value="<?php echo $producteur['id']; ?>">
                                        <button type="submit" class="unlike-button"><img src="img/heart.svg" alt=""></button>
                                    </form>
                                    <p class="price">80,00€</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

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
                <span><a href="https://www.facebook.com/people/Terre-Ô-Panier/61557170597906/" target="_blank"><img src="img/facebook_f_logo_icon_145290.png" alt=""></a></span>
                <span><a href="https://www.instagram.com/terreopanier?igsh=a2Y3OHc5OHk1ZGEx" target="_blank"><img src="img/b9f2a640b168cdb9f865185facee4cd3.png" alt=""></a></span>
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
