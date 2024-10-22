document.addEventListener("DOMContentLoaded", function () {
    const showPopupButton = document.getElementById("showPopupButton");
    const closePopupButton = document.getElementById("closePopupButton");
    const popupModal = document.getElementById("popupModal");
    const popupContent = document.getElementById("popupContent");


    function showPopup(response, type) {
        popupContent.innerText = response;
        popupModal.style.display = "block";

        
        if (type === "error") {
            setTimeout(function () {
                
                window.location.href = "users.html";
            }, 3000); 
        }
    }

    
    function closePopup() {
        popupModal.style.display = "none";
    }

    showPopupButton.addEventListener("click", function () {
        
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "your-php-script.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
               
                const response = JSON.parse(xhr.responseText);
                showPopup(response.message, response.type);
            }
        };
        xhr.send();

        
    });

    
    closePopupButton.addEventListener("click", closePopup);
});
