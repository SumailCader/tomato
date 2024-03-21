<?php
session_start();

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'tomato';

// Create a MySQL connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT id, username, password FROM users WHERE LOWER(username) = LOWER(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify the password using password_verify
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php"); // Redirect to a dashboard or home page
            exit();
        } else {
            echo "Invalid password";
        }
    } elseif ($result->num_rows > 1) {
        echo "Multiple users found"; // More than one user with the same username
    } else {
        echo "Invalid username"; // No user found with the given username
    }

    $stmt->close();
}

$conn->close();
?>
