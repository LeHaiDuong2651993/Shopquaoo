<?php
/**
 * Real-time Chat API Endpoint
 * Handles customer-admin chat messaging
 */
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

session_start();

// Load config & models
try {
    require_once '../../config/database.php';
    require_once '../../models/Chat.php';
    $chatModel = new Chat();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Failed to load: ' . $e->getMessage()]);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';

// Get user info from session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Khách';

switch ($action) {
    case 'send':
        // Send message
        $conversation_id = $input['conversation_id'] ?? null;
        $message = trim($input['message'] ?? '');
        $sender_type = $input['sender_type'] ?? 'customer';

        if (empty($message)) {
            echo json_encode(['success' => false, 'error' => 'Message cannot be empty']);
            exit;
        }

        // If no conversation_id, create new conversation
        if (!$conversation_id) {
            $conversation_id = $chatModel->getOrCreateConversation(
                $user_id,
                $sender_type === 'customer' ? $username : null,
                null
            );
        }

        if (!$conversation_id) {
            echo json_encode(['success' => false, 'error' => 'Failed to create conversation']);
            exit;
        }

        $sender_id = $sender_type === 'admin' ? $user_id : null;

        if ($chatModel->sendMessage($conversation_id, $sender_type, $sender_id, $message)) {
            echo json_encode(['success' => true, 'conversation_id' => $conversation_id]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to send message']);
        }
        break;
        
    case 'get_messages':
        // Get messages for a conversation
        $conversation_id = $input['conversation_id'] ?? null;
        
        if (!$conversation_id) {
            echo json_encode(['success' => false, 'error' => 'Conversation ID required']);
            exit;
        }
        
        $messages = $chatModel->getMessages($conversation_id);
        
        // Mark as read if admin is viewing
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            $chatModel->markAsRead($conversation_id, 'customer');
        }
        
        echo json_encode(['success' => true, 'messages' => $messages]);
        break;
        
    case 'get_conversation':
        // Get or create conversation for current user
        $conversation_id = $chatModel->getOrCreateConversation($user_id, $username, null);
        
        if ($conversation_id) {
            $messages = $chatModel->getMessages($conversation_id);
            echo json_encode(['success' => true, 'conversation_id' => $conversation_id, 'messages' => $messages]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to get conversation']);
        }
        break;
        
    case 'get_all_conversations':
        // Get all conversations (admin only)
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            echo json_encode(['success' => false, 'error' => 'Unauthorized']);
            exit;
        }
        
        $conversations = $chatModel->getAllConversations();
        echo json_encode(['success' => true, 'conversations' => $conversations]);
        break;
        
    case 'mark_read':
        // Mark messages as read
        $conversation_id = $input['conversation_id'] ?? null;
        $sender_type = $input['sender_type'] ?? 'customer';
        
        if ($conversation_id) {
            $chatModel->markAsRead($conversation_id, $sender_type);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Conversation ID required']);
        }
        break;
        
    case 'close':
        // Close conversation
        $conversation_id = $input['conversation_id'] ?? null;
        
        if (!$conversation_id) {
            echo json_encode(['success' => false, 'error' => 'Conversation ID required']);
            exit;
        }
        
        if ($chatModel->closeConversation($conversation_id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to close conversation']);
        }
        break;
        
    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action', 'received' => $action]);
        break;
}
