var responseObject = JSON.parse(response);

if (responseObject.type === "success") {
    // Handle success message
    console.log("Success: " + responseObject.message);
} else if (responseObject.type === "error") {
    // Handle error message
    console.error("Error: " + responseObject.message);
}