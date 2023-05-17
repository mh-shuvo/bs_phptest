<a name="br1"></a>Practical Test Instruction

We have 4 tables

**1. category**

**2. catetory\_relations**

**3. Item**

**4. Item\_category\_relations**

Details about tables and relations:

**Category and Category\_Relations table details:**

Table: “**category**” contains the Category of Items.

Table: “**catetory\_relations**” contains the parent-child relationship
between “**category**”. (Many to Many from “**category**” table).

**Example**: One category has another category id as a parent.

**Relation**:

categoryId– Foreign key(Id from **category** table) ParentcategoryId – Foreign key(Id from **category** table)

**Item/Product table details:**

Table: “**Item**” has no parent column of category.

Table: “**Item\_category\_relations**” contains the relation between
**category** and **Item** tables.

(Many to Many from “**category**” and “**Item”** tables)

**Relation**:

ItemNumber – Foreign key (**Number** column from **Item** table)
categoryId – Foreign key(Id from **category** table)
**Example**: One item has multiple categories and one category has
multiple items.

Please create a database and import the “ecommerce.sql” file.



<a name="br2"></a>Your Tasks

**Task 1:**

Show all categories with total item and order categories by total Items
(DESC).

**Example output:**

Category Name Total Items
Woman 30 Men 29 Junior 0

**Note**: You don’t need to show nested childs. We need a flat table of pare.

**Task 2:**

We’ve uncountable child in each parent category and a child might be a
parent of another category.

**Example:**

Clothing (2038)

Men (256)
Shirts (100)
Half (30)

Full (70) Pants (156)
Jeans (100)
Cotton (56)
Formal (20)
Casual (36)

Women (1782)
Tops (1000)

Trousers (782)

The task is to create a **categories** tree with number of items contain in each category.




<a name="br3"></a> If a category has 5 child categories and each category has 50 items, then
the parent category’s total count will be 250 and for each child will be 50.

**Example output**: (You don’t need to show the products, we need only categories)

**Task 3:**

Please create a simple OOP Project and populate the Task 1 and Task 2 in
two different pages. Upload to a public Github repository and send us the
link.

Thank you.
