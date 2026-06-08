<?php require_once 'views/layouts/header.php'; ?>

<div class="container-fluid mb-5">
    <div class="row">
        <?php require_once 'views/layouts/admin_sidebar.php'; ?>

        <!-- Admin Content -->
        <div class="col-md-9 col-lg-9 ms-sm-auto px-md-4 mt-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h2 class="fw-bold">Quản Lý Chat</h2>
            </div>

            <div class="card stat-card bg-white">
                <div class="card-body p-0">
                    <div class="row g-0" style="height: 600px;">
                        <!-- Conversations List -->
                        <div class="col-md-4 border-end" style="height: 100%;">
                            <div class="p-3 border-bottom bg-light">
                                <h6 class="fw-bold mb-0">Danh sách cuộc trò chuyện</h6>
                            </div>
                            <div class="overflow-auto" style="height: calc(100% - 50px);" id="conversationsList">
                                <div class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chat Window -->
                        <div class="col-md-8" style="height: 100%;">
                            <div class="p-3 border-bottom bg-light d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold mb-0" id="chatTitle">Chọn cuộc trò chuyện</h6>
                                <button class="btn btn-sm btn-outline-danger d-none" id="closeChatBtn" onclick="closeConversation()">
                                    <i class="fa-solid fa-xmark"></i> Đóng
                                </button>
                            </div>
                            <div class="overflow-auto p-3" style="height: calc(100% - 120px);" id="chatMessages">
                                <div class="text-center text-muted py-5">
                                    <i class="fa-solid fa-comments fa-3x mb-3"></i>
                                    <p>Chọn một cuộc trò chuyện để bắt đầu</p>
                                </div>
                            </div>
                            <div class="p-3 border-top bg-light d-none" id="chatInputArea">
                                <div class="input-group">
                                    <input type="text" id="adminChatInput" class="form-control" placeholder="Nhập tin nhắn..." onkeypress="if(event.key==='Enter') sendAdminMessage()">
                                    <button class="btn btn-primary" onclick="sendAdminMessage()">
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.message-bubble {
    max-width: 70%;
    padding: 10px 15px;
    border-radius: 15px;
    margin-bottom: 10px;
    word-wrap: break-word;
}
.message-customer {
    background: #f1f5f9;
    color: #1a1a1a;
    border-radius: 15px 15px 15px 0;
}
.message-admin {
    background: #1a1a1a;
    color: #fff;
    border-radius: 15px 15px 0 15px;
    margin-left: auto;
}
.conversation-item {
    padding: 12px 15px;
    border-bottom: 1px solid #e2e8f0;
    cursor: pointer;
    transition: background 0.2s;
}
.conversation-item:hover {
    background: #f8fafc;
}
.conversation-item.active {
    background: #e2e8f0;
}
.conversation-item.unread {
    background: #fef3c7;
}
</style>

<script>
let currentConversationId = null;
let refreshInterval = null;

// Load conversations
function loadConversations() {
    fetch('/shop_quan_ao/public/api/chat_real.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'get_all_conversations' })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            renderConversations(data.conversations);
        }
    });
}

// Render conversations list
function renderConversations(conversations) {
    const container = document.getElementById('conversationsList');
    if (conversations.length === 0) {
        container.innerHTML = '<div class="text-center py-4 text-muted">Chưa có cuộc trò chuyện nào</div>';
        return;
    }
    
    container.innerHTML = conversations.map(conv => `
        <div class="conversation-item ${conv.unread_count > 0 ? 'unread' : ''} ${currentConversationId === conv.id ? 'active' : ''}" 
             onclick="selectConversation(${conv.id})">
            <div class="d-flex justify-content-between align-items-start">
                <div class="flex-grow-1">
                    <div class="fw-bold">${conv.customer_name || 'Khách vãng lai'}</div>
                    <div class="small text-muted">${conv.customer_email || ''}</div>
                    <div class="small text-truncate" style="max-width: 200px;">${conv.last_message || 'Chưa có tin nhắn'}</div>
                </div>
                <div class="text-end">
                    ${conv.unread_count > 0 ? `<span class="badge bg-danger rounded-pill">${conv.unread_count}</span>` : ''}
                    <div class="small text-muted">${conv.last_message_time ? new Date(conv.last_message_time).toLocaleTimeString() : ''}</div>
                </div>
            </div>
        </div>
    `).join('');
}

// Select conversation
function selectConversation(conversationId) {
    currentConversationId = conversationId;
    document.getElementById('chatInputArea').classList.remove('d-none');
    document.getElementById('closeChatBtn').classList.remove('d-none');
    
    // Get conversation details
    fetch('/shop_quan_ao/public/api/chat_real.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'get_messages', conversation_id: conversationId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            renderMessages(data.messages);
            loadConversations(); // Refresh to update unread count
        }
    });
    
    // Update title
    const conv = document.querySelector(`.conversation-item[onclick="selectConversation(${conversationId})"]`);
    if (conv) {
        const name = conv.querySelector('.fw-bold').textContent;
        document.getElementById('chatTitle').textContent = name;
    }
}

// Render messages
function renderMessages(messages) {
    const container = document.getElementById('chatMessages');
    if (messages.length === 0) {
        container.innerHTML = '<div class="text-center text-muted py-5">Chưa có tin nhắn nào</div>';
        return;
    }
    
    container.innerHTML = messages.map(msg => `
        <div class="message-bubble ${msg.sender_type === 'admin' ? 'message-admin' : 'message-customer'}">
            <div>${msg.message}</div>
            <div class="small text-muted" style="font-size: 0.75rem;">${new Date(msg.created_at).toLocaleString()}</div>
        </div>
    `).join('');
    
    container.scrollTop = container.scrollHeight;
}

// Send admin message
function sendAdminMessage() {
    const input = document.getElementById('adminChatInput');
    const message = input.value.trim();
    
    if (!message || !currentConversationId) return;
    
    fetch('/shop_quan_ao/public/api/chat_real.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            action: 'send',
            conversation_id: currentConversationId,
            message: message,
            sender_type: 'admin'
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            input.value = '';
            selectConversation(currentConversationId);
        }
    });
}

// Close conversation
function closeConversation() {
    if (!currentConversationId) return;
    
    if (confirm('Bạn có chắc muốn đóng cuộc trò chuyện này?')) {
        fetch('/shop_quan_ao/public/api/chat_real.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                action: 'close',
                conversation_id: currentConversationId
            })
        })
        .then(() => {
            currentConversationId = null;
            document.getElementById('chatInputArea').classList.add('d-none');
            document.getElementById('closeChatBtn').classList.add('d-none');
            document.getElementById('chatTitle').textContent = 'Chọn cuộc trò chuyện';
            document.getElementById('chatMessages').innerHTML = `
                <div class="text-center text-muted py-5">
                    <i class="fa-solid fa-comments fa-3x mb-3"></i>
                    <p>Chọn một cuộc trò chuyện để bắt đầu</p>
                </div>
            `;
            loadConversations();
        });
    }
}

// Auto refresh
function startAutoRefresh() {
    refreshInterval = setInterval(() => {
        loadConversations();
        if (currentConversationId) {
            selectConversation(currentConversationId);
        }
    }, 3000);
}

// Initialize
loadConversations();
startAutoRefresh();
</script>

<?php require_once 'views/layouts/footer.php'; ?>
