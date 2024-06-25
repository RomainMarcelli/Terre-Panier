<?php
session_start();

// Vérification de l'accès
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'producteur') {
    header('Location: ../connexion.php');
    exit;
}

require_once dirname(__DIR__, 2) . '/model/CategoryProduct.php';

// Récupérer toutes les catégories de produits
$categories = CategoryProduct::findAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
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
                            <p>Mes fiches atelier</p>
                        </a>
                        <a href="./list.php">
                            <p class="gras">Mes fiches produit</p>
                        </a>
                        <a href="../myAccount/parametre.php">
                            <p>Mes paramètres</p>
                        </a>
                    </div>
                </div>
                <div class="creationFiche_atelier">
                    <h2>CRÉATION FICHE PRODUIT</h2>
                    <div class="all_detail_atelier">
                        <form action="../../controller/ProductController.php?action=create" method="POST">
                            <div class="name_atelier">
                                <label for="title">Nom du produit</label>
                                <input type="text" id="title" name="title" required>
                            </div>
                            <br>
                            <div class="prix_photo">
                                <div class="prix">
                                    <label for="poids">Poids:</label>
                                    <input type="text" id="poids" name="poids">
                                </div>
                                <div class="photo">
                                    <label for="mesure">Mesure</label>
                                    <select name="mesure" id="mesure">
                                        <option value="mesure">Mesure</option>
                                    </select>
                                </div>
                            </div>
                            <div class="prix_photo">
                                <div class="prix">
                                    <label for="price">Prix</label>
                                    <input type="text" id="price" name="price" required>
                                </div>
                                <div class="photo">
                                    <label for="poids_kg">Prix au kg/L</label>
                                    <input type="text" name="poids_kg" id="poids_kg">
                                </div>
                            </div>
                            <div class="photo">
                                <label for="photo-label">Photo</label>
                                <label class="custom-file-upload" for="pictures">Choisir un fichier</label>
                                <input type="file" name="pictures" id="pictures" style="display: none;">
                                <span id="file-name">Aucun fichier choisi</span>
                            </div>
                            <div class="description_atelier">
                                <label for="description">Description du produit</label>
                                <textarea name="description" id="description" placeholder="Décrire le produit"></textarea>
                            </div>
                            <div class="description_atelier">
                                <label for="caracteristique">Caracteristique</label>
                                <textarea id="caracteristique" name="caracteristique" placeholder="Décrire les caractéristiques (variété, origine, culture, utilisation, conservation...)"></textarea>
                            </div>
                            <div class="description_atelier">
                                <label for="valeurs_nutri">Valeurs nutritionnelles</label>
                                <textarea id="valeurs_nutri" name="valeurs_nutri" placeholder="Décrire les valeurs nutritionnelles pour 100g (calories, protéines, glucides dont sucres, fibres alimentaires, lipides dont graisses saturées, vitamines...)"></textarea>
                            </div>
                            <div class="description_atelier">
                                <label for="nutri_score">Nutri Score:</label>
                                <input type="text" id="nutri_score" name="nutri_score">
                            </div>
                            <br>
                            <div class="description_atelier">
                                <label for="category_product_id">Category Product:</label>
                                <select id="category_product_id" name="category_product_id" required>
                                    <option value="select">Veuillez sélectionner une catégorie</option>
                                    <?php  foreach ($categories as $category) : 
                                    ?>
                                        <option value="<?php   echo htmlspecialchars($category['id']); 
                                                        ?>">
                                            <?php echo htmlspecialchars($category['title']); 
                                            ?>
                                        </option>
                                    <?php endforeach; 
                                    ?>
                                </select>
                            </div>
                            <div class="description_atelier">
                                <label for="quantity">Quantity:</label>
                                <input type="text" id="quantity" name="quantity" required>
                            </div>
                            <div class="description_atelier">
                                <label for="producteurs_id">Producteurs ID:</label>
                                <input type="text" id="producteurs_id" name="producteurs_id" required>
                            </div>
                            <div class="description_atelier">
                                <label for="poids_kg">Poids KG:</label>
                                <input type="text" id="poids_kg" name="poids_kg">
                            </div>
                            <div class="description_atelier">
                                <label for="reduction">Reduction:</label>
                                <input type="text" id="reduction" name="reduction">
                            </div>
                            <button type="submit">Valider</button>
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
    <script src="../../script.js"></script>
    <script>
        document.getElementById('pictures').addEventListener('change', function() {
            var fileName = this.files[0] ? this.files[0].name : 'Aucun fichier choisi';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>
</body>

</html>