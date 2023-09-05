<?php
// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "task1");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $person = $_POST["person"];
    $phone = $_POST["phone"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $message = $_POST["message"];

    // Insert data into the database
    $sql = "INSERT INTO reservations (fullname, email, person, phone, date, time, message)
            VALUES ('$fullname', '$email', '$person', '$phone', '$date', '$time', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "Reservation submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
