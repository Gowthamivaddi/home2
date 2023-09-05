<?php
// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "task1");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    // Generate a random booking ID
    $booking_id = uniqid();

    // Get the current date and time
    $booking_date = date("Y-m-d");
    $booking_time = date("H:i:s");

    // Insert data into the database
    $sql = "INSERT INTO contact_messages (name, email, subject, message)
            VALUES ('$name', '$email', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "Message sent successfully!";
        echo "Your booking ID: $booking_id<br>";
        echo "Booking Date: $booking_date<br>";
        echo "Booking Time: $booking_time<br>";
        header("Location: thank_you.php?id=$booking_id&date=$booking_date&time=$booking_time&name=$name&email=$email");
exit();


    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
