<?php

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

    public function getCategoryTreeWithItemCounts($parentId = null, $indentation = "")
    {
        $query = "
            SELECT c.Id, c.Name AS CategoryName, COUNT(icr.ItemNumber) AS TotalItems
            FROM category c
            LEFT JOIN catetory_relations cr ON c.Id = cr.categoryId
            LEFT JOIN Item_category_relations icr ON c.Id = icr.categoryId ";

        $query.= $parentId != null ? "WHERE cr.ParentcategoryId = {$parentId}":"WHERE cr.ParentcategoryId IS NULL";
        $query.=" GROUP BY c.Id, c.Name ORDER BY c.Name DESC;";


        $result = $this->conn->query($query);
        $categoryTree = "";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categoryName = $row['CategoryName'];
                $totalItems = $row['TotalItems'];

                $categoryTree .= $indentation . $categoryName . ' (' . $totalItems . ')' . PHP_EOL;

                $categoryTree .= $this->getCategoryTreeWithItemCounts($row['Id'], $indentation . '   ');
            }
        }

        return $categoryTree;
    }
}
