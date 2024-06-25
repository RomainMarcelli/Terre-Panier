<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Panier</title>
    <link rel="shortcut icon" href="../../img/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/panier.css">
    <link rel="stylesheet" href="../../css/responsive.css">
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
                        <li class="icon_burger"><a href="./favoris.php"><img src="../../img/favoris.svg" alt=""></a></li>
                        <li class="icon_burger"><a href="../profile.php"><img src="../../img/profile.svg" alt=""></a></li>
                        <li class="icon_burger"><a href=""><img src="../../img/panier.svg" alt=""></a></li>
                        <li><a href="../productPages/fruit.php">Fruits & Légumes</a></li>
                        <li><a href="../productPages/viandes.php">Viande & Charcuteries</a></li>
                        <li><a href="../productPages/poissons.php">Poisson & Fruits de mer</a></li>
                        <li><a href="../productPages/epicerie.php">Epicerie</a></li>
                        <li><a href="../productPages/cremerie.php">Crémerie</a></li>
                        <li><a href="../productPages/boisson.php">Boissons</a></li>
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
                <a href="../../index.php" id="logo"><img id="logo_img" src="../../img/Logo final V2 SVG.svg" alt=""></a>
            </div>
            <div class="flex right-nav">
                <a href="./favoris.php"><img src="../../img/favoris.svg" alt=""></a>
                <a href="../profile.php"><img src="../../img/profile.svg" alt=""></a>
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
            <a href="">Ateliers</a>
            <a href="">Producteurs</a>
        </div>
    </header>

    <main>
        <h2>Mon Panier</h2>
        <div class="all_panier">
            <div class="all_achat" id="all_achat_details">
                <div class="achat">
                    <div class="txt">
                        <p>Expédier par : Nom du producteur</p>
                        <p>Nombre de produits : ??</p>
                    </div>
                    <div class="one_produit">
                        <img src="../../img/tomate.jpg" alt="Tomate">
                        <div class="details">
                            <p>Nom du produit</p>
                            <div class="quantity-controls">
                                <button class="moins" onclick="changeQuantity('quantity1', -1)">-</button>
                                <input id="quantity1" class="quantity" type="text" value="1" readonly>
                                <button class="plus" onclick="changeQuantity('quantity1', 1)">+</button>
                            </div>
                            <div class="ben">
                                <p>00,00€</p>
                                <svg width="33" height="36" viewBox="0 0 33 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30.0625 8.55556L28.3821 31.4914C28.2372 33.4683 26.5499 35 24.5169 35H8.48309C6.45011 35 4.76278 33.4683 4.61793 31.4914L2.9375 8.55556M12.625 16.1111V27.4444M20.375 16.1111V27.4444M22.3125 8.55556V2.88889C22.3125 1.84568 21.4451 1 20.375 1H12.625C11.5549 1 10.6875 1.84568 10.6875 2.88889V8.55556M1 8.55556H32" stroke="#2D1805" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="one_produit">
                        <img src="../../img/pamplemousse.jpg" alt="Tomate">
                        <div class="details">
                            <p>Nom du produit</p>
                            <div class="quantity-controls">
                                <button class="moins" onclick="changeQuantity('quantity1', -1)">-</button>
                                <input id="quantity1" class="quantity" type="text" value="1" readonly>
                                <button class="plus" onclick="changeQuantity('quantity1', 1)">+</button>
                            </div>
                            <div class="ben">
                                <p>00,00€</p>
                                <svg width="33" height="36" viewBox="0 0 33 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30.0625 8.55556L28.3821 31.4914C28.2372 33.4683 26.5499 35 24.5169 35H8.48309C6.45011 35 4.76278 33.4683 4.61793 31.4914L2.9375 8.55556M12.625 16.1111V27.4444M20.375 16.1111V27.4444M22.3125 8.55556V2.88889C22.3125 1.84568 21.4451 1 20.375 1H12.625C11.5549 1 10.6875 1.84568 10.6875 2.88889V8.55556M1 8.55556H32" stroke="#2D1805" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="one_produit">
                        <img src="../../img/aubergine.jpg" alt="Tomate">
                        <div class="details">
                            <p>Nom du produit</p>
                            <div class="quantity-controls">
                                <button class="moins" onclick="changeQuantity('quantity1', -1)">-</button>
                                <input id="quantity1" class="quantity" type="text" value="1" readonly>
                                <button class="plus" onclick="changeQuantity('quantity1', 1)">+</button>
                            </div>
                            <div class="ben">
                                <p>00,00€</p>
                                <svg width="33" height="36" viewBox="0 0 33 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30.0625 8.55556L28.3821 31.4914C28.2372 33.4683 26.5499 35 24.5169 35H8.48309C6.45011 35 4.76278 33.4683 4.61793 31.4914L2.9375 8.55556M12.625 16.1111V27.4444M20.375 16.1111V27.4444M22.3125 8.55556V2.88889C22.3125 1.84568 21.4451 1 20.375 1H12.625C11.5549 1 10.6875 1.84568 10.6875 2.88889V8.55556M1 8.55556H32" stroke="#2D1805" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div id="total_details">
                        <p class="uppercase">Total</p>
                        <p class="price_details">00,00€</p>
                    </div>
                </div>
                <div class="achat">
                    <div class="txt">
                        <p>Expédier par : Nom du producteur</p>
                        <p>Nombre de produits : ??</p>
                    </div>
                    <div class="one_produit">
                        <img src="../../img/tomate.jpg" alt="Tomate">
                        <div class="details">
                            <p>Nom du produit</p>
                            <div class="quantity-controls">
                                <button class="moins" onclick="changeQuantity('quantity1', -1)">-</button>
                                <input id="quantity1" class="quantity" type="text" value="1" readonly>
                                <button class="plus" onclick="changeQuantity('quantity1', 1)">+</button>
                            </div>
                            <div class="ben">
                                <p>00,00€</p>
                                <svg width="33" height="36" viewBox="0 0 33 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30.0625 8.55556L28.3821 31.4914C28.2372 33.4683 26.5499 35 24.5169 35H8.48309C6.45011 35 4.76278 33.4683 4.61793 31.4914L2.9375 8.55556M12.625 16.1111V27.4444M20.375 16.1111V27.4444M22.3125 8.55556V2.88889C22.3125 1.84568 21.4451 1 20.375 1H12.625C11.5549 1 10.6875 1.84568 10.6875 2.88889V8.55556M1 8.55556H32" stroke="#2D1805" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="one_produit">
                        <img src="../../img/pamplemousse.jpg" alt="Tomate">
                        <div class="details">
                            <p>Nom du produit</p>
                            <div class="quantity-controls">
                                <button class="moins" onclick="changeQuantity('quantity1', -1)">-</button>
                                <input id="quantity1" class="quantity" type="text" value="1" readonly>
                                <button class="plus" onclick="changeQuantity('quantity1', 1)">+</button>
                            </div>
                            <div class="ben">
                                <p>00,00€</p>
                                <svg width="33" height="36" viewBox="0 0 33 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30.0625 8.55556L28.3821 31.4914C28.2372 33.4683 26.5499 35 24.5169 35H8.48309C6.45011 35 4.76278 33.4683 4.61793 31.4914L2.9375 8.55556M12.625 16.1111V27.4444M20.375 16.1111V27.4444M22.3125 8.55556V2.88889C22.3125 1.84568 21.4451 1 20.375 1H12.625C11.5549 1 10.6875 1.84568 10.6875 2.88889V8.55556M1 8.55556H32" stroke="#2D1805" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="one_produit">
                        <img src="../../img/aubergine.jpg" alt="Tomate">
                        <div class="details">
                            <p>Nom du produit</p>
                            <div class="quantity-controls">
                                <button class="moins" onclick="changeQuantity('quantity1', -1)">-</button>
                                <input id="quantity1" class="quantity" type="text" value="1" readonly>
                                <button class="plus" onclick="changeQuantity('quantity1', 1)">+</button>
                            </div>
                            <div class="ben">
                                <p>00,00€</p>
                                <svg width="33" height="36" viewBox="0 0 33 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30.0625 8.55556L28.3821 31.4914C28.2372 33.4683 26.5499 35 24.5169 35H8.48309C6.45011 35 4.76278 33.4683 4.61793 31.4914L2.9375 8.55556M12.625 16.1111V27.4444M20.375 16.1111V27.4444M22.3125 8.55556V2.88889C22.3125 1.84568 21.4451 1 20.375 1H12.625C11.5549 1 10.6875 1.84568 10.6875 2.88889V8.55556M1 8.55556H32" stroke="#2D1805" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>

                        </div>
                    </div>
                    <div id="total_details">
                        <p class="uppercase">Total</p>
                        <p class="price_details">00,00€</p>
                    </div>
                </div>
            </div>
            <div class="recap" id="recap_details">
                <div class="input_panier">
                    <label for="promo">Ajout un code promo</label>
                    <input type="text" name="promo" id="promo">
                    <label for="bon_achat">Ajouter un bon d’achat ou chèque cadeau</label>
                    <input type="text" name="bon_achat" id="bon_achat">
                </div>
                <div class="reduc_price">
                    <p>Sous-total avant réduction</p>
                    <p>00,00€</p>
                </div>
                <hr class="hidden">
                <div class="reduc_price">
                    <p class="total">Total de la commande</p>
                    <p>00,00€</p>
                </div>
                <button>Passer la commande</button>
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
    </script>

    <script src="../../script.js"></script>
</body>

</html>