<?php
// Test script to check if chat tables exist and API works
require_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

echo "<h2>Chat System Test</h2>";

// Check if tables exist
$tables_to_check = ['chat_conversations', 'chat_messages'];
foreach ($tables_to_check as $table) {
    $query = "SHOW TABLES LIKE '$table'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $exists = $stmt->rowCount() > 0;
    
    echo "<div>";
    echo "<strong>Table $table:</strong> ";
    echo $exists ? "<span style='color:green'>✓ EXISTS</span>" : "<span style='color:red'>✗ NOT FOUND</span>";
    echo "</div>";
}

// Test Chat model
echo "<h3>Testing Chat Model</h3>";
try {
    require_once 'models/Chat.php';
    $chatModel = new Chat();
    echo "<div style='color:green'>✓ Chat model loaded successfully</div>";
    
    // Test creating a conversation
    $conv_id = $chatModel->getOrCreateConversation(null, 'Test User', 'test@example.com');
    if ($conv_id) {
        echo "<div style='color:green'>✓ Created conversation ID: $conv_id</div>";
        
        // Test sending a message
        $msg_id = $chatModel->sendMessage($conv_id, 'customer', null, 'Test message');
        if ($msg_id) {
            echo "<div style='color:green'>✓ Sent message ID: $msg_id</div>";
            
            // Test getting messages
            $messages = $chatModel->getMessages($conv_id);
            echo "<div style='color:green'>✓ Retrieved " . count($messages) . " messages</div>";
        } else {
            echo "<div style='color:red'>✗ Failed to send message</div>";
            // Check error log
            echo "<div style='color:orange'>Check error log for details</div>";
            
            // Try direct SQL to debug
            try {
                $testQuery = "INSERT INTO chat_messages (conversation_id, sender_type, sender_id, message) VALUES (?, 'customer', NULL, 'Test message')";
                $testStmt = $conn->prepare($testQuery);
                $testStmt->bindParam(1, $conv_id);
                if ($testStmt->execute()) {
                    echo "<div style='color:green'>✓ Direct SQL insert works - issue with model</div>";
                } else {
                    echo "<div style='color:red'>✗ Direct SQL also failed</div>";
                    echo "<div style='color:orange'>Error info: " . implode(', ', $testStmt->errorInfo()) . "</div>";
                }
            } catch (Exception $e) {
                echo "<div style='color:red'>✗ Direct SQL error: " . $e->getMessage() . "</div>";
            }
        }
    } else {
        echo "<div style='color:red'>✗ Failed to create conversation</div>";
    }
} catch (Exception $e) {
    echo "<div style='color:red'>✗ Error: " . $e->getMessage() . "</div>";
}

echo "<h3>API Test</h3>";
echo "<p>Test the API at: <a href='/shop_quan_ao/public/api/chat_real.php' target='_blank'>/shop_quan_ao/public/api/chat_real.php</a></p>";
echo "<p>Send POST request with action 'get_conversation' to test</p>";
?>
