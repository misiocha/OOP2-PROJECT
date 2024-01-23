<?php

class User
{
    private $username;
    private $password;
    private $email;
    private $country;

    public function __construct($username, $password, $email, $country)
    {
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->email = $email;
        $this->country = $country;
    }

    public function saveToDatabase($conn)
    {
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, country) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $this->username, $this->password, $this->email, $this->country);

        return $stmt->execute();
    }
}
?>
