<?php
session_start();

// Initialize an empty cart array if it doesn't exist in the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Include your database connection code here
// Example:
$host = "localhost";
$username = "root";
$password = "";
$database = "shop";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to update the cart
function updateCart($product_id, $quantity) {
    $_SESSION['cart'][$product_id] = $quantity;
}

// Function to remove an item from the cart
function removeFromCart($product_id) {
    unset($_SESSION['cart'][$product_id]);
}
if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        // You can perform actions like adding the product to the cart here
        // For simplicity, let's assume you have a cart table in your database
        // You can insert the product into the cart table with the user's ID
        // Replace 'your_cart_table' with your actual cart table name
        $user_id = 1; // Change this to the actual user's ID
        $sql = "INSERT INTO cart (user_id, product_id) VALUES ($user_id, $product_id)";
        if ($conn->query($sql) === TRUE) {
            echo "Product added to cart successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    // Query and display the products in the cart
    $user_id = 1; // Change this to the actual user's ID
    $cart_query = "SELECT products.name, products.price FROM cart
                   JOIN products ON cart.product_id = products.id
                   WHERE cart.user_id = $user_id";
    $cart_result = $conn->query($cart_query);

    if ($cart_result->num_rows > 0) {
        echo '<h2>Cart Items</h2>';
        echo '<ul>';
        while ($cart_item = $cart_result->fetch_assoc()) {
            echo '<li>' . $cart_item['name'] . ' - $' . $cart_item['price'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Your cart is empty.</p>';
    }


// Fetch and display cart items
$cartItems = array();
$totalPrice = 0;

foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $subtotal = $product['price'] * $quantity;
        $totalPrice += $subtotal;

        // Display cart item
        $cartItems[] = array(
            'id' => $product['id'],
            'name' => $product['name'],
            'quantity' => $quantity,
            'price' => $product['price'],
            'subtotal' => $subtotal
        );
    }
}
?>
<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from themeforest.kreativdev.com/treats/demo/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Aug 2023 09:59:06 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="KreativDev">

    <!-- Title -->
    <title>Treats - Fast Food & Restaurant HTML Template</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/fav.png" type="image/x-icon">

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&amp;family=Lora:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendors/bootstrap.min.css">
    <!-- Fontawesome Icon CSS -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/all.min.css">
    <!-- Icomoon Icon CSS -->
    <link rel="stylesheet" href="assets/fonts/icomoon/style.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="assets/css/vendors/magnific-popup.min.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="assets/css/vendors/nice-select.css">
    <!-- Swiper Slider -->
    <link rel="stylesheet" href="assets/css/vendors/swiper-bundle.min.css">
    <!-- AOS Animation CSS -->
    <link rel="stylesheet" href="assets/css/vendors/aos.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="assets/css/vendors/animate.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body class="theme-color-1">
    <!-- Preloader start -->
    <div id="preLoader">
        <div class="loader">
            <img src="assets/images/loader-1.gif" alt="Preloader">
        </div>
    </div>
    <!-- Preloader end -->

    <!-- Header-area start -->
    <header class="header-area header-1" data-aos="fade-down">
        <!-- Start mobile menu -->
        <div class="mobile-menu">
            <div class="container">
                <div class="mobile-menu-wrapper"></div>
            </div>
        </div>
        <!-- End mobile menu -->

        <div class="main-responsive-nav">
            <div class="container">
                <!-- Mobile Logo -->
                <div class="logo">
                    <a href="index.html" target="_self" title="Treats">
                        <img class="lazyload" src="assets/images/placeholder.png" data-src="assets/images/logo/logo-1.png" alt="Treats logo">
                    </a>
                </div>
                <!-- Menu toggle button -->
                <button class="menu-toggler" type="button">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>

        <div class="main-navbar">
            <div class="header-top py-2">
                <div class="container">
                    <div class="header-top-items mobile-item d-flex flex-wrap justify-content-between gap-15 align-items-center">
                        <a href="tel:99911446666" class="icon-start" target="_self" title="Call Us">
                            <span class="color-primary">
                                Call Us:
                            </span>
                            +999 11 44 6666
                        </a>
                        <div class="social-link icon-only">
                            <a class="rounded-pill" href="https://www.instagram.com/" target="_blank" title="instagram"><i class="fab fa-instagram"></i></a>
                            <a class="rounded-pill" href="https://www.dribbble.com/" target="_blank" title="dribbble"><i class="fab fa-dribbble"></i></a>
                            <a class="rounded-pill" href="https://www.twitter.com/" target="_blank" title="twitter"><i class="fab fa-twitter"></i></a>
                            <a class="rounded-pill" href="https://www.youtube.com/" target="_blank" title="youtube"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="container">
                    <nav class="navbar navbar-expand-lg">
                        <!-- Logo -->
                        <a class="navbar-brand" href="index.html" target="_self" title="Treats">
                            <img class="lazyload" src="assets/images/placeholder.png" data-src="assets/images/logo/logo-1.png" alt="Treats logo">
                        </a>
                        <!-- Navigation items -->
                        <div class="collapse navbar-collapse">
                            <ul id="mainMenu" class="navbar-nav mobile-item mx-auto">
                                <li class="nav-item">
                                    <a href="#home" class="nav-link toggle">Home <i class="fal fa-plus"></i></a>
                                    <ul class="menu-dropdown">
                                        <li class="nav-item">
                                            <a class="nav-link" href="index.html">Home Demo 1</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="index-2.html">Home Demo 2</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="index-3.html">Home Demo 3</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="index-4.html">Home Demo 4</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="index-5.html">Home Demo 5</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.html">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link toggle" href="menu.html">Menu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link toggle" href="#">Shop<i class="fal fa-plus"></i></a>
                                    <ul class="menu-dropdown">
                                        <li class="nav-item">
                                            <a class="nav-link" href="shop.html">Shop</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="shop-details.html">Shop Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="cart.html">Cart</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="wishlist.html">Wishlist</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="checkout.html">Checkout</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link toggle" href="#">Pages<i class="fal fa-plus"></i></a>
                                    <ul class="menu-dropdown">
                                        <li class="nav-item">
                                            <a class="nav-link" href="about.html">About</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="reservation.html">Reservation</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="cart.html">Cart</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="wishlist.html">Wishlist</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="checkout.html">Checkout</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="faq.html">FAQ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="login.html">Login</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="signup.html">Signup</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="404.html">404</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="coming-soon.html">Coming Soon</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="terms-conditions.html">Terms &amp; Conditions</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link toggle" href="#">Blog<i class="fal fa-plus"></i></a>
                                    <ul class="menu-dropdown">
                                        <li class="nav-item">
                                            <a class="nav-link" href="blogs.html">Blogs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="blog-details.html">Blog Details</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="more-option mobile-item">
                            <div class="item">
                                <div class="language">
                                    <select class="niceselect">
                                        <option value="1">English</option>
                                        <option value="2">Chinese</option>
                                        <option value="3">French</option>
                                    </select>
                                </div>
                            </div>
                            <div class="item">
                                <a href="login.html" class="btn-icon" target="_self" aria-label="User" title="User">
                                    <i class="fal fa-user-circle"></i>
                                </a>
                            </div>
                            <div class="item">
                                <a href="cart.html" class="btn-icon pe-2" target="_self" aria-label="Cart" title="Cart">
                                    <i class="fal fa-shopping-bag"></i>
                                    <span class="badge rounded-pill bg-primary">3</span>
                                </a>
                            </div>
                            <div class="item">
                                <a href="reservation.html" class="btn btn-md btn-primary rounded-pill" title="Book a Table" target="_self">Reservation</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header-area end -->

    <!-- Breadcrumb start -->
    <div class="breadcrumb-area bg-img bg-cover" data-bg-image="assets/images/breadcrumb-bg.jpg">
        <div class="overlay 65"></div>
        <div class="container">
            <div class="content text-center">
                <h2 class="color-white">Cart</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb end -->

   
    <!-- Shopping-area Start -->
<div class="shopping-area cart ptb-100">
    <div class="container">
        <div class="row justify-content-center gx-xl-5">
            <div class="col-lg-9">
                <form method="post">
                    <div class="item-list border radius-md table-responsive">
                        <table class="shopping-table">
                            <thead>
                                <tr class="table-heading">
                                    <th scope="col" colspan="2" class="first">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Total</th>
                                    <th scope="col" class="last">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cartItems as $item) { ?>
                                    <tr class="item">
                                        <td class="product-img">
                                            <div class="image">
                                                <a href="shop-details.html" class="lazy-container radius-md ratio ratio-1-1">
                                                    <img class="lazyload" src="assets/images/placeholder.png" data-src="assets/images/shop/shop-<?php echo $item['id']; ?>.jpg" alt="Product">
                                                </a>
                                            </div>
                                        </td>
                                        <td class="product-desc">
                                            <h6>
                                                <a class="product-title mb-10" href="shop-details.html"><?php echo $item['name']; ?></a>
                                            </h6>
                                            <div class="ratings">
                                                <div class="rate">
                                                    <div class="rating-icon"></div>
                                                </div>
                                                <span class="ratings-total">(4.5)</span>
                                            </div>
                                        </td>
                                        <td class="qty">
                                            <div class="quantity-input">
                                                <div class="qty-btn quantity-down">
                                                    <i class="fal fa-minus"></i>
                                                </div>
                                                <input type="text" value="<?php echo $item['quantity']; ?>" name="quantity_<?php echo $item['id']; ?>" spellcheck="false">
                                                <div class="qty-btn quantity-up">
                                                    <i class="fal fa-plus"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-availability">
                                            <span class="badge bg-success">In Stock</span>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">$<?php echo number_format($item['subtotal'], 2); ?></h6>
                                        </td>
                                        <td class="text-end">
                                            <a href="cart.php?remove=<?php echo $item['id']; ?>" class="btn btn-remove rounded-pill mx-auto">
                                                <i class="fal fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="btn-groups mt-30">
                        <button type="submit" class="btn btn-md btn-primary" name="update_cart" title="Update Cart">Update Cart</button>
                        <a href="checkout.html" class="btn btn-md btn-primary" title="Checkout" target="_self">Checkout</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Shopping-area End -->


    <?php
    // Handle remove item from cart
    if (isset($_GET['remove'])) {
        $product_id = $_GET['remove'];
        removeFromCart($product_id);
        header("Location: cart.php"); // Redirect back to the cart page
    }

    // Handle update cart
    if (isset($_POST['update_cart'])) {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'quantity_') !== false) {
                $product_id = str_replace('quantity_', '', $key);
                $quantity = (int)$value;
                updateCart($product_id, $quantity);
            }
        }
        header("Location: cart.php"); // Redirect back to the cart page
    }

    // Close the database connection
    $conn->close();
    ?>

    <!-- Shopping-area End -->
    <script src="shopping-cart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Gallery-area start -->
    <div class="gallery-area" data-aos="fade-up">
        <div class="container">
            <div class="swiper gallery-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="https://www.instagram.com/" class="slider-item" title="Image" target="_blank">
                            <div class="lazy-container ratio ratio-2-3">
                                <img class="lazyload" src="https://themeforest.kreativdev.com/treats/demo/assets/images/gallery/gallery-1.png" data-src="https://themeforest.kreativdev.com/treats/demo/assets/images/gallery/gallery-1.png" alt="Image">
                            </div>
                            <div class="icon rounded-pill"><img class="lazyload blur-up" src="assets/images/placeholder.png" data-src="assets/images/instagram.png" alt="Image"></div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="https://www.instagram.com/" class="slider-item" title="Image" target="_blank">
                            <div class="lazy-container ratio ratio-2-3">
                                <img class="lazyload" src="https://themeforest.kreativdev.com/treats/demo/assets/images/gallery/gallery-2.png" data-src="https://themeforest.kreativdev.com/treats/demo/assets/images/gallery/gallery-2.png" alt="Image">
                            </div>
                            <div class="icon rounded-pill"><img class="lazyload blur-up" src="assets/images/instagram.png" data-src="assets/images/instagram.png" alt="Image"></div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="https://www.instagram.com/" class="slider-item" title="Image" target="_blank">
                            <div class="lazy-container ratio ratio-2-3">
                                <img class="lazyload" src="https://themeforest.kreativdev.com/treats/demo/assets/images/gallery/gallery-3.png" data-src="https://themeforest.kreativdev.com/treats/demo/assets/images/gallery/gallery-3.png" alt="Image">
                            </div>
                            <div class="icon rounded-pill"><img class="lazyload blur-up" src="assets/images/placeholder.png" data-src="assets/images/instagram.png" alt="Image"></div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="https://www.instagram.com/" class="slider-item" title="Image" target="_blank">
                            <div class="lazy-container ratio ratio-2-3">
                                <img class="lazyload" src="https://themeforest.kreativdev.com/treats/demo/assets/images/gallery/gallery-4.png" data-src="https://themeforest.kreativdev.com/treats/demo/assets/images/gallery/gallery-4.png" alt="Image">
                            </div>
                            <div class="icon rounded-pill"><img class="lazyload blur-up" src="assets/images/placeholder.png" data-src="assets/images/instagram.png" alt="Image"></div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="https://www.instagram.com/" class="slider-item" title="Image" target="_blank">
                            <div class="lazy-container ratio ratio-2-3">
                                <img class="lazyload" src="https://themeforest.kreativdev.com/treats/demo/assets/images/gallery/gallery-5.png" data-src="https://themeforest.kreativdev.com/treats/demo/assets/images/gallery/gallery-5.png" alt="Image">
                            </div>
                            <div class="icon rounded-pill"><img class="lazyload blur-up" src="assets/images/placeholder.png" data-src="assets/images/instagram.png" alt="Image"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery-area end -->

    <!-- Footer-area start -->
    <footer class="footer-area bg-img bg-cover" data-bg-image="assets/images/footer-bg-1.jpg">
        <div class="overlay opacity-95"></div>
        <div class="container">
            <div class="footer-top pt-90 pb-60">
                <div class="row justify-content-between">
                    <div class="col-xl-4 col-lg-5 col-md-7 col-sm-12">
                        <div class="footer-widget" data-aos="fade-up">
                            <div class="navbar-brand">
                                <a href="index.html" target="_self" title="Link">
                                    <img class="lazyload" src="https://themeforest.kreativdev.com/treats/demo/assets/images/logo/logo-1.png" data-src="https://themeforest.kreativdev.com/treats/demo/assets/images/logo/logo-1.png" alt="Treats logo">
                                </a>
                            </div>
                            <p>
                                We invite you to embark on a culinary adventure with us. Discover a harmonious blend of flavors, impeccable service, and a dining experience that will linger in your memory long after you leave.
                            </p>
                            <div class="social-link">
                                <a href="https://www.instagram.com/" target="_blank" title="Link"><i class="fab fa-instagram"></i></a>
                                <a href="https://www.dribbble.com/" target="_blank" title="Link"><i class="fab fa-dribbble"></i></a>
                                <a href="https://www.twitter.com/" target="_blank" title="Link"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.youtube.com/" target="_blank" title="Link"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-widget" data-aos="fade-up">
                            <h4>Useful Links</h4>
                            <ul class="footer-links">
                                <li>
                                    <a href="shop.html" target="_self" title="link">All Categories</a>
                                </li>
                                <li>
                                    <a href="menu.html" target="_self" title="link">Food Menu</a>
                                </li>
                                <li>
                                    <a href="contact.html" target="_self" title="link">My Account</a>
                                </li>
                                <li>
                                    <a href="contact.html" target="_self" title="link">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="about.html" target="_self" title="link">About Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="footer-widget" data-aos="fade-up">
                            <h4>Recent Post</h4>
                            <article class="article-item">
                                <div class="image">
                                    <a href="blog-details.html" target="_self" title="Link" class="lazy-container ratio ratio-1-1 radius-sm">
                                        <img class="lazyload" src="https://themeforest.kreativdev.com/treats/demo/assets/images/blog/footer-blog-1.jpg" data-src="https://themeforest.kreativdev.com/treats/demo/assets/images/blog/footer-blog-1.jpg" alt="Blog Image">
                                    </a>
                                </div>
                                <div class="content">
                                    <h6 class="lc-2 mb-10">
                                        <a href="blog-details.html" target="_self" title="Blog">
                                            The Ultimate Food Challenge: Can You Handle These Epic Restaurant Dishes?
                                        </a>
                                    </h6>
                                    <ul class="blog-list list-unstyled">
                                        <li class="font-sm icon-start"><i class="far fa-user-alt"></i>Admin</li>
                                        <li class="font-sm icon-start"><i class="fal fa-calendar-alt"></i>18-08-2023</li>
                                    </ul>
                                </div>
                            </article>
                            <article class="article-item">
                                <div class="image">
                                    <a href="blog-details.html" target="_self" title="Link" class="lazy-container ratio ratio-1-1 radius-sm">
                                        <img class="lazyload" src="https://themeforest.kreativdev.com/treats/demo/assets/images/blog/footer-blog-2.jpg" data-src="https://themeforest.kreativdev.com/treats/demo/assets/images/blog/footer-blog-2.jpg" alt="Blog Image">
                                    </a>
                                </div>
                                <div class="content">
                                    <h6 class="lc-2 mb-10">
                                        <a href="blog-details.html" target="_self" title="Blog">
                                            Savor the Moment: 5 Unique Restaurants with Stunning Views You Must Visit!
                                        </a>
                                    </h6>
                                    <ul class="blog-list list-unstyled">
                                        <li class="font-sm icon-start"><i class="far fa-user-alt"></i>Admin</li>
                                        <li class="font-sm icon-start"><i class="fal fa-calendar-alt"></i>18-08-2023</li>
                                    </ul>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                        <div class="footer-widget" data-aos="fade-up">
                            <h4>Contact Us</h4>
                            <ul class="info-list">
                                <li>
                                    <i class="fal fa-map-marker-alt"></i>
                                    <span>2416B, Mapleview Drive, Manhattan, Newyork, USA</span>
                                </li>
                                <li>
                                    <i class="fal fa-envelope"></i>
                                    <div class="link">
                                        <a href="mailto:helpline@example.com" target="_self" title="Link">helpline@example.com</a>
                                        <a href="mailto:getinfo@example.com" target="_self" title="Link">getinfo@example.com</a>
                                    </div>
                                </li>
                                <li>
                                    <i class="fal fa-headset"></i>
                                    <div class="link">
                                        <a href="tel:99911446666" target="_self" title="Link">+999 11 44 6666</a>
                                        <a href="tel:9992233555" target="_self" title="Link">+999 22 33 5555</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="newsletter radius-md">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-5 col-md-6">
                        <h4 class="mb-15">Subscribe Our Newsletter</h4>
                    </div>
                    <div class="col-xl-5 col-md-6">
                        <div class="newsletter-form mb-15">
                            <form id="newsletterForm">
                                <div class="form-group">
                                    <input class="form-control shadow-md rounded-pill" placeholder="Enter email here..." type="text" name="EMAIL" required="" autocomplete="off">
                                    <button class="btn btn-lg btn-primary rounded-pill" type="submit">
                                        <span class="d-inline d-sm-none">
                                            <i class="fal fa-paper-plane"></i>
                                        </span>
                                        <span class="d-none d-sm-inline">Subscribe</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copy-right-area ptb-30">
                <div class="copy-right-content">
                    <span>
                        Copyright <i class="fal fa-copyright"></i><span id="footerDate"></span> <a href="index.html" target="_self" title="Treats" class="color-primary">Treats</a>. All Rights Reserved
                    </span>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer-area end-->

    <!-- Go to Top -->
    <div class="go-top"><i class="fal fa-angle-up"></i></div>
    <!-- Go to Top -->

    <!-- Jquery JS -->
    <script src="assets/js/vendors/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendors/bootstrap.min.js"></script>
    <!-- Counter JS -->
    <script src="assets/js/vendors/jquery.counterup.min.js"></script>
    <!-- Magnific Popup JS -->
    <script src="assets/js/vendors/jquery.magnific-popup.min.js"></script>
    <!-- Nice Select JS -->
    <script src="assets/js/vendors/jquery.nice-select.min.js"></script>
    <!-- Swiper Slider JS -->
    <script src="assets/js/vendors/swiper-bundle.min.js"></script>
    <!-- Lazysizes -->
    <script src="assets/js/vendors/lazysizes.min.js"></script>
    <!-- Mouse Hover JS -->
    <script src="assets/js/vendors/mouse-hover-move.js"></script>
    <!-- Twinmax JS -->
    <script src="assets/js/vendors/tweenMax.min.js"></script>
    <!-- AOS JS -->
    <script src="assets/js/vendors/aos.min.js"></script>
    <!-- Main script JS -->
    <script src="assets/js/script.js"></script>
</body>


<!-- Mirrored from themeforest.kreativdev.com/treats/demo/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Aug 2023 09:59:06 GMT -->
</html>
<?php
    // Handle remove item from cart
    if (isset($_GET['remove'])) {
        $product_id = $_GET['remove'];
        removeFromCart($product_id);
        header("Location: cart.php"); // Redirect back to the cart page
    }

    // Handle update cart
    if (isset($_POST['update_cart'])) {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'quantity_') !== false) {
                $product_id = str_replace('quantity_', '', $key);
                $quantity = (int)$value;
                updateCart($product_id, $quantity);
            }
        }
        header("Location: cart.php"); // Redirect back to the cart page
    }

    // Close the database connection
    $conn->close();
    ?>