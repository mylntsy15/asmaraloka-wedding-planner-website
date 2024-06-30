const chatbotToggler = document.querySelector(".chatbot-toggler");
const chatInput = document.querySelector(".chat-input textarea");
const sendChatBtn = document.querySelector(".chat-input span");
const chatbox = document.querySelector(".chatbox");
const optionsContainer = document.getElementById("options-container");

let userMessage;
const sender = "customer";
    const receiver = "admin";
let lastMessageTimestamp = null;
let connectedToAdmin = false; // Flag to check if connected to admin
let fetchMessagesInterval = null;

const createChatLi = (message, className, isOption = false) => {
    const chatLi = document.createElement("li");
    chatLi.classList.add("chat", className);
    let chatContent = className === "cust-chat" 
        ? `<p>${message}</p>` 
        : `<span class="material-symbols-outlined">favorite</span><p>${message}</p>`;
    chatLi.innerHTML = chatContent;

    if (isOption) {
        chatLi.appendChild(optionsContainer);
        optionsContainer.style.display = "flex";
        optionsContainer.style.flexDirection = "column";
    }

    return chatLi;
};

const saveChatToLocalStorage = (sender, message) => {
    const chatHistory = JSON.parse(localStorage.getItem("chatHistory")) || [];
    chatHistory.push({ sender, message });
    localStorage.setItem("chatHistory", JSON.stringify(chatHistory));
};

const loadChatFromLocalStorage = () => {
    const chatHistory = JSON.parse(localStorage.getItem("chatHistory")) || [];
    chatHistory.forEach(chat => {
        const className = chat.sender === "bot" ? "admin-chat" : "cust-chat";
        chatbox.appendChild(createChatLi(chat.message, className));
    });
};

const handleChat = () => {
    userMessage = chatInput.value.trim();
    if (!userMessage) return;

    chatbox.appendChild(createChatLi(userMessage, "cust-chat"));
    chatInput.value = "";

    console.log("User message sent to server:", userMessage);

    $.post("save_messages.php", { sender: 'customer', receiver: "admin", message: userMessage }, function(data) {
        console.log("Response from server after user message:", data);
        
        if (!connectedToAdmin) {
            loadBotResponse();
        }

    }).fail(function(xhr, status, error) {
        console.error("Error sending user message:", status, error);
    });
}

const loadBotResponse = () => {
    const botMessage = "Hello! How can we help you today?";
    chatbox.appendChild(createChatLi(botMessage, "admin-chat", true));

    console.log("Bot message sent to server:", botMessage);

    $.post("save_messages.php", { sender: "bot", receiver: "customer", message: botMessage }, function(data) {
        console.log("Response from server after bot message:", data);
    }).fail(function(xhr, status, error) {
        console.error("Error sending bot message:", status, error);
    });
}

sendChatBtn.addEventListener("click", handleChat);

optionsContainer.addEventListener("click", (event) => {
    const clickedElement = event.target;
    if (clickedElement.classList.contains("option")) {
        const selectedOption = clickedElement.getAttribute("data-option");
        const confirmationMessage = `${selectedOption}`;

        chatbox.appendChild(createChatLi(confirmationMessage, "cust-chat"));
        optionsContainer.style.display = "none";

        console.log("User selected option sent to server:", selectedOption);

        $.post("save_messages.php", { sender: "customer", receiver: "admin", message: selectedOption }, function(data) {
            console.log("Response from server after option selection:", data);

            connectToAdmin(selectedOption);
            
        }).fail(function(xhr, status, error) {
            console.error("Error sending selected option:", status, error);
        });
    }
});

const connectToAdmin = (selectedOption) => {
    const connectMessage = `Connecting you to an admin for further assistance...`;
    chatbox.appendChild(createChatLi(connectMessage, "admin-chat"));
    connectedToAdmin = true; // Set the flag to true

    console.log("Connecting message sent to server:", connectMessage);

    $.post("save_messages.php", { sender: "bot", receiver: "customer", message: connectMessage }, function(data) {
        console.log("Response from server after connecting message:", data);
    
        fetchMessagesInterval = setInterval(fetchNewMessages, 3000); // Check for new messages every 3 seconds

    }).fail(function(xhr, status, error) {
        console.error("Error sending connecting message:", status, error);
    });
}

const fetchNewMessages = () => {
    $.ajax({
        url: "get_messages.php",
        type: "GET",
        data: { timestamp: lastMessageTimestamp }, // Send timestamp of the last message
        success: function(data) {
            const messages = JSON.parse(data);
            // Filter out messages sent by the admin
            const newMessages = messages.filter(({ sender }) => sender === receiver);
            // Only update chat if there are new messages
            if (newMessages.length > 0) {
                updateChat(newMessages);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching messages:", status, error);
        }
    });
};

const updateChat = (newMessages) => {
    newMessages.forEach(message => {
        chatbox.appendChild(createChatLi(message.message, "admin-chat"));
        lastMessageTimestamp = message.timestamp; // Update last message timestamp
    });
};

const loadChatHistory = () => {
    loadChatFromLocalStorage();
};

chatbotToggler.addEventListener("click", () => {
    if (document.body.classList.contains("show-chatbot")) {
        document.body.classList.remove("show-chatbot");
    } else {
        document.body.classList.add("show-chatbot");
        loadChatHistory();
    }
});

// Load chat history on page load
window.addEventListener("load", loadChatHistory);
