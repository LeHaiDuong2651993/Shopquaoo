<?php
require_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

echo "Checking chat tables...\n\n";

$tables_to_check = ['chat_conversations', 'chat_messages'];
foreach ($tables_to_check as $table) {
    $query = "SHOW TABLES LIKE '$table'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $exists = $stmt->rowCount() > 0;
    
    echo "Table $table: " . ($exists ? "EXISTS ✓" : "NOT FOUND ✗") . "\n";
}

echo "\nDone.\n";
