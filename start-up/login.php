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
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform basic validation (you might want to enhance this)
    if (empty($username) || empty($password)) {
        echo "Please fill in all the fields.";
    } else {
        // Check the user in the database
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                // Provide feedback to the user
                echo "Login successful! Redirecting to home page...";
                // Redirect to the home page after a short delay
                header("refresh:2; url=home.php");
                exit();
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "User not found.";
        }
    }
}

// Close the database connection
$conn->close();
?>
