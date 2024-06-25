<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'inc/init.php';
session_start();

$sort_order = $_GET['sort_order'] ?? 'price_asc';
$department = $_GET['department'] ?? '';
$min_rating = $_GET['min_rating'] ?? '';

$order_by = 'price ASC';
switch ($sort_order) {
    case 'price_desc':
        $order_by = 'price DESC';
        break;
    case 'rating_desc':
        $order_by = '(SELECT AVG(rating) FROM User_Ratings_Ateliers WHERE atelier_id = Ateliers.id) DESC';
        break;
    case 'price_asc':
    default:
        $order_by = 'price ASC';
        break;
}

// Construire la requête SQL avec les filtres
$sql = "SELECT Ateliers.*, Producteurs.location, COALESCE((SELECT AVG(rating) FROM User_Ratings_Ateliers WHERE atelier_id = Ateliers.id), 0) as avg_rating 
        FROM Ateliers 
        JOIN Producteurs ON Ateliers.producteur_id = Producteurs.id 
        WHERE 1=1";

$params = [];
if ($department) {
    $sql .= " AND Producteurs.location = ?";
    $params[] = $department;
}

if ($min_rating) {
    $sql .= " AND (SELECT AVG(rating) FROM User_Ratings_Ateliers WHERE atelier_id = Ateliers.id) >= ?";
    $params[] = $min_rating;
}

$sql .= " ORDER BY $order_by";

$stmt = $pdo->prepare($sql);
if (!$stmt) {
    die("SQL error: " . implode(", ", $pdo->errorInfo()));
}
$stmt->execute($params);
$ateliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Ateliers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .atelier {
            border: 1px solid #ccc;
            padding: 16px;
            margin: 16px 0;
        }
        .atelier img {
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
        function rateItem(itemId, itemType, rating) {
            const url = 'view/rate_' + itemType + '.php';
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + itemId + '&rating=' + rating
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    highlightStars(itemId, rating);
                    updateAverageRating(itemId);
                } else {
                    alert('Error submitting rating: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function addStarClickListeners(itemId, itemType) {
            document.querySelectorAll('.star-' + itemId).forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-rating');
                    rateItem(itemId, itemType, rating);
                });
            });
        }

        function highlightStars(itemId, rating) {
            document.querySelectorAll('.star-' + itemId).forEach(star => {
                star.classList.remove('checked');
                if (star.getAttribute('data-rating') <= rating) {
                    star.classList.add('checked');
                }
            });
        }

        function updateAverageRating(itemId) {
            fetch('view/get_average_rating.php?atelier_id=' + itemId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('avg-rating-' + itemId).textContent = data.avg_rating.toFixed(2);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            <?php foreach ($ateliers as $atelier): ?>
                addStarClickListeners(<?php echo $atelier['id']; ?>, 'atelier');
                highlightStars(<?php echo $atelier['id']; ?>, <?php echo round($atelier['avg_rating'], 0); ?>);
            <?php endforeach; ?>
        });
    </script>
</head>
<body>
    <h1>Ateliers</h1>
    <form method="GET" action="">
        <label for="sort_order">Filtrer par:</label>
        <br>
        <input type="radio" id="price_asc" name="sort_order" value="price_asc" <?php if ($sort_order === 'price_asc') echo 'checked'; ?>>
        <label for="price_asc">Prix (Croissant)</label>
        <br>
        <input type="radio" id="price_desc" name="sort_order" value="price_desc" <?php if ($sort_order === 'price_desc') echo 'checked'; ?>>
        <label for="price_desc">Prix (Decroissant)</label>
        <br>
        <input type="radio" id="rating_desc" name="sort_order" value="rating_desc" <?php if ($sort_order === 'rating_desc') echo 'checked'; ?>>
        <label for="rating_desc">Note</label>
        <br>
        <label for="department">Department:</label>
        <select id="department" name="department">
            <option value="">Tout</option>
            <?php foreach ($departments as $dept): ?>
                <option value="<?php echo htmlspecialchars($dept['location']); ?>" <?php if ($department === $dept['location']) echo 'selected'; ?>><?php echo htmlspecialchars($dept['location']); ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="min_rating">Note minimale:</label>
        <input type="number" step="0.1" id="min_rating" name="min_rating" value="<?php echo htmlspecialchars($min_rating); ?>">
        <br>
        <button type="submit">Appliquer</button>
    </form>

    <?php if (count($ateliers) > 0): ?>
        <?php foreach ($ateliers as $atelier): ?>
            <div class="atelier">
                <h2><?php echo htmlspecialchars($atelier['title']); ?></h2>
                <p><strong>Type:</strong> <?php echo htmlspecialchars($atelier['type']); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($atelier['location']); ?></p>
                <p><strong>Prix:</strong> <?php echo htmlspecialchars($atelier['price']); ?></p>
                <p><strong>Place:</strong> <?php echo htmlspecialchars($atelier['place']); ?></p>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($atelier['date']); ?></p>
                <p><strong>Time:</strong> <?php echo htmlspecialchars($atelier['time']); ?></p>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($atelier['description']); ?></p>
                <p><strong>Catégorie:</strong> <?php
                    $categoryStmt = $pdo->prepare('SELECT title FROM Category_Ateliers WHERE id = ?');
                    $categoryStmt->execute([$atelier['category_ateliers_id']]);
                    $category = $categoryStmt->fetch(PDO::FETCH_ASSOC);
                    echo htmlspecialchars($category['title']);
                ?></p>
                <p><strong>Producteur:</strong> <?php
                    $producerStmt = $pdo->prepare('SELECT name, location FROM Producteurs WHERE id = ?');
                    $producerStmt->execute([$atelier['producteur_id']]);
                    $producer = $producerStmt->fetch(PDO::FETCH_ASSOC);
                    echo htmlspecialchars($producer['name']) . ' (' . htmlspecialchars($producer['location']) . ')';
                ?></p>
                <?php if (!empty($atelier['pictures'])): ?>
                    <p><img src="<?php echo htmlspecialchars($atelier['pictures']); ?>" alt="Atelier Image"></p>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'user'): ?>
                    <form action="like_atelier.php" method="POST">
                        <input type="hidden" name="atelier_id" value="<?php echo $atelier['id']; ?>">
                        <button type="submit" class="like-button">Like</button>
                    </form>
                    <div class="stars" id="stars-atelier-<?php echo $atelier['id']; ?>">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="star star-<?php echo $atelier['id']; ?>" data-rating="<?php echo $i; ?>">&#9733;</span>
                        <?php endfor; ?>
                    </div>
                    <p>Note: <span id="avg-rating-<?php echo $atelier['id']; ?>"><?php echo round($atelier['avg_rating'], 2); ?></span></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucuns ateliers.</p>
    <?php endif; ?>
</body>
</html>
