<?php
class Order {
    private $conn;
    private $table_name = "orders";
    private $items_table = "order_items";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createOrder($user_id, $total_amount, $shipping_address, $phone, $note = '') {
        try {
            $query = "INSERT INTO " . $this->table_name . " 
                      (user_id, total_amount, status, shipping_address, phone, note, created_at) 
                      VALUES (?, ?, 'pending', ?, ?, ?, NOW())";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(1, $user_id);
            $stmt->bindParam(2, $total_amount);
            $stmt->bindParam(3, $shipping_address);
            $stmt->bindParam(4, $phone);
            $stmt->bindParam(5, $note);
            
            if ($stmt->execute()) {
                return $this->conn->lastInsertId();
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createOrderItem($order_id, $product_id, $quantity, $price) {
        try {
            $query = "INSERT INTO " . $this->items_table . " 
                      (order_id, product_id, quantity, price) 
                      VALUES (?, ?, ?, ?)";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(1, $order_id);
            $stmt->bindParam(2, $product_id);
            $stmt->bindParam(3, $quantity);
            $stmt->bindParam(4, $price);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getOrdersByUserId($user_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderItems($order_id) {
        $query = "SELECT oi.*, p.name as product_name, p.image 
                  FROM " . $this->items_table . " oi 
                  JOIN products p ON oi.product_id = p.id 
                  WHERE oi.order_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $order_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllOrders() {
        $query = "SELECT o.*, u.username, u.email 
                  FROM " . $this->table_name . " o
                  LEFT JOIN users u ON o.user_id = u.id
                  ORDER BY o.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($order_id, $status) {
        $query = "UPDATE " . $this->table_name . " SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $status);
        $stmt->bindParam(2, $order_id);
        return $stmt->execute();
    }
}
?>
