<?php
require_once 'Database.php';
require_once 'Category.php';


// Create a new Database instance
$database = new Database('localhost', 'root', 'root', 'ecommerce');
$conn = $database->connect();
// Create a new Category instance
$category = new Category($conn);


// Get all categories with total items
$categories = $category->getAllCategoriesWithTotalItems();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Task 1 - Category List</title>
</head>
<body>
<h1>Task 1 - Category List</h1>
<table>
    <tr>
        <th>Category Name</th>
        <th>Total Items</th>
    </tr>
    <?php foreach ($categories as $cat): ?>
        <tr>
            <td><?php echo $cat['CategoryName']; ?></td>
            <td><?php echo $cat['TotalItems']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
