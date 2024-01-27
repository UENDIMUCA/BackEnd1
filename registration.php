<?php
// Include database connection file
include 'dbconn.php';  

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    

    try {
        // Check if the username or email already exists in the database
        $checkSql = "SELECT * FROM registration WHERE username = ? OR email = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->execute([$username, $email]);
        $existingUser = $checkStmt->fetch();

        if ($existingUser) {
            // If username or email already exists, return an error message
            $response = "Username or email already exists.";
        } else {
            // SQL query to insert data into the users table
            $sql = "INSERT INTO registration (username, email, password) VALUES (?, ?, ?)";

            // Prepare and execute the statement
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $email, $password]);

            $response = "Registration successful!";
            
            // Redirect to login page after successful registration
            header("Location: http://localhost/FrontEnd/login.html");
            exit(); // Terminate the script after redirection
        }
    } catch (PDOException $e) {
        $response = "Error: " . $e->getMessage();
    }

   
    echo $response;
}
?>
