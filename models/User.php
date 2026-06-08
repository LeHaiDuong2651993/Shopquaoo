<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password;
    public $email;
    public $role;
    public $created_at;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            if (!empty($user['is_locked']) && $user['is_locked'] == 1) {
                return 'locked'; // Tài khoản bị khóa
            }
            return $user;
        }
        return false;
    }

    public function register($username, $password, $email) {
        // Check if exists
        $check_query = "SELECT id FROM " . $this->table_name . " WHERE username = ? OR email = ?";
        $stmt = $this->conn->prepare($check_query);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return false; // username or email already exists
        }

        $query = "INSERT INTO " . $this->table_name . " SET username=:username, password=:password, email=:email, role='user'";
        $stmt = $this->conn->prepare($query);

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":email", $email);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function getAllUsers() {
        $query = "SELECT id, username, email, role, is_locked, created_at FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lockUser($id) {
        $query = "UPDATE " . $this->table_name . " SET is_locked = 1 WHERE id = ? AND role != 'admin'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }

    public function unlockUser($id) {
        $query = "UPDATE " . $this->table_name . " SET is_locked = 0 WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}
?>
