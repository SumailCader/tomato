<?php
header('Content-Type: application/json');

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'tomato';

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$score = $data['score'];

$userResult = $conn->query("SELECT id FROM users WHERE username = '$username'");
echo $userResult;
echo "CHECK";

if ($userResult->num_rows > 0) {
    echo "If true";
    $row = $userResult->fetch_assoc();
    $user_id = $row['id'];

    $sql = "INSERT INTO `scores` (user_id, username, score) VALUES ($user_id, '$username', $score)";
    
    if ($conn->query($sql) === TRUE) {
        $response = array('success' => true, 'message' => 'Score submitted successfully');
    } else {
        $response = array('success' => false, 'message' => 'Error submitting score: ' . $conn->error);
    }
} else {
    $response = array('success' => false, 'message' => 'User not found');
}

echo json_encode($response);

$conn->close();
?>
