<?php
class Category {
    private $conn;
    private $table_name = "categories";

    public $id;
    public $name;
    public $description;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " (name, description) VALUES (:name, :description)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":name", $data['name']);
        $stmt->bindParam(":description", $data['description']);
        
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET name = :name, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $data['name']);
        $stmt->bindParam(":description", $data['description']);
        
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
