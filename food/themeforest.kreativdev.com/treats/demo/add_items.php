<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <?php
    // Check if the form is submitted
    if (isset($_POST['add_product'])) {
        // Database connection (replace with your own credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "shop";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check for a successful connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get form data
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_description = $_POST['product_description'];

        // Handle image upload
        //$target_dir = "uploads/";
        //$target_file = $target_dir . basename($_FILES["product_image"]["name"]);
        //$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an image
        //$check = getimagesize($_FILES["product_image"]["tmp_name"]);
        //if ($check === false) {
        //    echo "File is not an image.";
         //   exit();
        //}

        // Check file size (adjust as needed)
        //if ($_FILES["product_image"]["size"] > 500000) {
        //    echo "Sorry, your file is too large.";
        //    exit();
        //}

        // Allow certain file formats (you can customize this)
        //if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        //    echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        //    exit();
        //}

        // Move the uploaded file to the specified directory
        //if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        //    echo "The file " . htmlspecialchars(basename($_FILES["product_image"]["name"])) . " has been uploaded.";
        //} else {
        //    echo "Sorry, there was an error uploading your file.";
        //    exit();
        //}

        // Insert data into the database
        $sql = "INSERT INTO products ( name, description, price) VALUES ( '$product_name', '$product_description', '$product_price')";

        if ($conn->query($sql) === TRUE) {
            echo "New product added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
if (isset($_POST['add_product']) && $conn->query($sql) === TRUE) {
        echo '<p style="color: green; text-align: center;">New product added successfully!</p>';
    }

        // Close the database connection
        $conn->close();
    }
    ?>

    <div class="container">
        <h2>Add a New Product</h2>
        <form method="post" enctype="multipart/form-data">
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" required>

            <label for="product_price">Product Price:</label>
            <input type="text" name="product_price" required>

            <label for="product_description">Product Description:</label>
            <textarea name="product_description" required></textarea>

            <!--<label for="product_image">Product Image:</label>
            <input type="file" name="product_image" required>-->

            <input type="submit" name="add_product" value="Add Product">
        </form>
    </div>
</body>
</html>
