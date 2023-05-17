<?php

namespace App;

class Category
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllCategoriesWithTotalItems()
    {
        $query = "
            SELECT c.Name AS CategoryName, COUNT(icr.ItemNumber) AS TotalItems
            FROM category c
            LEFT JOIN Item_category_relations icr ON c.Id = icr.categoryId
            GROUP BY c.Id, c.Name
            ORDER BY TotalItems DESC;
        ";

        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            $categories = array();
            while ($row = $result->fetch_assoc()) {
                $category = array(
                    'CategoryName' => $row['CategoryName'],
                    'TotalItems' => $row['TotalItems']
                );
                $categories[] = $category;
            }
            return $categories;
        }

        return array();
    }

    public function getCategoryTreeWithItemCounts()
    {
        $tree = $this->buildCategoryTree(null);
        return $tree;
    }

    private function buildCategoryTree($parentId)
    {
        $categoryTree = [];
        $categories = $this->getCategories($parentId);
        foreach ($categories as $category) {
            $childs = $this->buildCategoryTree($category['Id']);

            $node = [
                'name' => $category['Name'],
                'total_items' => $category['total_items']
            ];

            if (!empty($childs)) {
                $node['children'] = $childs;
                $node['total_items'] += array_sum(array_column($childs, 'total_items'));
            }
            $categoryTree[] = $node;
        }
        return $categoryTree;
    }

    private function getCategories($parentId)
    {
        if (!$parentId) {
            $query = "SELECT c.Id, c.Name, COUNT(icr.ItemNumber) AS total_items FROM category c LEFT JOIN catetory_relations cr ON c.Id = cr.categoryId 
            LEFT JOIN Item_category_relations icr ON c.Id = icr.categoryId WHERE cr.ParentcategoryId IS NULL GROUP BY c.Id";
        } else {
            $query = "SELECT c.Id, c.Name, COUNT(icr.ItemNumber) AS total_items FROM category
            c LEFT JOIN catetory_relations cr ON c.Id = cr.categoryId LEFT JOIN Item_category_relations icr ON c.Id = icr.categoryId 
                                                          WHERE cr.ParentcategoryId = $parentId GROUP BY c.Id";
        }
        $result =  $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function printCategoryTree($tree, $indent = "")
    {
        foreach ($tree as $node) {
            $total = $node['total_items'];
            echo $indent . $node['name'] . " (" . $total . ")<br>";
            if (isset($node['children']) && !empty($node['children'])) {
                $this->printCategoryTree($node['children'], $indent . "&nbsp;&nbsp;&nbsp;");
            }
        }
    }
}