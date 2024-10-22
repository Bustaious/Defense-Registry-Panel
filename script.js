// script.js

// Function to fetch user activity statistics using AJAX
function fetchUserActivityStats() {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure the AJAX request
    xhr.open('GET', 'stats.php', true);

    // Set the callback function to handle the AJAX response
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            // Parse the JSON response
            var response = JSON.parse(xhr.responseText);

            // Update the content in the <div class="user-activity"> section
            document.getElementById('total-users').innerText = response.total_users;
            document.getElementById('active-users').innerText = response.active_users;
            document.getElementById('inactive-users').innerText = response.inactive_users;
        } else {
            console.log('Error fetching user activity statistics.');
        }
    };

    // Handle AJAX errors
    xhr.onerror = function () {
        console.log('Error fetching user activity statistics.');
    };

    // Send the AJAX request
    xhr.send();
}

// Call the fetchUserActivityStats function when the page loads
window.onload = function () {
    fetchUserActivityStats();
};
