document.getElementById("loginFormModal").addEventListener("submit", function (event) {
  event.preventDefault();
  
  const form = event.target;
  const formData = new FormData(form);

  fetch('userlog.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      console.log("Server response:", data); // Add this line for debugging
      
      if (data.success) {
        // Admin is authenticated, show success message in modal
        console.log("Login successful!"); // Add this line for debugging
        
        showPopupMessageModal("Login Successful!");

        // Close the login modal
        closeLoginModal();
        clearLoginForm();
      } else {
        console.log("Login failed:", data.message); // Add this line for debugging
        
        showPopupMessageModal(data.message || 'An error occurred during login. Please try again.');
      }
    })
    .catch(error => {
      console.error('Login error:', error);
    });
});
