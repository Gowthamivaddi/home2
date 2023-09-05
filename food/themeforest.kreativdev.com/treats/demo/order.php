<?php
// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "task1");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$thankYouMessage = '';
$paymentId = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $first_name = $_POST["firstName"];
    $last_name = $_POST["lastName"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $company_name = $_POST["company_name"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["district"];
    $post_code = $_POST["post_code"];
    $country = $_POST["country"];
    $shipping_first_name = $_POST["firstName2"];
    $shipping_last_name = $_POST["lastName2"];
    $shipping_phone = $_POST["phone2"];
    $shipping_email = $_POST["email2"];
    $shipping_company_name = $_POST["company_name2"];
    $shipping_address = $_POST["address2"];
    $shipping_city = $_POST["city2"];
    $shipping_state = $_POST["district2"];
    $shipping_post_code = $_POST["post_code2"];
    $shipping_country = $_POST["country2"];
    $payment_method = $_POST["payment-gateway"];
    $total_amount = $_POST["total_amount"];

    // Insert data into the database
    $sql = "INSERT INTO orders (first_name, last_name, phone, email, company_name, address, city, state, post_code, country, 
                                shipping_first_name, shipping_last_name, shipping_phone, shipping_email, shipping_company_name, 
                                shipping_address, shipping_city, shipping_state, shipping_post_code, shipping_country, 
                                payment_method, total_amount)
            VALUES ('$first_name', '$last_name', '$phone', '$email', '$company_name', '$address', '$city', '$state', '$post_code', '$country',
                    '$shipping_first_name', '$shipping_last_name', '$shipping_phone', '$shipping_email', '$shipping_company_name', 
                    '$shipping_address', '$shipping_city', '$shipping_state', '$shipping_post_code', '$shipping_country',
                    '$payment_method', '$total_amount')";

    if (mysqli_query($conn, $sql)) {
        $thankYouMessage = "Thank you for your order!";
        $paymentId = generatePaymentId(); // Generate a random payment ID
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);

// Function to generate a random payment ID
function generatePaymentId() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $paymentId = '';
    for ($i = 0; $i < 8; $i++) {
        $paymentId .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $paymentId;
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Add your head content here -->
</head>
<body>
    <!-- Add your HTML content here -->
    <div>
        <h2><?php echo $thankYouMessage; ?></h2>
        <?php if (!empty($paymentId)) : ?>
            <p>Your payment ID: <?php echo $paymentId; ?></p>
        <?php endif; ?>
        <p>Total Amount: $<?php echo $total_amount; ?></p>
    </div>
</body>
</html>
