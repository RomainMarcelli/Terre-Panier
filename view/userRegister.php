<?php
// Récupérer les départements depuis l'API Geoportail
function getDepartments()
{
    $url = 'https://geo.api.gouv.fr/departements';
    $response = file_get_contents($url);
    return json_decode($response, true);
}

$departments = getDepartments();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création De Compte</title>
    <link rel="shortcut icon" href="../img/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/register.css">
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
    <div class="creation_compte">
        <h1>Créer un compte</h1>
        <form action="../controller/UserRegisterController.php" method="POST">
            <label for="firstname">Prénom</label>
            <input type="text" id="firstname" name="firstname" required>
            <br>
            <label for="lastname">Nom</label>
            <input type="text" id="lastname" name="lastname" required>
            <br>
            <label for="email">Adresse mail</label>
            <input type="email" id="email" name="email" required>
            <br>
            <div class="mdp">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
                <div class="specificite">
                    <p>12 caractères minimum</p>
                    <p>1 majuscule</p>
                    <p>1 nombre</p>
                </div>
                <div class="specificite">
                    <p>1 caractère spécial</p>
                    <p class="minuscule">1 minuscule</p>
                    <p>&nbsp;</p>
                </div>
            </div>
            <br>
            <label for="location">Localisation</label>
            <div class="selection_depart">
                <select id="location" name="location" required>
                    <option value="">Sélectionner un département</option>
                    <?php foreach ($departments as $department) : ?>
                        <option value="<?php echo htmlspecialchars($department['nom']); ?>">
                            <?php echo htmlspecialchars($department['nom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br>
            <button type="submit">Valider</button>
        </form>

        <div class="accept_cdgt">
            <input type="checkbox" name="cdtg" id="cdgt">
            <p>J’ai lu et j’accepte <span>les conditions générales de vente</span> ainsi que la <span>politique de protection des données personnelles</span>.</p>
        </div>

    </div>
    <?php if (isset($msg)) {
        echo "<p>$msg</p>";
    } ?>

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
    <script src="../script.js"></script>
</body>

</html>