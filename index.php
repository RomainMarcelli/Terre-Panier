<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terre-Ô-Panier</title>
    <link rel="shortcut icon" href="img/favicon.ico"/> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&family=Swanky+and+Moo+Moo&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <div class="header-livraison">
            <p>Livraison gratuite à partir de 49€ d’achat
                10% offert sur votre première commande</p>
            <a href="">Voir conditions</a>
        </div>
        <nav class="flex">
            <div class="logo_burger">
                <div id="mySidenav" class="sidenav">
                    <a id="closeBtn" href="#" class="close">×</a>
                    <ul>
                        <li class="icon_burger"><a href="./view/myAccount/favoris.php"><img src="img/favoris.svg" alt=""></a></li>
                        <li class="icon_burger"><a href="./view/profile.php"><img src="img/profile.svg" alt=""></a></li>
                        <li class="icon_burger"><a href="./view/myAccount/detailsPanier.php"><img src="img/panier.svg" alt=""></a></li>
                        <li><a href="./view/productPages/fruit.php">Fruits & Légumes</a></li>
                        <li><a href="./view/productPages/viandes.php">Viande & Charcuteries</a></li>
                        <li><a href="./view/productPages/poissons.php">Poisson & Fruits de mer</a></li>
                        <li><a href="./view/productPages/epicerie.php">Épicerie</a></li>
                        <li><a href="./view/productPages/cremerie.php">Crémerie</a></li>
                        <li><a href="./view/productPages/boisson.php">Boissons</a></li>
                        <li><a href="">Bons Plans</a></li>
                        <li><a href="all_ateliers.php">Ateliers</a></li>
                        <li><a href="./view/producteur.php">Producteurs</a></li>
                    </ul>
                </div>

                <a href="#" id="openBtn">
                    <span class="burger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="./index.php" id="logo"><img id="logo_img" src="img/Logo final V2 SVG.svg" alt=""></a>
            </div>
            <div class="flex right-nav">
                <a href="./view/myAccount/favoris.php"><img src="img/favoris.svg" alt=""></a>
                <a href="./view/profile.php"><img src="img/profile.svg" alt=""></a>
                <a href="./view/myAccount/detailsPanier.php"><img src="img/panier.svg" alt=""></a>
            </div>
        </nav>
    </header>
    <div class="banniere">
        <h1>Du local dans votre assiette <br>
            <span class="texte-special">avec Terreôpanier</span>
        </h1>
        <div class="search-bar">
            <input type="text" placeholder="Rechercher...">
            <a href="#" class="search-icon">
                <i class="fa fa-search"></i>
            </a>
        </div>
    </div>
    <div class="flex" id="menu">
        <a href="./view/productPages/fruit.php">Fruits & Légumes</a>
        <a href="./view/productPages/viandes.php">Viande & Charcuteries</a>
        <a href="./view/productPages/poissons.php">Poisson & Fruits de mer</a>
        <a href="./view/productPages/epicerie.php">Epicerie</a>
        <a href="./view/productPages/cremerie.php">Crémerie</a>
        <a href="./view/productPages/boisson.php">Boissons</a>
        <a href="">Bons Plans</a>
        <a href="all_ateliers.php">Ateliers</a>
        <a href="">Producteurs</a>
    </div>
    <h2>Séléction du moment</h2>
    <div class="selection" id="selection">

        <button class="atelier-btn center" id="btn_select">Découvrir la sélection</button>
        <!-- <img id="selection" src="img/42e89c892d002e72aa72800f18a20c69.jpeg" alt=""> -->
    </div>
    <div id="produits">
        <div class="produit">
            <div></div>
            <div class="description-produit">
                <p>Produit</p>
                <p class="price">80,00€</p>
                <button>+</button>
            </div>
        </div>
        <div class="produit">
            <div></div>
            <div class="description-produit">
                <p>Produit</p>
                <p class="price">80,00€</p>
                <button>+</button>
            </div>
        </div>
        <div class="produit">
            <div></div>
            <div class="description-produit">
                <p>Produit</p>
                <p class="price">80,00€</p>
                <button>+</button>
            </div>
        </div>
        <div class="produit">
            <div></div>
            <div class="description-produit">
                <p>Produit</p>
                <p class="price">80,00€</p>
                <button>+</button>
            </div>
        </div>
        <div class="produit">
            <div></div>
            <div class="description-produit">
                <p>Produit</p>
                <p class="price">80,00€</p>
                <button>+</button>
            </div>
        </div>
        <div class="produit">
            <div></div>
            <div class="description-produit">
                <p>Produit</p>
                <p class="price">80,00€</p>
                <button>+</button>
            </div>
        </div>
        <div class="produit">
            <div></div>
            <div class="description-produit">
                <p>Produit</p>
                <p class="price">80,00€</p>
                <button>+</button>
            </div>
        </div>
        <div class="produit">
            <div></div>
            <div class="description-produit">
                <p>Produit</p>
                <p class="price">80,00€</p>
                <button>+</button>
            </div>
        </div>
    </div>

    <h2>Bons plans</h2>
    <div class="all_plans">

        <div id="bons-plans">
            <div class="product">
                <p class="pourcentage">-??%</p>
    
                <div class="square"></div>
                <h3>Produit</h3>
                <div class="prices">
                    <p><span class="barrer">00,00</span>€</p>
                    <p class="normal">00,00€</p>
                </div>
            </div>
    
            <div class="product">
    
                <p class="pourcentage">-??%</p>
    
                <div class="square"></div>
                <h3>Produit</h3>
                <div class="prices">
                    <p><span class="barrer">00,00</span>€</p>
                    <p class="normal">00,00€</p>
                </div>
            </div>
    
            <div class="product">
    
                <p class="pourcentage">-??%</p>
    
                <div class="square"></div>
                <h3>Produit</h3>
                <div class="prices">
                    <p><span class="barrer">00,00</span>€</p>
                    <p class="normal">00,00€</p>
                </div>
            </div>
    
            <div class="product">
    
                <p class="pourcentage">-??%</p>
    
                <div class="square"></div>
                <h3>Produit</h3>
                <div class="prices">
                    <p><span class="barrer">00,00</span>€</p>
                    <p class="normal">00,00€</p>
                </div>
            </div>
    
            <!-- PArtie 2 -->
            <div class="product">
                <p class="pourcentage">-??%</p>
    
                <div class="square"></div>
                <h3 id="orange">Produit</h3>
                <div id="orange" class="prices">
                    <p><span class="barrer">00,00</span>€</p>
                    <p class="normal">00,00€</p>
                </div>
            </div>
            <div class="product">
    
                <p class="pourcentage">-??%</p>
    
                <div class="square"></div>
                <h3 id="orange">Produit</h3>
                <div id="orange" class="prices">
                    <p><span class="barrer">00,00</span>€</p>
                    <p class="normal">00,00€</p>
                </div>
            </div>
            <div class="product">
    
                <p class="pourcentage">-??%</p>
    
                <div class="square"></div>
                <h3 id="orange">Produit</h3>
                <div id="orange" class="prices">
                    <p><span class="barrer">00,00</span>€</p>
                    <p class="normal">00,00€</p>
                </div>
            </div>
            <div class="product">
    
                <p class="pourcentage">-??%</p>
    
                <div class="square"></div>
                <h3 id="orange">Produit</h3>
                <div id="orange" class="prices">
                    <p><span class="barrer">00,00</span>€</p>
                    <p class="normal">00,00€</p>
                </div>
            </div>
    
        </div>
        <button class="atelier-btn center">Découvrir la sélection</button>
    </div>

    <div id="atelier">
        <h2 id="atelier-title">Ateliers participatifs</h2>
        <p id="atelier-description">Allez au contact des producteurs, vivez une rencontre humaine et découvrez un
            savoir-faire, une technique ou encore de belles histoires. De quoi vous créer des souvenirs chaleureux et
            simples !</p>
        <div class="flex space-around">
            <div class="atelier-fiche">
                <div class="atelier-img"></div>
                <p class="atelier-description">Dégustation de fromage de chèvre chez Bertrand</p>
                <button class="atelier-btn">Je m'inscris</button>
            </div>
            <div class="atelier-fiche">
                <div class="atelier-img"></div>
                <p class="atelier-description">Récolte de fraises <br>avec Camille</p>
                <button class="atelier-btn">Je m'inscris</button>
            </div>
        </div>
        <button class="atelier-btn center">Découvrir les ateliers</button>
    </div>

    <div id="engagements">
        <h2>Nos engagements</h2>
        <div class="flex engagements-section">
            <div>
                <img class="img_validation" src="img/validation.png" alt="">
                <p class="engagements-desc1">Produits de qualité</p>
                <p class="engagements-desc2">Nos produits sont sélectionnés méticuleusement et proviennent de méthodes
                    artisanales d’agriculture raisonnée.</p>
            </div>
            <div>
                <img class="img_main" src="img/main.png" alt="">
                <p class="engagements-desc1">Rémunération juste</p>
                <p class="engagements-desc2">Nous sommes à l’écoute de nos producteurs et nous proposons une
                    rémunération à leur juste valeur.</p>
            </div>
            <div>
                <img class="img_froid" src="img/froid.png" alt="">
                <p class="engagements-desc1">Respect de la chaîne de froid</p>
                <p class="engagements-desc2">La température est contrôlée tout au long de la livraison réalisée par
                    Chronopost pour garantir la bonne conservation de vos produits.</p>
            </div>
        </div>
    </div>

    <h3>Vous êtes agriculteur ou producteur et vous souhaitez vendre vos produits sur notre plateforme
        ?<br>Contactez-nous !</h3>
    <button class="atelier-btn join-cta">Rejoindre l'équipe</button>

    <div id="newsletter">
        <h4>Newsletter</h4>
        <p>Inscrivez-vous et restez informé(e) de toute l’actualité de Terreôpanier</p>
        <div class="newsletter-signup">
            <input type="email" placeholder="Votre email">
            <button type="button">S'inscrire</button>
        </div>
    </div>
</body>



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

</html>