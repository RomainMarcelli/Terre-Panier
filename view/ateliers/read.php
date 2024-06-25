<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Ateliers</title>
    <link rel="shortcut icon" href="../../img/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/all.css">
    <!-- <link rel="stylesheet" href="../../css/produit.css"> -->
    <link rel="stylesheet" href="/mds-back/TerreOPanier/css/produit.css">
    <link rel="stylesheet" href="../../css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&family=Swanky+and+Moo+Moo&display=swap" rel="stylesheet">
</head>

<body>
    <header>

        <div class="flex" id="menu">
            <a href="../productPages/fruit.php">Fruits & Légumes</a>
            <a href="../productPages/viandes.php">Viande & Charcuteries</a>
            <a href="../productPages/poissons.php">Poisson & Fruits de mer</a>
               <a href="../productPages/epicerie.php">Epicerie</a>
            <a href="../productPages/cremerie.php">Crémerie</a>
            <a href="../productPages/boisson.php">Boissons</a>
            <a href="">Bons Plans</a>
            <a href="">Ateliers</a>
            <a href="">Producteurs</a>
        </div>
    </header>
    <div class="search-bar">
        <input type="text" placeholder="Rechercher...">
        <a href="#" class="search-icon">
            <i class="fa fa-search"></i>
        </a>
    </div>
    <h2>Les Ateliers</h2>
    <div class="leProduit">
        <?php if ($atelier) : ?>
            <div class="img_txt">
                <div class="img">
                </div>
                <div class="txt">
                    <div class="fav">
                        <img src="../../img/favoris.svg" alt="">
                    </div>
                    <h3><?php echo htmlspecialchars($atelier['title']); ?></h3>
                    <div class="location">
                        <svg width="34" height="61" viewBox="0 0 34 61" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="34" height="61" fill="url(#pattern0_490_849)" />
                            <defs>
                                <pattern id="pattern0_490_849" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_490_849" transform="matrix(0.015625 0 0 0.00870902 0 -0.00512295)" />
                                </pattern>
                                <image id="image0_490_849" width="64" height="116" xlink:href="data:image/png;base64,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" />
                            </defs>
                        </svg>
                        <p><?php echo htmlspecialchars($atelier['location']); ?></p>
                    </div>
                    <div class="price">
                        <p>Avis client : 3,5/5</p>
                    </div>
                    <div class="price" id="prix">
                        <p class="prix"><?php echo htmlspecialchars($atelier['price'] ?? '') . '€'; ?></p>
                    </div>
                    <button class="creneau"><a href="">Réserver un créneau</a></button>
                </div>
            </div>
            <div class="details">
                <div class="description">
                    <h4>L’atelier en détail</h4>
                    <p><?php echo htmlspecialchars($atelier['description']); ?></p>
                </div>
                <div class="caracteristique">
                    <h4>À Savoir</h4>
                    <ul>
                        <li>
                            <p>Temps : <?php echo htmlspecialchars($atelier['time']); ?></p>
                        </li>
                        <li>
                            <p>Particpants max : <?php echo htmlspecialchars($atelier['place']); ?></p>
                        </li>
                        <li>
                            <p>Âge minimum : Aucun</p>
                        </li>
                        <li>
                            <p>Lieu : 11 rue du Chemin Vert, 59280 Ronchin</p>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="rencontre">
                    <div class="rencontre_txt">
                        <p class="gras">Rencontrez le professionnel</p>
                        <p>Justine, productrice passionnée et engagée, vous propose de découvrir sa ferme à travers ses produits frais mais également des ateliers pour grands et petits.</p>
                        <button class="btn_rencontre"><a href="../producteur.php">Découvrir le profil</a></button>
                    </div>
                    <div class="img_producteur">
                        <img src="../img/img_producteur.jpg" alt="Producteurs">
                    </div>
                </div>
            </div>
        <?php else : ?>
            <p>Atelier not found.</p>
        <?php endif; ?>
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