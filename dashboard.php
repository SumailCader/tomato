<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); // Redirect to the login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomato Game - Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            font-size: 80px;
            margin: 0 0 20px;
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: rgba(255, 0, 0, 0.295);
            
            color: #fff;
            text-align: center;
            padding: 20px 0;
            font-size: 24px;
        }

        .container {
            text-align: center;
            margin: 20px;
        }

        .welcome-message {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .logout-link {
            display: block;
            text-align: center;
            font-size: 16px;
            color: #3498db;
            text-decoration: none;
        }

        .logout-link:hover {
            color: #2980b9;
        }

        .nav-link {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #007bff52;
            color: #fff;
            text-decoration: none;
            font-size:x-large;
            border-radius: 4px;
            size: 100px;
        }
        
        .log {
            align: center;
            size: 250px;
        }

        .nav-link:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body background="image/Back.png">
    <div class="header">
        <h1>Welcome to the Tomato Game </h1>
    </div>
    <div class="container">
        <div class="welcome-message">
            <p>Hello,
                <?php echo $_SESSION['username']; ?>!
            </p>
        </div>
        <button><a class="nav-link" href="Easy.html" onclick="changeLocation()">
            <img src="image/newgame.jpg" width="300px" height="200px"><br>New Games</a></button>
        <button><a class="nav-link" href="High Scores.html">
            <img src="image/High.jpg" width="300px" height="200px"><br>High Scores</a></button>
        <button><a class="nav-link" onclick="changeLevel()">
            <img src="image/Levels.png" width="300px" height="200px"><br>Levels</a></button>    
        <div>
        <button><a class="log" href="index.html" class="logout-link">Logout</a></button>
    </div>
    </div>
</body>

<script>

    var usernameFromPHP = "<?php echo $_SESSION['username']; ?>";
    localStorage.setItem('username', usernameFromPHP);


    function changeLocation() {
        var transferredData = localStorage.getItem("dataKey");
        if (transferredData == 1) {
            window.location.href = "Easy.html";
        } else if (transferredData == 2) {
            window.location.href = "medium.html";
        } else if (transferredData == 3) {
            window.location.href = "hard.html";
        } else {
            window.location.href = "Easy.html";
        }
    }

    function changeLevel() {
        window.location.href = "Level.html";
    }
</script>

</html>