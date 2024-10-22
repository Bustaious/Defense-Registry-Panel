// Function to display the popup message
function showPopupMessage(message, type) {
    // Create a new div element for the popup
    const popup = document.createElement("div");
    popup.className = "popup-message";

    // Set the message text and color based on the message type
    popup.textContent = message;
    if (type === "success") {
        popup.style.backgroundColor = "green";
    } else if (type === "error") {
        popup.style.backgroundColor = "red";
    }

    // Append the popup to the container
    const popupContainer = document.getElementById("popupContainer");
    popupContainer.appendChild(popup);

    // Set a timeout to remove the popup after a few seconds
    setTimeout(() => {
        popupContainer.removeChild(popup);
    }, 3000);
    const loginModal = document.getElementById("loginModal");
        loginModal.style.display = "none";
    // 3000 milliseconds (3 seconds) - adjust as needed
}

