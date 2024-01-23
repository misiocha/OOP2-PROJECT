<!-- admin.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- Add other head elements as needed -->
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="admin.php">Admin Panel</a></li>
            </ul>
        </nav>
    </header>

    <div class="card-container">
        <!-- Admin Panel Content -->
        <h2>Welcome to the Admin Panel!</h2>

        <!-- Add New User Form -->
        <h3>Add New User</h3>
        <form action="admin.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <label for="country">Country:</label>
            <input type="text" name="country" required><br>

            <input type="submit" value="Add User">
        </form>

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

                // Insert new user data into the database using prepared statement
                $stmt = $conn->prepare("INSERT INTO users (username, password, email, country) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $username, $hashed_password, $email, $country);

                if ($stmt->execute()) {
                    echo "User added successfully!";
                } else {
                    error_log("Error: " . $stmt->error);
                    echo "Failed to add user. Please try again later.";
                }

                $stmt->close();
            }
        }

        // Close the database connection
        $conn->close();
        ?>

        <footer>
            <p>&copy; 2024 Laptop Store. All rights reserved.</p>
        </footer>
    </div>

    <script>
        // Your existing JavaScript code
    </script>
</body>
</html>
