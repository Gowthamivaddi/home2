<?php
// Establish a database connection (replace these with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve submitted form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform SQL query to check admin credentials (Replace 'admins' with your actual table name)
    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Successful login, redirect to admin.html
        header("Location: admin.html");
        exit();
    } else {
        // Invalid credentials, you might display an error message
        echo "Invalid username or password.";
    }
}

$conn->close();
?>
