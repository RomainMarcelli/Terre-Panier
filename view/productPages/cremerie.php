
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../inc/init.php';

$stmt = $pdo->prepare('SELECT * FROM Products WHERE category_product_id = ?');
$stmt->execute([6]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($stmt->errorCode() != '00000') {
    $errorInfo = $stmt->errorInfo();
    die("SQL error: " . $errorInfo[2]);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crémerie</title>
    <link rel="shortcut icon" href="../../img/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&family=Swanky+and+Moo+Moo&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="flex">
        <div class="logo_burger">
            <div id="mySidenav" class="sidenav">
                <a id="closeBtn" href="#" class="close">×</a>
                <ul>
                    <li class="icon_burger"><a href="../myAccount/favoris.php"><img src="../../img/favoris.svg" alt=""></a></li>
                    <li class="icon_burger"><a href="../profile.php"><img src="../../img/profile.svg" alt=""></a></li>
                    <li class="icon_burger"><a href=""><img src="../../img/panier.svg" alt=""></a></li>
                    <li><a href="./fruit.php">Fruits & Légumes</a></li>
                    <li><a href="./viandes.php">Viande & Charcuteries</a></li>
                    <li><a href="./poissons.php">Poisson & Fruits de mer</a></li>
                    <li><a href="./epicerie.php">Epicerie</a></li>
                    <li><a href="./cremerie.php">Crémerie</a></li>
                    <li><a href="./boisson.php">Boissons</a></li>
                    <li><a href="">Bons Plans</a></li>
                    <li><a href="../../all_ateliers.php">Ateliers</a></li>
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
            <a href="../../index.php" id="logo"><img id="logo_img" src="../../img/Logo final V2 SVG.svg" alt=""></a>
        </div>
        <div class="flex right-nav">
            <a href="../myAccount/favoris.php"><img src="../../img/favoris.svg" alt=""></a>
            <a href="../profile.php"><img src="../../img/profile.svg" alt=""></a>
            <a href=""><img src="../../img/panier.svg" alt=""></a>
        </div>
    </nav>

    <div class="flex" id="menu">
        <a href="./fruit.php">Fruits & Légumes</a>
        <a href="./viandes.php">Viande & Charcuteries</a>
        <a href="./poissons.php">Poisson & Fruits de mer</a>
        <a href="./epicerie.php">Epicerie</a>
        <a href="./cremerie.php">Crémerie</a>
        <a href="./boisson.php">Boissons</a>
        <a href="">Bons Plans</a>
        <a href="../../all_ateliers.php">Ateliers</a>
        <a href="">Producteurs</a>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Rechercher...">
        <a href="#" class="search-icon">
            <i class="fa fa-search"></i>
        </a>
    </div>

    <!-- <div class="chemin_acces">
        <p>Crémerie <span>></span> Crémerie</p>
    </div> -->

    <h2 class="title_page">Crémerie</h2>

    <div class="complet">
        <div class="bar_filtre">
            <div class="trier">
                <h4>Trier par <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                    </svg></h4>
                <div class="elements">
                    <input type="checkbox" id="pertinances" name="pertinances" />
                    <label for="pertinances">Pertinences</label>
                </div>
                <div class="elements">
                    <input type="checkbox" id="plus_moins" name="plus_moins" />
                    <label for="plus_moins">Du - cher au + cher</label>
                </div>
                <div class="elements">
                    <input type="checkbox" id="moins_plus" name="moins_plus" />
                    <label for="moins_plus">Du + cher au - cher</label>
                </div>
                <div class="elements">
                    <input type="checkbox" id="meilleure_note" name="meilleure_note" />
                    <label for="meilleure_note">Meilleure note</label>
                </div>

            </div>


            <div class="filtrer">
                <h4>Filtrer Par <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                    </svg></h4>
                <div class="selection">
                    <p>Sélections <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                        </svg>
                    </p>
                </div>
                <div class="checkboxes">
                    <div class="elements">
                        <input type="checkbox" id="selections-du-moment" name="selections-du-moment">
                        <label for="selections-du-moment">Sélections du moment</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="producteurs-engages" name="producteurs-engages">
                        <label for="producteurs-engages">Producteurs engagés</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="bons-plans" name="bons-plans">
                        <label for="bons-plans">Bons plans et promotions</label>
                    </div>
                    <div class="bar"></div>
                </div>
                <div class="region">
                    <p>Régions <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                        </svg>
                    </p>
                </div>
                <div class="checkboxes_region">
                    <div class="elements">
                        <input type="checkbox" id="auvergne-rhone-alpes" name="auvergne-rhone-alpes">
                        <label for="auvergne-rhone-alpes">Auvergne-Rhône-Alpes</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="bourgogne" name="bourgogne">
                        <label for="bourgogne">Bourgogne-Franche-Comté</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="bretagne" name="bretagne">
                        <label for="bretagne">Bretagne</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="centre" name="centre">
                        <label for="centre">Centre-Val de Loire</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="corse" name="corse">
                        <label for="corse">Corse</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="grand" name="grand">
                        <label for="grand">Grand-Est</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="haut" name="haut">
                        <label for="haut">Hauts-de-France</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="ile" name="ile">
                        <label for="ile">Île-de-France</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="normandie" name="normandie">
                        <label for="normandie">Normandie</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="nouvelle" name="nouvelle">
                        <label for="nouvelle">Nouvelle Aquitaine</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="occitanie" name="occitanie">
                        <label for="occitanie">Occitanie</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="pays" name="pays">
                        <label for="pays">Pays de la Loire</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="provence" name="provence">
                        <label for="provence">Provence-Alpes-Côte d’Azur</label>
                    </div>
                    <div class="bar"></div>
                </div>
                <div class="producteur">
                    <p>Producteurs <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                        </svg>
                    </p>
                </div>
                <div class="checkboxes_producteur">
                    <div class="elements">
                        <input type="checkbox" id="name" name="name">
                        <label for="name">Nom du producteur</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="name" name="name">
                        <label for="name">Nom du producteur</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="name" name="name">
                        <label for="name">Nom du producteur</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="name" name="name">
                        <label for="name">Nom du producteur</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="name" name="name">
                        <label for="name">Nom du producteur</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="name" name="name">
                        <label for="name">Nom du producteur</label>
                    </div>
                    <div class="bar"></div>
                </div>
                <div class="label">
                    <p>Labels <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                        </svg>
                    </p>
                </div>
                <div class="checkboxes_label">
                    <div class="elements">
                        <input type="checkbox" id="ab" name="ab">
                        <label for="ab">Agriculture Biologique (AB)</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="crc" name="crc">
                        <label for="crc">Culture raisonnée contrôlée (CRC)</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="aop" name="aop">
                        <label for="aop">AOP / AOC</label>
                    </div>
                    <div class="bar"></div>
                </div>
                <div class="note">
                    <p>Notes <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                        </svg>
                    </p>
                </div>
                <div class="checkboxes_note">
                    <div class="elements">
                        <input type="checkbox" id="5etoile" name="5etoile">
                        <label for="5etoile">5 étoiles</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="4etoile" name="4etoile">
                        <label for="4etoile">4 étoiles minimum</label>
                    </div>
                    <div class="elements">
                        <input type="checkbox" id="3etoile" name="3etoile">
                        <label for="3etoile">3 étoiles minimum</label>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="hidden">Crémerie</h2>
        <div id="produits">
        <?php foreach ($products as $product): ?>
            <div class="produit">
                <div></div>
                <div class="description-produit">
                    <p><?php echo htmlspecialchars($product['title']); ?></p>
                    <p class="price"><?php echo htmlspecialchars($product['price']); ?>€</p>
                    <button>+</button>
                </div>
            </div>
            <?php endforeach; ?>
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
                <span><a href="https://www.facebook.com/people/Terre-Ô-Panier/61557170597906/" target="_blank"><img src="../../img/facebook_f_logo_icon_145290.png" alt=""></a></span>
                <span><a href="https://www.instagram.com/terreopanier?igsh=a2Y3OHc5OHk1ZGEx" target="_blank"><img src="../../img/b9f2a640b168cdb9f865185facee4cd3.png" alt=""></a></span>
            </div>
        </div>
        <div id="mentions" class="flex">
            <a href="">Conditions générales de vente</a>
            <a href="">Informations légales</a>
            <a href="">Données personnelles</a>
            <a href="">Politique de cookies</a>
        </div>
    </footer>
    <script src="../../script.js"></script>
</body>

</html>