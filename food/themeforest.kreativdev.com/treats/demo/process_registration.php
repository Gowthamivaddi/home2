<?php
// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "task1");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$username = $_POST['user_name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hash the password for security
//$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert data into the database
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

if (mysqli_query($conn, $sql)) {
    echo "Registration successful";
     header("Location: login.html");
        exit(); 
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
