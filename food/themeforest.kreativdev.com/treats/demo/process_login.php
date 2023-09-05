<?php
session_start();

// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "task1");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user_name'];
    $password = $_POST['password'];
    
    // Retrieve password from the database
    $sql = "SELECT password FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];
        
        // Verify password
        if ($password === $storedPassword) {
            // Set session variable for logged in user
            $_SESSION['username'] = $username;
            $_SESSION['login_success'] = true; 
            // Redirect to index.html
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid";
    }
}

// Close the database connection
mysqli_close($conn);
?>
