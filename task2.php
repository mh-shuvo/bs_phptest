<?php
require_once 'Database.php';
require_once 'Category.php';

// Create a new Database instance
$database = new Database('localhost', 'root', 'root', 'ecommerce');
$conn = $database->connect();

// Create a new Category instance
$category = new Category($conn);

// Get the category tree with item counts
$categoryTree = $category->getCategoryTreeWithItemCounts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task 2 - Category Tree</title>
</head>
<body>
<h1>Task 2 - Category Tree</h1>
<pre><?php echo $categoryTree; ?></pre>
</body>
</html>
