
<?php  
include_once  'C:\xampp\htdocs\ozeum\config.php';
include 'C:\xampp\htdocs\ozeum\ilyes\server\mvc\model\cartModel.php'; 

class cartController {
    public function addToCart(CartItem $cartItem) {
        $db = config::getConnexion();

        // Check if the product is already in the user's cart
        $checkSql = "SELECT id, quantity FROM cart WHERE user_email = :user_email AND product_id = :product_id";
        $checkStmt = $db->prepare($checkSql);
        $checkStmt->execute([
            'user_email' => $cartItem->getUserEmail(),
            'product_id' => $cartItem->getProductId()
        ]);
        $existing = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            // If exists, update the quantity
            $updateSql = "UPDATE cart SET quantity = quantity + :quantity WHERE id = :id";
            $updateStmt = $db->prepare($updateSql);
            $updateStmt->execute([
                'quantity' => $cartItem->getQuantity(),
                'id' => $existing['id']
            ]);
        } else {
            // If not, insert new row
            $insertSql = "INSERT INTO cart (user_email, product_id, quantity) VALUES (:user_email, :product_id, :quantity)";
            $insertStmt = $db->prepare($insertSql);
            $insertStmt->execute([
                'user_email' => $cartItem->getUserEmail(),
                'product_id' => $cartItem->getProductId(),
                'quantity' => $cartItem->getQuantity()
            ]);
        }
        return true;
    } 

   
    public function getCartWithProducts($user_email) {
        $db = config::getConnexion();
        $sql = "SELECT 
                    cart.id AS cart_id,
                    cart.product_id,
                    cart.quantity,
                    product.titre,
                    product.image,
                    product.prix_normale,
                    product.prix_promotion,
                    product.category
                FROM cart
                JOIN product ON cart.product_id = product.id
                WHERE cart.user_email = :user_email";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_email', $user_email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
    
    public function updateCart($cart_id, $quantity) {
        $db = config::getConnexion();
        $sql = "UPDATE cart SET quantity = :quantity WHERE id = :cart_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindValue(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->execute();
    } 

    public function removeFromCart($cart_id) {
        $db = config::getConnexion();
        $sql = "DELETE FROM cart WHERE id = :cart_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->execute();
    } 
    
}   
?>
