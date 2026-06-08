<?php
class Chat {
    private $conn;
    private $conv_table = "chat_conversations";
    private $msg_table = "chat_messages";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Get or create conversation for a user
    public function getOrCreateConversation($user_id = null, $customer_name = null, $customer_email = null) {
        if ($user_id) {
            // Check if conversation exists for this user
            $query = "SELECT * FROM " . $this->conv_table . " WHERE user_id = ? AND status = 'active' ORDER BY created_at DESC LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $user_id);
            $stmt->execute();
            $conv = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($conv) {
                return $conv['id'];
            }
        }

        // Create new conversation
        $query = "INSERT INTO " . $this->conv_table . " (user_id, customer_name, customer_email) VALUES (:user_id, :customer_name, :customer_email)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':customer_email', $customer_email);
        
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // Send message
    public function sendMessage($conversation_id, $sender_type, $sender_id, $message) {
        try {
            // Use the same approach as the working test script
            $query = "INSERT INTO " . $this->msg_table . " (conversation_id, sender_type, sender_id, message) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $conversation_id);
            $stmt->bindParam(2, $sender_type);
            $stmt->bindParam(3, $sender_id);
            $stmt->bindParam(4, $message);
            
            if ($stmt->execute()) {
                // Update conversation timestamp
                $updateQuery = "UPDATE " . $this->conv_table . " SET updated_at = NOW() WHERE id = ?";
                $updateStmt = $this->conn->prepare($updateQuery);
                $updateStmt->bindParam(1, $conversation_id);
                $updateStmt->execute();
                
                return $this->conn->lastInsertId();
            }
            return false;
        } catch (PDOException $e) {
            error_log("Chat sendMessage error: " . $e->getMessage());
            return false;
        }
    }

    // Get messages for a conversation
    public function getMessages($conversation_id, $limit = 50) {
        $query = "SELECT * FROM " . $this->msg_table . " WHERE conversation_id = ? ORDER BY created_at ASC LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $conversation_id);
        $stmt->bindParam(2, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get all conversations for admin
    public function getAllConversations() {
        $query = "SELECT c.*, 
                  (SELECT COUNT(*) FROM " . $this->msg_table . " WHERE conversation_id = c.id AND sender_type = 'customer' AND is_read = 0) as unread_count,
                  (SELECT message FROM " . $this->msg_table . " WHERE conversation_id = c.id ORDER BY created_at DESC LIMIT 1) as last_message,
                  (SELECT created_at FROM " . $this->msg_table . " WHERE conversation_id = c.id ORDER BY created_at DESC LIMIT 1) as last_message_time
                  FROM " . $this->conv_table . " c 
                  WHERE c.status = 'active' 
                  ORDER BY c.updated_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mark messages as read
    public function markAsRead($conversation_id, $sender_type) {
        $query = "UPDATE " . $this->msg_table . " SET is_read = 1 WHERE conversation_id = ? AND sender_type = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $conversation_id);
        $stmt->bindParam(2, $sender_type);
        return $stmt->execute();
    }

    // Get conversation by ID
    public function getConversation($conversation_id) {
        $query = "SELECT * FROM " . $this->conv_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $conversation_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Close conversation
    public function closeConversation($conversation_id) {
        $query = "UPDATE " . $this->conv_table . " SET status = 'closed' WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $conversation_id);
        return $stmt->execute();
    }
}
?>
