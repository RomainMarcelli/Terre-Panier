<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création Fiche Atelier</title>
    <link rel="shortcut icon" href="../../img/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/fiche_atelier.css">
    <link rel="stylesheet" href="../../css/responsive.css">
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
                        <li class="icon_burger"><a href="../myAccount/favoris.php"><img src="../../img/favoris.svg" alt=""></a></li>
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
                <a href="../myAccount/favoris.php"><img src="../../img/favoris.svg" alt=""></a>
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
                        <a href="adresseLivraison.php">
                            <p class="gras">Mes fiches atelier</p>
                        </a>
                        <a href="./fiches_produit.php">
                            <p>Mes fiches produit</p>
                        </a>
                        <a href="./parametre.php">
                            <p>Mes paramètres</p>
                        </a>
                    </div>
                </div>
                <!-- <h2 class="hidden">Mes Commandes</h2> -->
                <div class="creationFiche_atelier">
                    <h2>Création Fiche Atelier</h2>
                    <div class="all_detail_atelier">

                        <label for="name_atelier">Nom de l'atelier</label>
                        <input type="text" name="name_atelier" id="name_atelier">
                        <div class="ville_region">
                            <div class="ville">
                                <label for="ville">Ville</label>
                                <input type="text" name="ville" id="ville">
                            </div>
                            <div class="regions">
                                <label for="region">Région</label>
                                <select name="region" id="region">
                                    <option value="">Sélectionner une région
                                    </option>
                                    <option value="Auvergne-Rhône-Alpes">Auvergne-Rhône-Alpes</option>
                                    <option value="Bourgogne-Franche-Comté">Bourgogne-Franche-Comté</option>
                                    <option value="Bretagne">Bretagne</option>
                                    <option value="Centre-Val de Loire">Centre-Val de Loire</option>
                                    <option value="Corse">Corse</option>
                                    <option value="Grand Est">Grand Est</option>
                                    <option value="Hauts-de-France">Hauts-de-France</option>
                                    <option value="Île-de-France">Île-de-France</option>
                                    <option value="Normandie">Normandie</option>
                                    <option value="Nouvelle-Aquitaine">Nouvelle-Aquitaine</option>
                                    <option value="Occitanie">Occitanie</option>
                                    <option value="Pays de la Loire">Pays de la Loire</option>
                                    <option value="Provence-Alpes-Côte d'Azur">Provence-Alpes-Côte d'Azur</option>

                                </select>
                            </div>
                        </div>
                        <div class="prix_photo">
                            <div class="prix">
                                <label for="prix">Prix</label>
                                <input type="text" name="prix" id="prix">
                            </div>
                            <div class="photo">
                                <!-- <label for="photo">Photo</label>
                                <input type="file" name="photo" id="photo"> -->
                                <label for="photo-label">Photo</label>
                                <label class="custom-file-upload" for="photo">Choisir un fichier</label>
                                <input type="file" name="photo" id="photo" style="display: none;">
                                <span id="file-name">Aucun fichier choisi</span>
                            </div>


                        </div>
                        <div class="description_atelier">
                            <label for="atelier_detail">L'atelier en détail</label>
                            <textarea name="atelier_detail" id="atelier_detail" placeholder="Décrire l'atelier"></textarea>
                        </div>
                        <div class="temps">
                            <label for="timeSelect">Temps</label>
                            <select id="timeSelect" name="timeSelect">
                                <option>Sélectionnez un temps</option>
                                <option value="30min">30 minutes</option>
                                <option value="1h">1 heure</option>
                                <option value="2h">2 heures</option>
                                <option value="3h">3 heures</option>
                            </select>
                        </div>
                        <div class="participant">
                            <label for="participant">Participants max</label>
                            <input type="text" name="participant" id="participant">
                        </div>
                        <div class="age">
                            <label for="age">Âge min</label>
                            <input type="text" name="age" id="age">
                        </div>
                        <div class="lieu">
                            <label for="lieu">Lieu</label>
                            <input type="text" name="lieu" id="lieu">
                        </div>
                        <div class="all_date">
                            <div class="date">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date">
                            </div>
                            <div class="debut">
                                <label for="debut">Début</label>
                                <input type="time" name="debut" id="debut">
                            </div>
                            <div class="fin">
                                <label for="fin">Fin</label>
                                <input type="time" name="fin" id="fin">
                            </div>
                        </div>

                        <div class="add_date">
                            <p>Ajouter une autre date</p>
                        </div>

                        <button>Valider</button>

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

    <script src="../../script.js"></script>

    <script>
        document.getElementById('photo').addEventListener('change', function() {
            var fileName = this.files[0] ? this.files[0].name : 'Aucun fichier choisi';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>
</body>

</html>