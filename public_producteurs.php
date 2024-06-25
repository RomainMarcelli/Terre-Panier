<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'inc/init.php';
session_start();

$department = $_GET['department'] ?? '';
$min_rating = $_GET['min_rating'] ?? '';

// Construire la requête SQL avec les filtres
$sql = "SELECT Producteurs.*, COALESCE((SELECT AVG(rating) FROM User_Ratings_Producteurs WHERE producteur_id = Producteurs.id), 0) as avg_rating 
        FROM Producteurs 
        WHERE 1=1";

$params = [];
if ($department) {
    $sql .= " AND Producteurs.location = ?";
    $params[] = $department;
}

if ($min_rating) {
    $sql .= " AND (SELECT AVG(rating) FROM User_Ratings_Producteurs WHERE producteur_id = Producteurs.id) >= ?";
    $params[] = $min_rating;
}

$stmt = $pdo->prepare($sql);
if (!$stmt) {
    die("SQL error: " . implode(", ", $pdo->errorInfo()));
}
$stmt->execute($params);
$producteurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($stmt->errorCode() != '00000') {
    $errorInfo = $stmt->errorInfo();
    die("SQL error: " . $errorInfo[2]);
}

// Récupérer tous les départements uniques
$departmentsStmt = $pdo->query("SELECT DISTINCT location FROM Producteurs WHERE location IS NOT NULL AND location != ''");
$departments = $departmentsStmt->fetchAll(PDO::FETCH_ASSOC);

if ($departmentsStmt->errorCode() != '00000') {
    $errorInfo = $departmentsStmt->errorInfo();
    die("SQL error: " . $errorInfo[2]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producteurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .producteur {
            border: 1px solid #ccc;
            padding: 16px;
            margin: 16px 0;
        }
        .producteur img {
            max-width: 150px;
            max-height: 150px;
        }
        .like-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .stars {
            display: flex;
            gap: 5px;
        }
        .star {
            font-size: 24px;
            cursor: pointer;
        }
        .star.checked {
            color: gold;
        }
    </style>
    <script>
        function rateProducteur(producteurId, rating) {
            fetch('view/rate_producteur.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'producteur_id=' + producteurId + '&rating=' + rating
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    highlightStars(producteurId, rating);
                    updateAverageRating(producteurId);
                } else {
                    alert('Error submitting rating: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function addStarClickListeners(producteurId) {
            document.querySelectorAll('.star-' + producteurId).forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-rating');
                    rateProducteur(producteurId, rating);
                });
            });
        }

        function highlightStars(producteurId, rating) {
            document.querySelectorAll('.star-' + producteurId).forEach(star => {
                star.classList.remove('checked');
                if (star.getAttribute('data-rating') <= rating) {
                    star.classList.add('checked');
                }
            });
        }

        function updateAverageRating(producteurId) {
            fetch('view/get_average_rating.php?producteur_id=' + producteurId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('avg-rating-' + producteurId).textContent = data.avg_rating.toFixed(2);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            <?php foreach ($producteurs as $producteur): ?>
                addStarClickListeners(<?php echo $producteur['id']; ?>);
                highlightStars(<?php echo $producteur['id']; ?>, <?php echo round($producteur['avg_rating'], 0); ?>);
            <?php endforeach; ?>
        });
    </script>
</head>
<body>
    <h1>Producteurs</h1>
    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'user'): ?>
        <p><a href="liked_items.php">Voir mes favoris</a></p>
    <?php endif; ?>

    <form method="GET" action="">
        <label for="department">Department:</label>
        <select id="department" name="department">
            <option value="">Tous</option>
            <?php foreach ($departments as $dept): ?>
                <option value="<?php echo htmlspecialchars($dept['location']); ?>" <?php if ($department === $dept['location']) echo 'selected'; ?>><?php echo htmlspecialchars($dept['location']); ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="min_rating">Note minimale:</label>
        <input type="number" step="0.1" id="min_rating" name="min_rating" value="<?php echo htmlspecialchars($min_rating); ?>">
        <br>
        <button type="submit">Appliquer les filtres</button>
    </form>

    <?php if (count($producteurs) > 0): ?>
        <?php foreach ($producteurs as $producteur): ?>
            <div class="producteur">
                <h2><?php echo htmlspecialchars($producteur['name']); ?></h2>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($producteur['email']); ?></p>
                <p><strong>Tel:</strong> <?php echo htmlspecialchars($producteur['tel']); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($producteur['location']); ?></p>
                <?php if (!empty($producteur['profil_picture'])): ?>
                    <p><img src="<?php echo htmlspecialchars($producteur['profil_picture']); ?>" alt="Profil Picture"></p>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'user'): ?>
                    <form action="like_producteur.php" method="POST">
                        <input type="hidden" name="producteur_id" value="<?php echo $producteur['id']; ?>">
                        <button type="submit" class="like-button">Like</button>
                    </form>
                    <div class="stars" id="stars-producteur-<?php echo $producteur['id']; ?>">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="star star-<?php echo $producteur['id']; ?>" data-rating="<?php echo $i; ?>">&#9733;</span>
                        <?php endfor; ?>
                    </div>
                    <p>Note: <span id="avg-rating-<?php echo $producteur['id']; ?>"><?php echo round($producteur['avg_rating'], 2); ?></span></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun producteurs trouvé.</p>
    <?php endif; ?>
</body>
</html>
