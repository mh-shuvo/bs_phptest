<?php
require_once 'common.php';

// Get the category tree with item counts
$categoryTree = $category->getCategoryTreeWithItemCounts(null);
?>
    <a href="./">Back</a> <br>
    <h1>Task 2 - Category Tree</h1>
<?php
$category->printCategoryTree($categoryTree);

