<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Database;
use App\Category;

// Create a new Database instance
$database = Database::getInstance('localhost', 'root', 'root', 'ecommerce');
$conn = $database->getConnection();

// Create a new Category instance
$category = new Category($conn);
