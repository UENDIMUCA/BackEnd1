<?php
// Include database connection file
include 'dbconn.php';  

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $email = $_POST['email'];
    $password = $_POST['password'];


    try {
        // SQL query to check if the user exists with the given email and password
        $sql = "SELECT * FROM registration  WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email, $password]);

        // Check if a user was found
        if ($stmt->rowCount() > 0) {
            // User found, log in successful
            echo "Login successful!";
        } else {
            // No matching user found
            echo "Invalid email or password";
        }
    } catch (PDOException $e) {
        // Handle any database errors
        echo "Error: " . $e->getMessage();
    }
}
?>