<?php
session_start();

// Vérification de l'accès
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'producteur') {
    header('Location: ../connexion.php');
    exit;
}

require_once dirname(__DIR__, 2) . '/model/CategoryAteliers.php';

// Récupérer toutes les catégories d'ateliers
$categories = CategoryAteliers::findAll();

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
    <title>Create Atelier</title>
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
                        <a href="../ateliers/list.php">
                            <p class="gras">Mes fiches atelier</p>
                        </a>
                        <a href="">
                            <p>Mes fiches produit</p>
                        </a>
                        <a href="../myAccount/parametre.php">
                            <p>Mes paramètres</p>
                        </a>
                    </div>
                </div>
                <div class="creationFiche_atelier">
                    <h2>Création Fiche Atelier</h2>
                    <div class="all_detail_atelier">
                        <form action="../../controller/AtelierController.php?action=create" method="POST">
                            <div class="name_atelier">
                                <label for="title">Nom de l'atelier</label>
                                <input type="text" id="title" name="title" required>
                            </div>
                            <!-- <br> -->
                            <!-- <label for="type">Type:</label>
                            <input type="text" id="type" name="type" required> -->
                            <!-- <br> -->
                            <div class="ville_region">
                                <div class="ville">
                                    <label for="ville">Ville</label>
                                    <input type="text" name="ville" id="ville">
                                </div>
                                <div class="regions">
                                    <label for="location">Localisation</label>
                                    <select name="location" id="location" required>
                                            <option value="">Sélectionner un département</option>
                                            <?php foreach ($departments as $department) : ?>
                                                <option value="<?php echo htmlspecialchars($department['nom']); ?>">
                                                    <?php echo htmlspecialchars($department['nom']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                    </select>
                                </div>
                            </div>
                            <!-- <label for="location">Location:</label>
                            <input type="text" id="location" name="location" required>
                            <br> -->
                            <div class="prix_photo">
                                <div class="prix">
                                    <label for="price">Prix</label>
                                    <input type="text" name="price" id="price" required>
                                </div>
                                <div class="photo">
                                    <!-- <label for="photo">Photo</label>
                                <input type="file" name="photo" id="photo"> -->
                                    <label for="photo-label">Photo</label>
                                    <label class="custom-file-upload" for="pictures">Choisir un fichier</label>
                                    <input type="file" name="pictures" id="pictures" style="display: none;">
                                    <span id="file-name">Aucun fichier choisi</span>
                                </div>
                            </div>
                            <!-- <label for="price">Price:</label>
                            <input type="text" id="price" name="price" required>
                            <br> -->
                            <!-- <label for="place">Place:</label>
                            <input type="text" id="place" name="place" required>
                            <br>
                            <label for="pictures">Pictures:</label>
                            <input type="text" id="pictures" name="pictures">
                            <br>
                            <label for="description">Description:</label>
                            <textarea id="description" name="description"></textarea>
                            <br>
                            <label for="time">Time:</label>
                            <input type="text" id="time" name="time" required>
                            <br>
                            <label for="date">Date:</label>
                            <input type="date" id="date" name="date" required>
                            <br> -->
                            <div class="description_atelier">
                                <label for="description">L'atelier en détail</label>
                                <textarea name="description" id="description" placeholder="Décrire l'atelier"></textarea>
                            </div>
                            <div class="temps">
                                <label for="time">Temps</label>
                                <select id="time" name="time">
                                    <option>Sélectionnez un temps</option>
                                    <option value="30min">30 minutes</option>
                                    <option value="1h">1 heure</option>
                                    <option value="2h">2 heures</option>
                                    <option value="3h">3 heures</option>
                                </select>
                            </div>
                            <div class="participant">
                                <label for="place">Participants max</label>
                                <input type="text" name="place" id="place">
                            </div>
                            <div class="age">
                                <label for="age">Âge min</label>
                                <input type="text" name="age" id="age">
                            </div>
                            <div class="lieu">
                                <label for="locatio">Lieu</label>
                                <input type="text" name="locatio" id="locatio">
                            </div>
                            <div class="all_date">
                                <div class="date">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date">
                                </div>
                                <div class="debut">
                                    <label for="date">Début</label>
                                    <input type="time" name="date" id="date">
                                </div>
                                <div class="fin">
                                    <label for="fin">Fin</label>
                                    <input type="time" name="fin" id="fin">
                                </div>
                            </div>

                            <div class="add_date">
                                <p>Ajouter une autre date</p>
                            </div>

                            <input type="hidden" id="producteur_id" name="producteur_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <label for="category_ateliers_id">Category Ateliers ID:</label>
                            <select id="category_ateliers_id" name="category_ateliers_id" required>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo htmlspecialchars($category['id']); ?>"><?php echo htmlspecialchars($category['title']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <button type="submit">Create</button>
                        </form>
                        <?php if (isset($msg)) {
                            echo "<p>$msg</p>";
                        } ?>
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