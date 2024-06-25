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
        $order_by = '(SELECT AVG(rating) FROM User_Ratings_Products WHERE product_id = Products.id) DESC';
        break;
    case 'price_asc':
    default:
        $order_by = 'price ASC';
        break;
}

// Construire la requête SQL avec les filtres
$sql = "SELECT Products.*, Producteurs.location, COALESCE((SELECT AVG(rating) FROM User_Ratings_Products WHERE product_id = Products.id), 0) as avg_rating 
        FROM Products 
        JOIN Producteurs ON Products.producteurs_id = Producteurs.id 
        WHERE 1=1";

$params = [];
if ($department) {
    $sql .= " AND Producteurs.location = ?";
    $params[] = $department;
}

if ($min_rating) {
    $sql .= " AND (SELECT AVG(rating) FROM User_Ratings_Products WHERE product_id = Products.id) >= ?";
    $params[] = $min_rating;
}

$sql .= " ORDER BY $order_by";

$stmt = $pdo->prepare($sql);
if (!$stmt) {
    die("SQL error: " . implode(", ", $pdo->errorInfo()));
}
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Produits</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .product {
            border: 1px solid #ccc;
            padding: 16px;
            margin: 16px 0;
        }
        .product img {
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
        function rateItem(itemId, rating) {
            const url = 'view/rate_product.php';
            fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'product_id=' + itemId + '&rating=' + rating
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

        function addStarClickListeners(itemId) {
            document.querySelectorAll('.star-' + itemId).forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-rating');
                    rateItem(itemId, rating);
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
            fetch('view/get_average_rating.php?product_id=' + itemId)
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
            <?php foreach ($products as $product): ?>
                addStarClickListeners(<?php echo $product['id']; ?>);
                highlightStars(<?php echo $product['id']; ?>, <?php echo round($product['avg_rating'], 0); ?>);
            <?php endforeach; ?>
        });
    </script>
</head>
<body>
    <h1>Produits</h1>
    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'user'): ?>
        <p><a href="liked_items.php">favoris</a></p>
    <?php endif; ?>

    <form method="GET" action="">
        <label for="sort_order">Sort by:</label>
        <br>
        <input type="radio" id="price_asc" name="sort_order" value="price_asc" <?php if ($sort_order === 'price_asc') echo 'checked'; ?>>
        <label for="price_asc">Prix (Croissant)</label>
        <br>
        <input type="radio" id="price_desc" name="sort_order" value="price_desc" <?php if ($sort_order === 'price_desc') echo 'checked'; ?>>
        <label for="price_desc">Prix (Decroissant)</label>
        <br>
        <input type="radio" id="rating_desc" name="sort_order" value="rating_desc" <?php if ($sort_order === 'rating_desc') echo 'checked'; ?>>
        <label for="rating_desc">Notes</label>
        <br>
        <label for="department">Department:</label>
        <select id="department" name="department">
            <option value="">Tout</option>
            <?php foreach ($departments as $dept): ?>
                <option value="<?php echo htmlspecialchars($dept['location']); ?>" <?php if ($department === $dept['location']) echo 'selected'; ?>><?php echo htmlspecialchars($dept['location']); ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="min_rating">Minimum Rating:</label>
        <input type="number" step="0.1" id="min_rating" name="min_rating" value="<?php echo htmlspecialchars($min_rating); ?>">
        <br>
        <button type="submit">Appliquer</button>
    </form>

    <?php if (count($products) > 0): ?>
        <?php foreach ($products as $product): ?>
            <div class="product">
                <h2><?php echo htmlspecialchars($product['title']); ?></h2>
                <p><strong>Prix:</strong> <?php echo htmlspecialchars($product['price']); ?></p>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
                <p><strong>Caracteristique:</strong> <?php echo htmlspecialchars($product['caracteristique']); ?></p>
                <p><strong>Nutri Score:</strong> <?php echo htmlspecialchars($product['nutri_score']); ?></p>
                <p><strong>Quantity:</strong> <?php echo htmlspecialchars($product['quantity']); ?></p>
                <p><strong>Poids:</strong> <?php echo htmlspecialchars($product['poids']); ?></p>
                <p><strong>Poids (kg):</strong> <?php echo htmlspecialchars($product['poids_kg']); ?></p>
                <p><strong>Reduction:</strong> <?php echo htmlspecialchars($product['reduction']); ?></p>
                <p><strong>Category:</strong> <?php
                    $categoryStmt = $pdo->prepare('SELECT title FROM Category_Product WHERE id = ?');
                    $categoryStmt->execute([$product['category_product_id']]);
                    $category = $categoryStmt->fetch(PDO::FETCH_ASSOC);
                    echo htmlspecialchars($category['title']);
                ?></p>
                <p><strong>Producteur:</strong> <?php
                    $producerStmt = $pdo->prepare('SELECT name, location FROM Producteurs WHERE id = ?');
                    $producerStmt->execute([$product['producteurs_id']]);
                    $producer = $producerStmt->fetch(PDO::FETCH_ASSOC);
                    echo htmlspecialchars($producer['name']) . ' (' . htmlspecialchars($producer['location']) . ')';
                ?></p>
                <?php if (!empty($product['pictures'])): ?>
                    <p><img src="<?php echo htmlspecialchars($product['pictures']); ?>" alt="Product Image"></p>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'user'): ?>
                    <form action="like_product.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" class="like-button">Like</button>
                    </form>
                    <div class="stars" id="stars-product-<?php echo $product['id']; ?>">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span class="star star-<?php echo $product['id']; ?>" data-rating="<?php echo $i; ?>">&#9733;</span>
                        <?php endfor; ?>
                    </div>
                    <p>Note: <span id="avg-rating-<?php echo $product['id']; ?>"><?php echo round($product['avg_rating'], 2); ?></span></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucuns produits.</p>
    <?php endif; ?>
</body>
</html>
