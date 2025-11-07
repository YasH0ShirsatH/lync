<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat - Lync</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-500: #0ea5e9;
            --primary-600: #0284c7;
            --primary-700: #0369a1;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --success-500: #22c55e;
            --font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-family);
            background: var(--gray-50);
            height: 100vh;
            overflow: hidden;
        }

        .chat-container {
            display: flex;
            height: 100vh;
        }

        /* Left Sidebar - Users List */
        .users-sidebar {
            width: 320px;
            background: white;
            border-right: 1px solid var(--gray-200);
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            background: var(--primary-600);
            color: white;
        }

        .sidebar-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .sidebar-subtitle {
            font-size: 0.875rem;
            opacity: 0.9;
            margin-top: 0.25rem;
        }

        .users-list {
            flex: 1;
            overflow-y: auto;
            padding: 1rem 0;
        }

        .user-item {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .user-item:hover {
            background: var(--gray-50);
        }

        .user-item.active {
            background: var(--primary-50);
            border-left-color: var(--primary-600);
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: var(--primary-100);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-600);
            font-weight: 600;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            color: var(--gray-900);
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
            word-wrap: break-word
        }

        .user-status {
            font-size: 0.75rem;
            color: var(--gray-500);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--success-500);
        }

        .status-dot.offline {
            background: var(--gray-400);
        }

        /* Right Chat Area */
        .chat-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: white;
        }

        .chat-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            background: white;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .chat-user-avatar {
            width: 40px;
            height: 40px;
            background: var(--primary-100);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-600);
            font-weight: 600;
        }

        .chat-user-info h3 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0;
        }

        .chat-user-info p {
            font-size: 0.875rem;
            color: var(--gray-500);
            margin: 0;
        }

        /* Messages Area */
        .messages-area {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
            background: var(--gray-50);
        }

        .message {
            display: flex;
            margin-bottom: 1.5rem;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .message.sent {
            flex-direction: row-reverse;
        }

        .message-avatar {
            width: 32px;
            height: 32px;
            background: var(--gray-300);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        .message.sent .message-avatar {
            background: var(--primary-600);
        }

        .message-content {
            max-width: 70%;
        }

        .message-bubble {
            background: white;
            padding: 0.75rem 1rem;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            font-size: 0.875rem;
            line-height: 1.4;
        }

        .message.sent .message-bubble {
            background: var(--primary-600);
            color: white;
        }

        .message-time {
            font-size: 0.75rem;
            color: var(--gray-400);
            margin-top: 0.25rem;
            text-align: left;
        }

        .message.sent .message-time {
            text-align: right;
        }

        /* Message Input */
        .message-input-area {
            padding: 1.5rem;
            border-top: 1px solid var(--gray-200);
            background: white;
        }

        .input-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            border-radius: 2rem;
            padding: 0.5rem;
        }

        .message-input {
            flex: 1;
            border: none;
            background: transparent;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            outline: none;
            resize: none;
            max-height: 100px;
        }

        .send-button {
            width: 40px;
            height: 40px;
            background: var(--primary-600);
            border: none;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .send-button:hover {
            background: var(--primary-700);
            transform: scale(1.05);
        }

        .empty-chat {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--gray-500);
            text-align: center;
        }

        .empty-chat i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: var(--gray-300);
        }

        @media (max-width: 768px) {
            .users-sidebar {
                width: 280px;
            }

            .message-content {
                max-width: 85%;
            }
        }
    </style>
</head>

<body>
    <div class="chat-container">
        <!-- Left Sidebar - Users List -->
        <div class="users-sidebar">
            <div class="sidebar-header">
                <h2 class="sidebar-title">
                    @if(auth()->guard('student')->check())
                        Teachers
                    @else
                        Students
                    @endif
                </h2>
                <p class="sidebar-subtitle">Select a person to chat</p>
            </div>

            <div class="users-list">
                @foreach($users as $user)
                    <div class="user-item" data-user-id="{{$user->id}}">
                        <div class="user-avatar">{{substr($user->name, 0, 2)}}</div>
                        <div class="user-info">
                            <div class="user-name">{{$user->name}}</div>
                            <div class="user-status">
                                <span class="status-dot"></span>
                                Online
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        <!-- Right Chat Area -->
        <div class="chat-area">
            <div class="chat-header">
                <div class="chat-user-avatar">JD</div>
                <div class="chat-user-info">
                    <h3></h3>
                    <p></p>
                </div>
            </div>

            <div class="messages-area">
                <!-- Sample Messages -->
                <div class="message">
                    <div class="message-avatar"></div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Hello! I have a question about the assignment you posted yesterday.
                        </div>
                        <div class="message-time">10:30 AM</div>
                    </div>
                </div>

                <div class="message sent">
                    <div class="message-avatar">ME</div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Sure! What would you like to know?
                        </div>
                        <div class="message-time">10:32 AM</div>
                    </div>
                </div>

                <div class="message">
                    <div class="message-avatar">JD</div>
                    <div class="message-content">
                        <div class="message-bubble">
                            I'm having trouble understanding the requirements for question 3. Could you provide some clarification?
                        </div>
                        <div class="message-time">10:35 AM</div>
                    </div>
                </div>

                <div class="message sent">
                    <div class="message-avatar">ME</div>
                    <div class="message-content">
                        <div class="message-bubble">
                            Of course! Question 3 is asking you to analyze the data and provide your interpretation. You should focus on the trends and patterns you observe.
                        </div>
                        <div class="message-time">10:38 AM</div>
                    </div>
                </div>
            </div>

            <div class="message-input-area">
                <div class="input-container">
                    <textarea class="message-input" placeholder="Type your message..." rows="1"></textarea>
                    <button class="send-button">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Handle user selection with AJAX
        document.querySelectorAll('.user-item').forEach(item => {
            item.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');

                // Update active state
                document.querySelectorAll('.user-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');

                // Make AJAX call to controller
                fetch('/chat/user/' + userId, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Update chat header
                    document.querySelector('.chat-user-info h3').textContent = data.user.name;
                    document.querySelector('.chat-user-info p').textContent = data.user.email;
                    document.querySelector('.chat-user-avatar').textContent = data.user.name.substring(0, 2);

                    // Update messages area
                    document.querySelector('.messages-area').innerHTML = data.messages;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });

        // Auto-resize textarea
        const textarea = document.querySelector('.message-input');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 100) + 'px';
        });

        // Send message on Enter (without Shift)
        textarea.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                // Add send message logic here
                console.log('Send message:', this.value);
                this.value = '';
                this.style.height = 'auto';
            }
        });
    </script>
</body>
</html>
