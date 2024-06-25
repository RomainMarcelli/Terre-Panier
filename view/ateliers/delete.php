<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Atelier</title>
</head>
<body>
    <h1>Delete Atelier</h1>
    <?php if ($atelier): ?>
        <p>Are you sure you want to delete this atelier?</p>
        <form action="../controller/AtelierController.php?action=delete&id=<?php echo $atelier['id']; ?>" method="POST">
            <button type="submit">Yes, delete</button>
        </form>
    <?php else: ?>
        <p>Atelier not found.</p>
    <?php endif; ?>
    <a href="list.php">Back to List</a>
</body>
</html>
