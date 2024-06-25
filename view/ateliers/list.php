<?php
require_once '../../model/Atelier.php';
require_once '../../model/CategoryAteliers.php';
require_once '../../model/Producteur.php';

// Récupérer tous les ateliers
$ateliers = Atelier::findAll();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Vérification de l'accès
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'producteur') {
    header('Location: ../connexion.php');
    exit;
}

require_once dirname(__DIR__, 2) . '/model/CategoryAteliers.php';
// Récupérer tous les ateliers
$ateliers = Atelier::findAll();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes fiches atelier</title>
    <link rel="shortcut icon" href="../../img/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/fiche_atelier.css">
    <link rel="stylesheet" href="../../css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&family=Swanky+and+Moo+Moo&display=swap" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <header>
        <nav class="flex">
            <div class="logo_burger">
                <div id="mySidenav" class="sidenav">
                    <a id="closeBtn" href="#" class="close">×</a>
                    <ul>
                        <li class="icon_burger"><a href=""><img src="../../img/favoris.svg" alt=""></a></li>
                        <li class="icon_burger"><a href=""><img src="../../img/profile.svg" alt=""></a></li>
                        <li class="icon_burger"><a href=""><img src="../../img/panier.svg" alt=""></a></li>
                        <li><a href="../productPages/fruit.php">Fruits & Légumes</a></li>
                        <li><a href="../productPages/viandes.php">Viande & Charcuteries</a></li>
                        <li><a href="../productPages/poissons.php">Poisson & Fruits de mer</a></li>
                        <li><a href="../productPages/epicerie.php">Epicerie</a></li>
                        <li><a href="../productPages/cremerie.php">Crémerie</a></li>
                        <li><a href="../productPages/boisson.php">Boissons</a></li>
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
                <a href="" id="logo"><img id="logo_img" src="../../img/Logo final V2 SVG.svg" alt=""></a>
            </div>
            <div class="flex right-nav">
                <a href=""><img src="../../img/favoris.svg" alt=""></a>
                <a href=""><img src="../../img/profile.svg" alt=""></a>
                <a href=""><img src="../../img/panier.svg" alt=""></a>
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
            <a href="../../all_ateliers.php">Ateliers</a>
            <a href="">Producteurs</a>
        </div>
    </header>
    <main>
        <div class="cmd">

            <div class="chemin_acces" id="hidden">
                <p><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                    </svg>Mon compte pro</p>
            </div>
            <div class="complet">
                <div class="bar_filtre" id="bar_filtreLivraison">
                    <div class="trier">
                        <a href="../profile.php">
                            <p>Mes informations personnelles</p>
                        </a>
                        <a href="#">
                            <p class="gras">Mes fiches atelier</p>
                        </a>
                        <a href="../products/list.php">
                            <p>Mes fiches produit</p>
                        </a>
                        <a href="../myAccount/parametre.php">
                            <p>Mes paramètres</p>
                        </a>
                    </div>
                </div>
                <div class="fiche_atelier" id="fiche_atelier">
                    <h2>Mes fiches atelier</h2>
                    <div class="link_create">
                        <a href="create.php">Créer une nouvelle fiche atelier</a>
                    </div>
                    <div class="fabrication">
                        <?php foreach ($ateliers as $atelier) : ?>
                            <?php
                            $producteur = Producteur::findById($atelier['producteur_id']);
                            $category = CategoryAteliers::findById($atelier['category_ateliers_id']);
                            ?>
                            <div class="ateliers">
                                <div class="title_price">
                                    <p><?php echo htmlspecialchars($atelier['title']); ?></p>
                                    <p><?php echo htmlspecialchars($atelier['price'] ?? '') . ' €'; ?></p>
                                </div>
                                <div class="lieu">
                                    <p><?php echo htmlspecialchars($atelier['location']); ?></p>
                                </div>
                                <div class="description">
                                    <?php echo htmlspecialchars($atelier['description']); ?>
                                </div>
                                <div class="btn_active">
                                    <p>Fiche active</p>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                <div class="btn_ben">
                                    <div></div>
                                    <button class="modifier_fiche">
                                        <a href="../../controller/AtelierController.php?action=update&id=<?php echo $atelier['id']; ?>">Modifier ma fiche</a>
                                    </button>
                                    <a href="../controller/AtelierController.php?action=delete&id=<?php echo $atelier['id']; ?>">
                                        <svg width="33" height="36" viewBox="0 0 33 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M30.0625 8.55556L28.3821 31.4914C28.2372 33.4683 26.5499 35 24.5169 35H8.48309C6.45011 35 4.76278 33.4683 4.61793 31.4914L2.9375 8.55556M12.625 16.1111V27.4444M20.375 16.1111V27.4444M22.3125 8.55556V2.88889C22.3125 1.84568 21.4451 1 20.375 1H12.625C11.5549 1 10.6875 1.84568 10.6875 2.88889V8.55556M1 8.55556H32" stroke="#2D1805" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
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

    <script>
        function changeQuantity(elementId, delta) {
            const input = document.getElementById(elementId);
            let currentValue = parseInt(input.value);
            let newValue = currentValue + delta;
            if (newValue < 1) newValue = 1; // Prevent quantity from going below 1
            input.value = newValue;
        }
        document.getElementById('photo').addEventListener('change', function() {
            var fileName = this.files[0] ? this.files[0].name : 'Aucun fichier choisi';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>

    <script src="../../script.js"></script>
</body>

</html>