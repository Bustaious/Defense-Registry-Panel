// Get references to the button and login section
const showLoginBtn = document.getElementById('showLoginBtn');
const loginSection = document.getElementById('login');

// Add event listener to the button to toggle the login section
showLoginBtn.addEventListener('click', function () {
    // Toggle the visibility of the login section
    if (loginSection.style.display === 'none') {
        loginSection.style.display = 'block';
    } else {
        loginSection.style.display = 'none';
    }
});