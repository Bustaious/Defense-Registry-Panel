
function handleLoginFormSubmission(event) {
  event.preventDefault();

  const form = event.target;
  const formData = new FormData(form);

  fetch('userlog.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Successful login, redirect to the desired page
        window.location.href = 'users.html';
      } else {
        // Failed login, show the error message to the user
        const messageElement = document.getElementById('modalMessageModal');
        messageElement.textContent = data.message || 'An error occurred during login. Please try again.';
      }
    })
    .catch(error => {
      console.error('Login error:', error);
    });
}

document.getElementById('loginFormModal').addEventListener('submit', handleLoginFormSubmission);
