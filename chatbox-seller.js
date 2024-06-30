const chatItems = document.querySelectorAll('.chat-item');
const chatInput = document.querySelector(".chat-input input");
const sendChatBtn = document.querySelector(".chat-input span");
const chatbox = document.querySelector(".chat-messages");


const sender = "Admin";
let receiver = "Customer 1";

const createChatLi = (message, className) => {
    const chatLi = document.createElement("li");
    chatLi.classList.add(className);
    chatLi.innerHTML = `<p>${message}</p>`;
    return chatLi;
};

const handleChat = () => {
    const message = chatInput.value.trim();
    if(!message) return;

    chatbox.appendChild(createChatLi(message, "admin-chat"));
    chatInput.value = "";

    $.post("save_message.php", { sender, receiver, message }, function(data) {
        console.log(data);
        loadMessages();
    });
}

sendChatBtn.addEventListener("click", handleChat);

chatItems.forEach(item => {
    item.addEventListener("click", () => {
        chatItems.forEach(i => i.classList.remove('active'));
        item.classList.add('active');
        receiver = item.textContent.trim();
        loadMessages();
    });
});

const loadMessages = () => {
    $.get("get_messages.php", function(data) {
        const messages = JSON.parse(data);
        chatbox.innerHTML = '';
        messages.forEach(message => {
            const className = message.sender === sender ? "admin-chat" : "customer-chat";
            chatbox.appendChild(createChatLi(message.message, className));
        });
    });
}

loadMessages();
setInterval(loadMessages, 3000); 
function showCustomerChat(customer) {
    const chatItems = document.querySelectorAll('.chat-item');
    chatItems.forEach(item => {
        item.classList.remove('active');
    });
    
    const clickedItem = document.querySelector(`.${customer}-chat`);
    clickedItem.classList.add('active');
}


function showCustomerChat(customer) {
    const chatMessages = document.querySelectorAll('.chat-messages > li');
    chatMessages.forEach(message => {
        message.style.display = 'none';
    });
    
    const customerChat = document.querySelector(`.${customer}-chat`);
    if (customerChat) {
        customerChat.style.display = 'block';
    }
}