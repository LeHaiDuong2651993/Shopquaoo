    </main>

    <footer class="bg-white text-white pt-5 pb-3 mt-auto">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-shirt text-primary"></i> StyleShop</h5>
                    <p class="text-muted">Mang đến cho bạn những xu hướng thời trang mới nhất với chất lượng tuyệt vời và giá cả phải chăng.</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-light fs-5"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="text-light fs-5"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="text-light fs-5"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Danh Mục</h6>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-2"><a href="/shop_quan_ao/product/category/1" class="text-decoration-none text-muted link-primary">Áo thời trang</a></li>
                        <li class="mb-2"><a href="/shop_quan_ao/product/category/2" class="text-decoration-none text-muted link-primary">Quần thời trang</a></li>
                        <li class="mb-2"><a href="/shop_quan_ao/product/category/3" class="text-decoration-none text-muted link-primary">Váy nữ tính</a></li>
                        <li class="mb-2"><a href="/shop_quan_ao/product/category/4" class="text-decoration-none text-muted link-primary">Phụ kiện</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold mb-3">Liên Hệ</h6>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fa-solid fa-location-dot mt-1 me-3 text-primary"></i> 
                            <span>Chợ Phủ, Bình Giang, Hải Phòng</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fa-solid fa-phone me-3 text-primary"></i> 
                            <span>0947 824 689 (Hỗ trợ 24/7)</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fa-solid fa-envelope me-3 text-primary"></i>
                            <span style="word-break: break-all; overflow-wrap: break-word;">changkhothuychung2651993@gmail.com</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fa-solid fa-clock me-3 text-primary"></i> 
                            <span>Giờ làm việc: 8:00 - 22:00</span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h6 class="fw-bold mb-3">Bản Đồ Cửa Hàng</h6>
                    <div class="rounded overflow-hidden shadow-sm" style="height: 200px;">
                        <iframe src="https://maps.google.com/maps?q=Ch%E1%BB%A3%20Ph%E1%BB%A7,%20B%C3%ACnh%20Giang&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="text-center text-muted small">
                &copy; <?php echo date('Y'); ?> StyleShop. All rights reserved. Built with MVC PHP.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php 
$current_path = $_SERVER['REQUEST_URI'] ?? '';
$is_admin = strpos($current_path, '/admin') !== false;
if (!$is_admin): ?>

<!-- ===== CHATBOX WIDGET ===== -->
<style>
/* Floating Button */
#chatToggleBtn {
    position: fixed;
    bottom: 28px;
    right: 28px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1a1a1a 0%, #3a3a3a 100%);
    color: #fff;
    border: none;
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    font-size: 1.4rem;
    cursor: pointer;
    z-index: 9999;
    transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.3s;
    display: flex; align-items: center; justify-content: center;
}
#chatToggleBtn:hover { transform: scale(1.1); box-shadow: 0 12px 30px rgba(0,0,0,0.3); }
#chatToggleBtn .chat-badge {
    position: absolute; top: -2px; right: -2px;
    width: 18px; height: 18px; border-radius: 50%;
    background: #d4af37; border: 2px solid #fff;
    font-size: 0.6rem; display: flex; align-items: center; justify-content: center;
    font-weight: 700; color: #fff;
}

/* Chat Window */
#chatWindow {
    position: fixed;
    bottom: 100px;
    right: 28px;
    width: 370px;
    max-height: 560px;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.18);
    z-index: 9998;
    display: flex;
    flex-direction: column;
    transform: scale(0.85) translateY(20px);
    opacity: 0;
    pointer-events: none;
    transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
    transform-origin: bottom right;
    overflow: hidden;
}
#chatWindow.open {
    transform: scale(1) translateY(0);
    opacity: 1;
    pointer-events: all;
    visibility: visible;
}

/* Chat Header */
.chat-header {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    color: #fff;
    padding: 16px 20px;
    display: flex; align-items: center; gap: 12px;
    flex-shrink: 0;
}
.chat-avatar {
    width: 42px; height: 42px; border-radius: 50%;
    background: linear-gradient(135deg, #d4af37, #f0d060);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; flex-shrink: 0;
}
.chat-header-info h6 { margin: 0; font-weight: 700; font-size: 0.95rem; }
.chat-header-info span { font-size: 0.75rem; color: #a0a0a0; }
.chat-online-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: #22c55e; display: inline-block; margin-right: 4px;
    animation: pulse-dot 2s infinite;
}
@keyframes pulse-dot {
    0%,100% { opacity: 1; } 50% { opacity: 0.4; }
}
.chat-close-btn {
    margin-left: auto; background: none; border: none; color: #888;
    font-size: 1.1rem; cursor: pointer; padding: 4px; border-radius: 8px;
    transition: color 0.2s;
}
.chat-close-btn:hover { color: #fff; }

/* Messages Area */
#chatMessages {
    flex: 1; overflow-y: auto; padding: 16px;
    display: flex; flex-direction: column; gap: 12px;
    background: #f8fafc;
    scroll-behavior: smooth;
}
#chatMessages::-webkit-scrollbar { width: 4px; }
#chatMessages::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 4px; }

/* Message Bubbles */
.msg-bot, .msg-user { display: flex; gap: 8px; align-items: flex-end; }
.msg-user { flex-direction: row-reverse; }
.msg-avatar {
    width: 32px; height: 32px; border-radius: 50%;
    background: linear-gradient(135deg, #d4af37, #f0d060);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.8rem; flex-shrink: 0;
}
.bubble {
    max-width: 78%; padding: 10px 14px; border-radius: 16px;
    font-size: 0.875rem; line-height: 1.5;
}
.bubble-bot {
    background: #fff; color: #1a1a1a;
    border-radius: 16px 16px 16px 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.bubble-user {
    background: linear-gradient(135deg, #1a1a1a, #333);
    color: #fff;
    border-radius: 16px 16px 4px 16px;
}

/* Product Cards in Chat */
.chat-products {
    display: flex; flex-direction: column; gap: 8px; margin-top: 6px;
}
.chat-product-card {
    display: flex; align-items: center; gap: 10px;
    background: #fff; border: 1px solid #e2e8f0; border-radius: 12px;
    padding: 8px 10px; text-decoration: none; color: inherit;
    transition: all 0.2s; cursor: pointer;
}
.chat-product-card:hover {
    border-color: #d4af37; box-shadow: 0 4px 12px rgba(212,175,55,0.15);
    transform: translateY(-1px);
}
.chat-product-img {
    width: 44px; height: 44px; border-radius: 8px; object-fit: cover;
    background: #f1f5f9; flex-shrink: 0;
}
.chat-product-img-placeholder {
    width: 44px; height: 44px; border-radius: 8px; background: #f1f5f9;
    display: flex; align-items: center; justify-content: center;
    color: #94a3b8; font-size: 1.2rem; flex-shrink: 0;
}
.chat-product-name { font-size: 0.8rem; font-weight: 600; color: #1a1a1a; line-height: 1.3; }
.chat-product-price { font-size: 0.78rem; color: #d4af37; font-weight: 700; }

/* Typing indicator */
.typing-indicator {
    display: flex; gap: 4px; align-items: center; padding: 10px 14px;
    background: #fff; border-radius: 16px 16px 16px 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06); width: fit-content;
}
.typing-dot {
    width: 7px; height: 7px; border-radius: 50%; background: #94a3b8;
    animation: typing-bounce 1.2s infinite;
}
.typing-dot:nth-child(2) { animation-delay: 0.2s; }
.typing-dot:nth-child(3) { animation-delay: 0.4s; }
@keyframes typing-bounce {
    0%,60%,100% { transform: translateY(0); } 30% { transform: translateY(-6px); }
}

/* Quick Replies */
.quick-replies {
    display: flex; flex-wrap: wrap; gap: 6px;
    padding: 10px 16px 0;
    flex-shrink: 0;
}
.quick-reply-btn {
    background: #f1f5f9; border: 1px solid #e2e8f0;
    border-radius: 50px; padding: 5px 12px; font-size: 0.78rem;
    cursor: pointer; transition: all 0.2s; color: #475569; font-weight: 500;
    white-space: nowrap;
}
.quick-reply-btn:hover { background: #1a1a1a; color: #fff; border-color: #1a1a1a; }

/* Input Area */
.chat-input-area {
    display: flex; align-items: center; gap: 8px;
    padding: 12px 16px; border-top: 1px solid #f1f5f9; flex-shrink: 0;
    background: #fff;
}
#chatInput {
    flex: 1; border: 1px solid #e2e8f0; border-radius: 50px;
    padding: 9px 16px; font-size: 0.85rem; outline: none;
    transition: border-color 0.2s;
}
#chatInput:focus { border-color: #d4af37; }
#chatSendBtn {
    width: 38px; height: 38px; border-radius: 50%; border: none;
    background: linear-gradient(135deg, #1a1a1a, #333); color: #fff;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; flex-shrink: 0; transition: transform 0.2s;
}
#chatSendBtn:hover { transform: scale(1.1); }

@media (max-width: 480px) {
    #chatWindow { width: calc(100vw - 20px); right: 10px; }
    #chatToggleBtn { right: 16px; bottom: 16px; }
}
</style>

<!-- Toggle Button -->
<button id="chatToggleBtn" title="Chat với StyleShop" aria-label="Mở chat">
    <i class="fa-solid fa-comments" id="chatIcon"></i>
    <span class="chat-badge">1</span>
</button>

<!-- Chat Window -->
<div id="chatWindow" role="dialog" aria-label="Cửa sổ chat">
    <!-- Header -->
    <div class="chat-header">
        <div class="chat-avatar"><i class="fa-solid fa-shirt"></i></div>
        <div class="chat-header-info">
            <h6>StyleShop Assistant</h6>
            <span><span class="chat-online-dot"></span>Đang hoạt động</span>
        </div>
        <button class="chat-close-btn" id="chatCloseBtn" aria-label="Đóng chat">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <!-- Messages -->
    <div id="chatMessages">
        <div class="text-center text-muted py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Input -->
    <div class="chat-input-area">
        <input type="text" id="chatInput" placeholder="Nhập tin nhắn..." autocomplete="off">
        <button id="chatSendBtn" aria-label="Gửi">
            <i class="fa-solid fa-paper-plane" style="font-size:0.85rem;"></i>
        </button>
    </div>
</div>

<script>
(function() {
    'use strict';

    // Đợi DOM sẵn sàng
    document.addEventListener('DOMContentLoaded', function() {
        const chatWindow   = document.getElementById('chatWindow');
        const chatInput    = document.getElementById('chatInput');
        const chatMessages = document.getElementById('chatMessages');
        const chatBadge    = document.querySelector('.chat-badge');
        const chatToggleBtn = document.getElementById('chatToggleBtn');
        const chatCloseBtn  = document.getElementById('chatCloseBtn');
        const chatSendBtn   = document.getElementById('chatSendBtn');
        const chatIcon     = document.getElementById('chatIcon');
        let chatOpened = false;
        let isSending  = false;
        let currentConversationId = null;
        let refreshInterval = null;

        // Debug: Kiểm tra các element
        console.log('Chatbox elements:', {
            chatWindow,
            chatInput,
            chatMessages,
            chatToggleBtn,
            chatCloseBtn,
            chatSendBtn,
            chatIcon
        });

        if (!chatToggleBtn || !chatWindow) {
            console.error('Chatbox elements not found!');
            return;
        }

        // ─── Toggle open/close ──────────────────────────────────────────────
        function toggleChat() {
            console.log('Toggle chat called, current state:', chatOpened);
            chatOpened = !chatOpened;
            chatWindow.classList.toggle('open', chatOpened);
            chatIcon.className = chatOpened ? 'fa-solid fa-xmark' : 'fa-solid fa-comments';
            console.log('Chat window classes:', chatWindow.className);
            
            if (chatOpened) {
                if (chatBadge) chatBadge.style.display = 'none';
                setTimeout(() => chatInput.focus(), 300);
                loadConversation();
                startAutoRefresh();
            } else {
                stopAutoRefresh();
            }
        };

        // Gắn sự kiện click cho nút toggle
        chatToggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Toggle button clicked');
            toggleChat();
        });

        // Gắn sự kiện click cho nút đóng
        if (chatCloseBtn) {
            chatCloseBtn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Close button clicked');
                toggleChat();
            });
        }

        // ─── Helpers ────────────────────────────────────────────────────────
        function scrollToBottom() {
            setTimeout(() => { chatMessages.scrollTop = chatMessages.scrollHeight; }, 60);
        }

        function escapeHtml(str) {
            const d = document.createElement('div');
            d.appendChild(document.createTextNode(str || ''));
            return d.innerHTML;
        }

        // ─── Load conversation ──────────────────────────────────────────────
        function loadConversation() {
            console.log('Loading conversation...');
            chatMessages.innerHTML = '<div class="text-center py-3"><div class="spinner-border spinner-border-sm text-primary"></div></div>';
            
            fetch('/shop_quan_ao/public/api/chat_real.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'get_conversation' })
            })
            .then(res => res.json())
            .then(data => {
                console.log('Conversation data:', data);
                if (data.success) {
                    currentConversationId = data.conversation_id;
                    renderMessages(data.messages);
                } else {
                    chatMessages.innerHTML = '<div class="text-center text-danger py-3">Lỗi: ' + (data.error || 'Không thể tải cuộc trò chuyện') + '</div>';
                }
            })
            .catch(err => {
                console.error('Chat error:', err);
                chatMessages.innerHTML = '<div class="text-center text-danger py-3">Lỗi kết nối. Vui lòng thử lại.</div>';
            });
        }

        // ─── Render messages ────────────────────────────────────────────────
        function renderMessages(messages) {
            if (!messages || messages.length === 0) {
                chatMessages.innerHTML = `
                    <div class="msg-bot">
                        <div class="msg-avatar"><i class="fa-solid fa-headset" style="color:#1a1a1a;font-size:0.9rem;"></i></div>
                        <div class="bubble bubble-bot">
                            👋 Xin chào! Tôi là hỗ trợ viên của StyleShop.<br>
                            Tôi có thể giúp gì cho bạn hôm nay?
                        </div>
                    </div>
                `;
                return;
            }
            
            chatMessages.innerHTML = messages.map(msg => `
                <div class="${msg.sender_type === 'customer' ? 'msg-user' : 'msg-bot'}">
                    ${msg.sender_type === 'admin' ? '<div class="msg-avatar"><i class="fa-solid fa-headset" style="color:#1a1a1a;font-size:0.9rem;"></i></div>' : ''}
                    <div class="bubble ${msg.sender_type === 'customer' ? 'bubble-user' : 'bubble-bot'}">
                        ${escapeHtml(msg.message)}
                    </div>
                </div>
            `).join('');
            
            scrollToBottom();
        }

        // ─── Send message ────────────────────────────────────────────────────
        function sendMessage() {
            if (isSending) return;
            const text = chatInput.value.trim();
            if (!text) return;
            chatInput.value = '';
            isSending = true;

            // Show user message immediately
            const tempDiv = document.createElement('div');
            tempDiv.className = 'msg-user';
            tempDiv.innerHTML = `<div class="bubble bubble-user">${escapeHtml(text)}</div>`;
            chatMessages.appendChild(tempDiv);
            scrollToBottom();

            console.log('Sending message:', text);
            console.log('Current conversation ID:', currentConversationId);

            fetch('/shop_quan_ao/public/api/chat_real.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    action: 'send',
                    conversation_id: currentConversationId,
                    message: text,
                    sender_type: 'customer'
                })
            })
            .then(res => {
                console.log('Response status:', res.status);
                return res.json();
            })
            .then(data => {
                console.log('Send response:', data);
                if (data.success) {
                    currentConversationId = data.conversation_id;
                    console.log('Message sent successfully, conversation ID:', currentConversationId);
                    setTimeout(loadConversation, 500);
                } else {
                    console.error('Send failed:', data.error);
                    // Nếu API trả về lỗi nhưng tin nhắn đã được hiển thị, vẫn load lại conversation
                    // để kiểm tra xem tin nhắn thực sự đã được lưu chưa
                    setTimeout(loadConversation, 500);
                }
                isSending = false;
            })
            .catch(err => {
                console.error('Chat error:', err);
                // Không hiển thị alert, vẫn load lại conversation
                setTimeout(loadConversation, 500);
                isSending = false;
            });
        }

        // Gắn sự kiện Enter cho input
        if (chatInput) {
            chatInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });
        }

        // Gắn sự kiện click cho nút gửi
        if (chatSendBtn) {
            chatSendBtn.addEventListener('click', function(e) {
                e.preventDefault();
                sendMessage();
            });
        }

        // ─── Auto refresh ───────────────────────────────────────────────────
        function startAutoRefresh() {
            if (refreshInterval) clearInterval(refreshInterval);
            refreshInterval = setInterval(() => {
                if (chatOpened && currentConversationId) {
                    loadConversation();
                }
            }, 3000);
        }

        function stopAutoRefresh() {
            if (refreshInterval) {
                clearInterval(refreshInterval);
                refreshInterval = null;
            }
        }

        console.log('Chatbox initialized successfully');
    }); // end DOMContentLoaded
})();
</script>

<?php endif; ?>
</body>
</html>
