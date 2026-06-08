<?php
// Script to add is_locked column to users table - run this in browser
require_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

try {
    // Check if column already exists
    $checkQuery = "SHOW COLUMNS FROM users LIKE 'is_locked'";
    $stmt = $conn->prepare($checkQuery);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo "<h2>Column 'is_locked' already exists in users table</h2>";
    } else {
        // Add the column
        $alterQuery = "ALTER TABLE users ADD COLUMN is_locked TINYINT(1) DEFAULT 0 AFTER role";
        $stmt = $conn->prepare($alterQuery);
        $stmt->execute();
        
        echo "<h2>Column 'is_locked' added successfully to users table</h2>";
    }
    
    echo "<p><a href='/shop_quan_ao/admin'>Go to Admin Page</a></p>";
    
} catch (PDOException $e) {
    echo "<h2>Error: " . $e->getMessage() . "</h2>";
}
?>
