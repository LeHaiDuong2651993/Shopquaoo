<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $category_id;
    public $name;
    public $description;
    public $price;
    public $image;
    public $stock;
    public $created_at;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function readAll($limit = 100) {
        $query = "SELECT p.*, c.name as category_name 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  ORDER BY p.created_at DESC LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne($id) {
        $query = "SELECT p.*, c.name as category_name 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readByCategory($category_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE category_id = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $category_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($keywords) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE name LIKE ? OR description LIKE ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $search = "%{$keywords}%";
        $stmt->bindParam(1, $search);
        $stmt->bindParam(2, $search);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " (category_id, name, description, price, stock, image) VALUES (:category_id, :name, :description, :price, :stock, :image)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":category_id", $data['category_id']);
        $stmt->bindParam(":name", $data['name']);
        $stmt->bindParam(":description", $data['description']);
        $stmt->bindParam(":price", $data['price']);
        $stmt->bindParam(":stock", $data['stock']);
        $stmt->bindParam(":image", $data['image']);
        
        return $stmt->execute();
    }

    public function update($id, $data) {
        if (isset($data['image']) && $data['image'] !== '') {
            $query = "UPDATE " . $this->table_name . " SET category_id = :category_id, name = :name, description = :description, price = :price, stock = :stock, image = :image WHERE id = :id";
        } else {
            $query = "UPDATE " . $this->table_name . " SET category_id = :category_id, name = :name, description = :description, price = :price, stock = :stock WHERE id = :id";
        }
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":category_id", $data['category_id']);
        $stmt->bindParam(":name", $data['name']);
        $stmt->bindParam(":description", $data['description']);
        $stmt->bindParam(":price", $data['price']);
        $stmt->bindParam(":stock", $data['stock']);
        
        if (isset($data['image']) && $data['image'] !== '') {
            $stmt->bindParam(":image", $data['image']);
        }
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}
?>
