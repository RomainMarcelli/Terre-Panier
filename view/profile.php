<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

require_once '../inc/init.php';

// Récupérer les informations de l'utilisateur connecté
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

if ($user_type == 'producteur') {
    $stmt = $pdo->prepare('SELECT * FROM Producteurs WHERE id = ?');
} else {
    $stmt = $pdo->prepare('SELECT * FROM Users WHERE id = ?');
}
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('User not found');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="shortcut icon" href="../img/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&family=Swanky+and+Moo+Moo&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="flex">
            <div class="logo_burger">
                <div id="mySidenav" class="sidenav">
                    <a id="closeBtn" href="#" class="close">×</a>
                    <ul>
                        <li class="icon_burger"><a href="./myAccount/favoris.php"><img src="../img/favoris.svg" alt=""></a></li>
                        <li class="icon_burger"><a href="./profile.php"><img src="../img/profile.svg" alt=""></a></li>
                        <li class="icon_burger"><a href=""><img src="../img/panier.svg" alt=""></a></li>
                        <li><a href="./productPages/fruit.php">Fruits & Légumes</a></li>
                        <li><a href="./productPages/viandes.php">Viande & Charcuteries</a></li>
                        <li><a href="./productPages/poissons.php">Poisson & Fruits de mer</a></li>
                        <li><a href="./productPages/epicerie.php">Epicerie</a></li>
                        <li><a href="./productPages/cremerie.php">Crémerie</a></li>
                        <li><a href="./productPages/boisson.php">Boissons</a></li>
                        <li><a href="">Bons Plans</a></li>
                        <li><a href="../all_ateliers.php">Ateliers</a></li>
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
                <a href="../index.php" id="logo"><img id="logo_img" src="../img/Logo final V2 SVG.svg" alt=""></a>
            </div>
            <div class="flex right-nav">
                <a href="./myAccount/favoris.php"><img src="../img/favoris.svg" alt=""></a>
                <a href="./profile.php"><img src="../img/profile.svg" alt=""></a>
                <a href=""><img src="../img/panier.svg" alt=""></a>
            </div>
        </nav>

        <div class="flex" id="menu">
            <a href="./productPages/fruit.php">Fruits & Légumes</a>
            <a href="./productPages/viandes.php">Viande & Charcuteries</a>
            <a href="./productPages/poissons.php">Poisson & Fruits de mer</a>
            <a href="./productPages/epicerie.php">Epicerie</a>
            <a href="./productPages/cremerie.php">Crémerie</a>
            <a href="./productPages/boisson.php">Boissons</a>
            <a href="">Bons Plans</a>
            <a href="../all_ateliers.php">Ateliers</a>
            <a href="">Producteurs</a>
        </div>
    </header>
    <main>
        <div class="cmd">

            <div class="chemin_acces" id="hidden">
                <p><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                    </svg> Mon compte</p>
            </div>
            <div class="complet">
            <div class="bar_filtre" id="bar_filtreLivraison">
                    <div class="trier">
                        <a href="profile.php">
                            <p class="gras">Mes informations personnelles</p>
                        </a>
                        <a href="../view/ateliers/list.php">
                            <p>Mes fiches atelier</p>
                        </a>
                        <a href="../view/products/list.php">
                            <p>Mes fiches produit</p>
                        </a>
                        <a href="../view/myAccount/parametre.php">
                            <p>Mes paramètres</p>
                        </a>
                    </div>
                </div>
                <div class="profile">
                    <h2>Profile</h2>
                    <h4 class="infos_perso">Informations personelles</h4>
                    <label for="name">Nom</label>
                    <p><?php echo htmlspecialchars($user['name'] ?? $user['firstname'] . ' ' . $user['lastname']); ?></p>
                    <label for="mail">Email</label>
                    <p> <?php echo htmlspecialchars($user['email']); ?></p>
                    <label for="telephone">Téléphone</label>
                    <p><?php echo htmlspecialchars($user['tel'] ?? 'N/A'); ?></p>
                    <label for="localisatiob">Localisation</label>
                    <p><?php echo htmlspecialchars($user['location']); ?></p>
                    <?php if ($user_type == 'producteur') : ?>
                        <div class="photo">
                            <label for="profil_picture">Photo de profil</label>
                            <div class="fichier">
                                <label class="custom-file-upload" for="profil_picture">Choisir un fichier</label>
                                <p><img src="<?php echo htmlspecialchars($user['profil_picture']); ?>" alt="Profile Picture"></p>
                                <input type="file" id="profil_picture" name="profil_picture" accept=".png, .jpg, .jpeg" style="display: none;">
                                <span id="file-name">Aucun fichier choisi</span>
                            </div>
                        </div>
                        <div class="description_atelier">
                            <label for="description">Description</label>
                            <textarea id="description" name="description"><?php echo htmlspecialchars($user['description']); ?></textarea>
                        </div>
                        <!-- <p><? //php echo htmlspecialchars($user['description']); ?></p> -->
                        <!-- <p><strong>Cover Picture:</strong> <img src="<?php // echo htmlspecialchars($user['cover_picture']); ?>" alt="Cover Picture"></p> -->
                         <label for="raison_social">Raison sociale</label>
                        <p><?php echo htmlspecialchars($user['raison_sociale']); ?></p>
                        <label for="siret">Siret</label>
                        <p><?php echo htmlspecialchars($user['siret']); ?></p>
                        <label for="adresse">Adresse</label>
                        <p><?php echo htmlspecialchars($user['adresse']); ?></p>
                    <?php endif; ?>
                    <a class="back_dashboard" href="../dashboard.php">Back to Dashboard</a>
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
                <span><a href="https://www.facebook.com/people/Terre-Ô-Panier/61557170597906/" target="_blank"><img src="../img/facebook_f_logo_icon_145290.png" alt=""></a></span>
                <span><a href="https://www.instagram.com/terreopanier?igsh=a2Y3OHc5OHk1ZGEx" target="_blank"><img src="../img/b9f2a640b168cdb9f865185facee4cd3.png" alt=""></a></span>
            </div>
        </div>
        <div id="mentions" class="flex">
            <a href="">Conditions générales de vente</a>
            <a href="">Informations légales</a>
            <a href="">Données personnelles</a>
            <a href="">Politique de cookies</a>
        </div>
    </footer>
    <script src="../script.js"></script>
</body>

</html>