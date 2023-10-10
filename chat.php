<!-- chat.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chat</title>
    <style>
        #chat-container {
            width: 400px;
            margin: 0 auto;
        }
        #chat-messages {
            border: 1px solid #ccc;
            height: 300px;
            overflow-y: scroll;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div id="chat-container">
        <div id="chat-messages"></div>
        <input type="text" id="message-input" placeholder="Type your message...">
        <button id="send-button">Send</button>
    </div>
    
    <script>
        const chatMessages = document.getElementById("chat-messages");
        const messageInput = document.getElementById("message-input");
        const sendButton = document.getElementById("send-button");

        // Function to add a message to the chat
        function addMessage(message) {
            const messageElement = document.createElement("p");
            messageElement.textContent = message;
            chatMessages.appendChild(messageElement);
        }

        // Send a message when the Send button is clicked
        sendButton.addEventListener("click", () => {
            const message = messageInput.value.trim();
            if (message !== "") {
                addMessage(`You: ${message}`);
                // Simulate receiving a response from the other user
                setTimeout(() => {
                    addMessage(`User2: Response to ${message}`);
                }, 1000);
                messageInput.value = "";
            }
        });

        // Simulate receiving a message from the other user
        setTimeout(() => {
            addMessage("User2: Hello!");
        }, 2000);
    </script>
</body>
</html>
