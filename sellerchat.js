document.addEventListener("DOMContentLoaded", function() {
    const chatbox = document.querySelector(".chat-messages");
    const chatInput = document.querySelector(".chat-input input");
    const sendChatBtn = document.querySelector(".chat-input #send-btn");

    const sender = "admin";
    const receiver = "customer";
    let lastMessageTimestamp = null;

    const createChatLi = (message, className, senderName, timestamp) => {
        const chatLi = document.createElement("li");
        chatLi.classList.add(className);
        const formattedTime = new Date(timestamp).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });

        if (className === "admin-chat") {
            chatLi.innerHTML = `<p>${message}</p><span class="time-admin">${formattedTime}</span>`;
        } else {
            chatLi.innerHTML = `<span class="sender-name">${senderName}</span><p>${message}</p><span class="time-customer">${formattedTime}</span>`;
        }

        return chatLi;
    };

    const updateChat = (messages) => {
        messages.forEach(({ sender, message, timestamp }) => {
            if (sender === receiver) {
                const className = "cust-chat";
                const senderName = "Customer";
                chatbox.appendChild(createChatLi(message, className, senderName, timestamp));
            }
        });
        chatbox.scrollTop = chatbox.scrollHeight; 
    };

    
    const fetchMessages = () => {
        $.ajax({
            url: "get_messages.php",
            type: "GET",
            data: { timestamp: lastMessageTimestamp }, 
            success: function(data) {
                const messages = JSON.parse(data);
                if (messages.length > 0) {
                    updateChat(messages);
                    lastMessageTimestamp = messages[messages.length - 1].timestamp; 
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching messages:", status, error);
            }
        });
    };

    
    fetchMessages();

    
    setInterval(fetchMessages, 3000); 

    
    const handleChat = () => {
        const adminMessage = chatInput.value.trim();
        if (!adminMessage) return;

        const timestamp = new Date().toISOString();
        chatbox.appendChild(createChatLi(adminMessage, "admin-chat", "Admin", timestamp));
        chatInput.value = "";
        chatbox.scrollTop = chatbox.scrollHeight;

        console.log("Admin message sent to server:", adminMessage);

        $.post("save_messages.php", { sender, receiver, message: adminMessage, timestamp }, function(data) {
            console.log("Response from server after admin message:", data);
        }).fail(function(xhr, status, error) {
            console.error("Error sending admin message:", status, error);
        });
    };

    sendChatBtn.addEventListener("click", handleChat);
});
