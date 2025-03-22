document.addEventListener("DOMContentLoaded", function () {
    const textarea = document.querySelector("textarea");
    const button = document.querySelector(".Input-Container button");
    const container = document.querySelector(".Input-Container");
    const chatContainer = document.querySelector(".Chat");

    function toggleButton() {
        if (textarea.value.trim() === "") {
            button.classList.add("disabled");
            setTimeout(() => (button.disabled = true), 300);
        } else {
            button.disabled = false;
            button.classList.remove("disabled");
        }
    }

    function adjustHeight() {
        textarea.style.height = "20px";
        const computedHeight = textarea.scrollHeight;
        const adjustedHeight = Math.min(computedHeight, 200);

        textarea.style.height = adjustedHeight + "px";
        container.style.height = adjustedHeight + 20 + "px";

        if (parseInt(container.style.height) > 200) {
            container.style.height = "200px";
            textarea.style.overflowY = "auto";
        } else {
            textarea.style.overflowY = "hidden";
        }
    }

    function sendMessage() {
        const message = textarea.value.trim();
        if (message === "") return;

        const messageElement = document.createElement("div");
        messageElement.classList.add("chat-message");
        messageElement.textContent = message;
        
        chatContainer.appendChild(messageElement);

        chatContainer.scrollTop = chatContainer.scrollHeight;

        textarea.value = "";
        toggleButton();
        adjustHeight();
    }

    button.addEventListener("click", sendMessage);
    textarea.addEventListener("input", () => {
        toggleButton();
        adjustHeight();
    });

    textarea.addEventListener("keydown", function (event) {
        if (event.key === "Enter" && !event.shiftKey) {
            event.preventDefault();
            sendMessage();
        }
    });

    toggleButton();
});