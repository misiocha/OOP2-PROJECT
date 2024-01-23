<?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $country = mysqli_real_escape_string($conn, $_POST["country"]);

    // Perform basic validation (you might want to enhance this)
    if (empty($username) || empty($password) || empty($email) || empty($country)) {
        echo "Please fill in all the fields.";
    } else {
        // Hash the password (for security)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database using prepared statement
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, country) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $hashed_password, $email, $country);

        if ($stmt->execute()) {
            // Provide feedback to the user
            echo "Registration successful! You will be redirected to the login page shortly...";
            
            // Redirect to the login page after a short delay
            header("refresh:2; url=login.html");
            exit();
        } else {
            // Log the error and display a user-friendly message
            error_log("Error: " . $stmt->error);
            echo "Registration failed. Please contact support for assistance.";
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>
