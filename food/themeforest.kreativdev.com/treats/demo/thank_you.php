<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
</head>
<body>
    <h1>Thank You for Your Booking!</h1>
    
    <?php
    // Retrieve parameters from the URL
    $booking_id = $_GET["id"];
    $booking_date = $_GET["date"];
    $booking_time = $_GET["time"];
    //$name = $_POST["name"];
    //$email = $_POST["email"];
    //$subject = $_POST["subject"];
    //$message = $_POST["message"];

    // Display booking details
    echo "<p>Your booking ID: $booking_id</p>";
    echo "<p>Booking Date: $booking_date</p>";
    echo "<p>Booking Time: $booking_time</p>";
    //echo "<p>Name: $name</p>";
    //echo "<p>Email: $email</p>";
    //echo "<p>Subject: $subject</p>";
    //echo "<p>Message: $message</p>";
    ?>

    <p>We will get back to you soon.</p>
</body>
</html>
