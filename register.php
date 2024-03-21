<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tomato";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

        // Validate email (you can enhance this validation)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
            exit();
        }
    
        // Validate password (you can enhance this validation)
        if (strlen($password) < 6) {
            echo "Password must be at least 6 characters";
            exit();
        }
    
        // Confirm password
        if ($password != $confirm_password) {
            echo "Passwords do not match";
            exit();
        }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        if ($stmt->execute()) {
            // Redirect to the login page after successful registration
            echo '<center><b><span style="color:green">Registration successful</span></b></center>';
            header("Location: dashboard.php");
            exit(); // Ensure no further code is executed after redirection
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }
    

    // Close the statement
    $stmt->close();
}

$conn->close();
?>
