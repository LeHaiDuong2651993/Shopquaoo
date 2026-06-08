<?php
require_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

try {
    // Create chat_conversations table
    $createConversations = "CREATE TABLE IF NOT EXISTS `chat_conversations` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) DEFAULT NULL,
      `customer_name` varchar(100) DEFAULT NULL,
      `customer_email` varchar(100) DEFAULT NULL,
      `status` enum('active','closed') DEFAULT 'active',
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
      PRIMARY KEY (`id`),
      KEY `user_id` (`user_id`),
      CONSTRAINT `chat_conversations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $conn->exec($createConversations);
    echo "Table chat_conversations: CREATED\n";
    
    // Create chat_messages table
    $createMessages = "CREATE TABLE IF NOT EXISTS `chat_messages` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `conversation_id` int(11) NOT NULL,
      `sender_type` enum('customer','admin') NOT NULL,
      `sender_id` int(11) DEFAULT NULL,
      `message` text NOT NULL,
      `is_read` tinyint(1) DEFAULT 0,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`),
      KEY `conversation_id` (`conversation_id`),
      CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `chat_conversations` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $conn->exec($createMessages);
    echo "Table chat_messages: CREATED\n";
    
    echo "\nChat tables created successfully!\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
