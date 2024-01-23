<!-- contact.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
        <!-- Contact Us Content -->
        <h2>Contact Us</h2>

        <!-- Contact Form -->
        <form action="contact.php" method="post">
            <label for="name">Your Name:</label>
            <input type="text" name="name" required><br>

            <label for="email">Your Email:</label>
            <input type="email" name="email" required><br>

            <label for="message">Your Message:</label>
            <textarea name="message" rows="4" required></textarea><br>

            <input type="submit" value="Submit">
        </form>

        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $name = $_POST["name"];
            $email = $_POST["email"];
            $message = $_POST["message"];

            // Perform basic validation (you might want to enhance this)
            if (empty($name) || empty($email) || empty($message)) {
                echo "Please fill in all the fields.";
            } else {
                // You can handle the submitted data as needed (e.g., send an email, save to a database)
                echo "Thank you for your message, $name! We will get back to you soon.";
            }
        }
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
