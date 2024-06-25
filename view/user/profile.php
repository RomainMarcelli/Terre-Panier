<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../inc/init.php'; // Ajustez le chemin selon la structure de votre projet
// session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'user') {
    header('Location: ../connexion.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Récupérer les informations de l'utilisateur
$stmt = $pdo->prepare('SELECT * FROM Users WHERE id = ?');
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifiez s'il y a des erreurs SQL
if ($stmt->errorCode() != '00000') {
    $errorInfo = $stmt->errorInfo();
    die("SQL error: " . $errorInfo[2]);
}

if (!$user) {
    die('User not found.');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile User</title>
    <link rel="shortcut icon" href="../../img/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/profile.css">
    <link rel="stylesheet" href="../../css/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Shade&family=Swanky+and+Moo+Moo&display=swap" rel="stylesheet">
    <script>
        function confirmDeletion() {
            if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
                window.location.href = 'delete_account.php';
            }
        }
    </script>
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
                        <li class="icon_burger"><a href="../myAccount/panier.php"><img src="../../img/panier.svg" alt=""></a></li>
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
                <a href="../myAccount/panier.php"><img src="../../img/panier.svg" alt=""></a>
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
                    </svg> Mon compte</p>
            </div>
            <div class="complet">
                <div class="bar_filtre" id="bar_filtreLivraison">
                    <div class="trier">
                        <a href=".infoPerso.php">
                            <p class="gras">Mes informations personnelles</p>
                        </a>
                        <a href="adresseLivraison.php">
                            <p>Mes adresses de livraison</p>
                        </a>
                        <a href="./commande.php">
                            <p>Mes commandes</p>
                        </a>
                        <a href="./parametre.php">
                            <p>Mes paramètres</p>
                        </a>
                        <a href="./favoris.php">
                            <p>Mes favoris</p>
                        </a>
                        <a href="./avis.php">
                            <p>Mes avis</p>
                        </a>
                    </div>
                </div>
            <div class="profile">
                <h2>Mes informations personelles</h2>
                <h4 class="infos_perso">Informations personelles</h4>
                <label for="name">Prénom</label>
                <!-- <input type="text" name="name" id="name" placeholder="<?php echo htmlspecialchars($user['firstname']); ?>"> -->
                <p><?php  echo htmlspecialchars($user['firstname']); ?></p>
                 <label for="surname">Nom</label>
                 <!-- <input type="text" name="surname" id="surname" placeholder="<?php echo htmlspecialchars($user['lastname']); ?>"> -->
                <p><?php  echo htmlspecialchars($user['lastname']); ?></p>
                <label for="mail">Adresse mail</label>
                 <!-- <input type="text" name="mail" id="mail" placeholder="<?php //echo htmlspecialchars($user['email']); ?>"> -->
                <p><?php echo htmlspecialchars($user['email']); ?></p>
                 <label for="location">Localisation</label>
                 <!-- <input type="text" name="location" id="location" placeholder="<?php echo htmlspecialchars($user['location']); ?>"> -->
                <p><?php echo htmlspecialchars($user['location']); ?></p>
                <form method="POST" action="../logout.php">
                    <button type="submit">Logout</button>
                </form>
                <button class="delete" onclick="confirmDeletion()">Supprimer mon compte</button>
            </div>
            </div>
        </div>
    </main>
</body>

</html>