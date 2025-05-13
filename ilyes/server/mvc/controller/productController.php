<?php
include 'C:\xampp\htdocs\ozeum\ilyes\server\config.php';
include 'C:\xampp\htdocs\ozeum\ilyes\server\mvc\model\productModel.php';

class ProductController {
    public function listProducts() {
        $sql = "SELECT * FROM product";
        $db = config::getConnexion();
        
        try {
            $query = $db->query($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    } 

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM product WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    } 

      public function addProduct($dep){
        $sql = "INSERT INTO product 
                (id, titre, description, prix_normale, prix_promotion, quantite, image, category)
                VALUES (:id, :titre, :description, :prix_normale, :prix_promotion, :quantite, :image, :category)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $dep->getId(),
                'titre' => $dep->getTitre(),
                'description' => $dep->getDescription(),
                'prix_normale' => $dep->getPrixNormale(),
                'prix_promotion' => $dep->getPrixPromotion(),
                'quantite' => $dep->getQuantite(),
                'image' => $dep->getImage(),
                'category' => $dep->getCategory(),
            ]); 
            return true;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    } 

function updateProduct(Product $product, int $id)
{
    try {
        $db = config::getConnexion();

        $query = $db->prepare("
            UPDATE product SET 
                titre = :titre,
                description = :description,
                prix_normale = :prix_normale,
                prix_promotion = :prix_promotion,
                quantite = :quantite,
                image = :image,
                category = :category
            WHERE id = :id
        ");

        $query->execute([
            'titre' => $product->getTitre(),
            'description' => $product->getDescription(),
            'prix_normale' => $product->getPrixNormale(),
            'prix_promotion' => $product->getPrixPromotion(),
            'quantite' => $product->getQuantite(),
            'image' => $product->getImage(),
            'category' => $product->getCategory(),
            'id' => $id
        ]);

        // echo $query->rowCount() . " record(s) UPDATED successfully for ID: " . $id;
    } catch (PDOException $e) {
        echo "Error while updating product: " . $e->getMessage();
    }
}

    

    public function getProductById(int $id): ?array {
        $sql = "SELECT * FROM product WHERE id = :id";
        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            
            return $query->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (Exception $e) {
            throw new Exception("Error fetching product: " . $e->getMessage());
        }
    }    

  

    public function searchProductByName(string $searchTerm): array {
        $sql = "SELECT * FROM product WHERE titre LIKE :searchTerm";
        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $searchParam = "%" . $searchTerm . "%";
            $query->bindParam(':searchTerm', $searchParam, PDO::PARAM_STR);
            $query->execute();
            
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Search error: " . $e->getMessage());
        }
    }
    
    // Enhanced getProducts method with filters for category and price
    public function getProducts($searchTerm = null, $category = null, $minPrice = null, $maxPrice = null) {
        $db = config::getConnexion();
        $conditions = [];
        $params = [];
        
        // Build the SQL query based on filter conditions
        $sql = "SELECT * FROM product WHERE 1=1";
        
        // Add search term condition if provided
        if ($searchTerm) {
            $conditions[] = "titre LIKE :searchTerm";
            $params[':searchTerm'] = "%" . $searchTerm . "%";
        }
        
        // Add category condition if provided
        if ($category) {
            $conditions[] = "category = :category";
            $params[':category'] = $category;
        }
        
        // Add price range conditions if provided
        if ($minPrice !== null) {
            $conditions[] = "prix_promotion >= :minPrice";
            $params[':minPrice'] = $minPrice;
        }
        
        if ($maxPrice !== null) {
            $conditions[] = "prix_promotion <= :maxPrice";
            $params[':maxPrice'] = $maxPrice;
        }
        
        // Add conditions to SQL if any exist
        if (!empty($conditions)) {
            $sql .= " AND " . implode(" AND ", $conditions);
        }
        
        try {
            $query = $db->prepare($sql);
            
            // Bind all parameters
            foreach ($params as $param => $value) {
                $query->bindValue($param, $value);
            }
            
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Filter error: " . $e->getMessage());
        }
    }
    
    // Get all available categories
    public function getCategories() {
        $sql = "SELECT DISTINCT category FROM product ORDER BY category";
        $db = config::getConnexion();
        
        try {
            $query = $db->query($sql);
            return $query->fetchAll(PDO::FETCH_COLUMN, 0);
        } catch (Exception $e) {
            throw new Exception("Error fetching categories: " . $e->getMessage());
        }
    }
    
    // Get category counts
    public function getCategoryCounts() {
        $sql = "SELECT category, COUNT(*) as count FROM product GROUP BY category ORDER BY category";
        $db = config::getConnexion();
        
        try {
            $query = $db->query($sql);
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            
            // Convert to associative array with category as key
            $categoryCounts = [];
            foreach ($results as $row) {
                $categoryCounts[$row['category']] = $row['count'];
            }
            
            return $categoryCounts;
        } catch (Exception $e) {
            throw new Exception("Error fetching category counts: " . $e->getMessage());
        }
    }
    
    // Get price range (min and max prices in the database)
    public function getPriceRange() {
        $sql = "SELECT MIN(prix_promotion) as min_price, MAX(prix_promotion) as max_price FROM product";
        $db = config::getConnexion();
        
        try {
            $query = $db->query($sql);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Error fetching price range: " . $e->getMessage());
        }
    }
    
    // Count total products with filters
    public function countProducts($searchTerm = null, $category = null, $minPrice = null, $maxPrice = null): int {
        $db = config::getConnexion();
        $conditions = [];
        $params = [];
        
        // Build the SQL query based on filter conditions
        $sql = "SELECT COUNT(*) as total FROM product WHERE 1=1";
        
        // Add search term condition if provided
        if ($searchTerm) {
            $conditions[] = "titre LIKE :searchTerm";
            $params[':searchTerm'] = "%" . $searchTerm . "%";
        }
        
        // Add category condition if provided
        if ($category) {
            $conditions[] = "category = :category";
            $params[':category'] = $category;
        }
        
        // Add price range conditions if provided
        if ($minPrice !== null) {
            $conditions[] = "prix_promotion >= :minPrice";
            $params[':minPrice'] = $minPrice;
        }
        
        if ($maxPrice !== null) {
            $conditions[] = "prix_promotion <= :maxPrice";
            $params[':maxPrice'] = $maxPrice;
        }
        
        // Add conditions to SQL if any exist
        if (!empty($conditions)) {
            $sql .= " AND " . implode(" AND ", $conditions);
        }
        
        try {
            $query = $db->prepare($sql);
            
            // Bind all parameters
            foreach ($params as $param => $value) {
                $query->bindValue($param, $value);
            }
            
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return (int)$result['total'];
        } catch (Exception $e) {
            throw new Exception("Error counting products: " . $e->getMessage());
        }
    }  


    
    
}
?>