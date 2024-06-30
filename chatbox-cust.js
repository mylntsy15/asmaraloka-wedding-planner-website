const chatItems = document.querySelectorAll('.chat-item');
const chatInput = document.querySelector(".chat-input input");
const sendChatBtn = document.querySelector(".chat-input span");
const chatbox = document.querySelector(".chat-messages");

let userMessage;

const sender = "admin-chat";
const receiver = "cust-chat";

const createChatLi = (message, className) => {
    const chatLi = document.createElement("li");
    chatLi.classList.add("chat", className);

    chatLi.innerHTML`<p>${message}</p>`; 
    return chatLi;
};

const handleChat = () => {
    userMessage = chatInput.value.trim();
    if(!userMessage) return;

    chatbox.appendChild(createChatLi(userMessage, "outgoing"));
    chatInput.value = "";

    setTimeout(() => {
        chatbox.appendChild(createChatLi("Hello! How can we help you today?", "asmaraloka"));
        optionsContainer.style.display = "flex";
        chatbox.appendChild(optionsContainer);
    }, 600); 
}

sendChatBtn.addEventListener("click", handleChat);

optionsContainer.addEventListener("click", (event) => {
    const clickedElement = event.target;
    if (clickedElement.classList.contains("option")) {
        const selectedOption = clickedElement.getAttribute("data-option");
        const confirmationMessage = ` ${selectedOption}`;
        chatbox.appendChild(createChatLi(confirmationMessage, "outgoing"));
        optionsContainer.style.display = "none";
         
        if (selectedOption === "Refund") {
            setTimeout(() => {
                chatbox.appendChild(createChatLi("Connecting you to our admin for live chat.", "asmaraloka"));
            }, 600);
        } else if (selectedOption === "Return") {
            setTimeout(() => {
                chatbox.appendChild(createChatLi("Connecting you to our admin for live chat.", "asmaraloka"));
            }, 600);
        }

       
    }
});

chatbotToggler.addEventListener("click", () => {
    document.body.classList.toggle("show-chatbot");
});
