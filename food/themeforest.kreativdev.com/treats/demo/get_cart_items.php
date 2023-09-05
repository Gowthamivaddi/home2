<?php
// Start the session
session_start();

// Check if the cart is set in the session
if(isset($_SESSION['cart'])) {
    foreach($_SESSION['cart'] as $productId => $quantity) {
        // Fetch product details from the database based on $productId
        // For demonstration purposes, let's assume you have a function called getProductDetails($productId)
        $productDetails = getProductDetails($productId);

        // Display the cart item
        echo "<tr class='item'>
            <td class='product-img'>
                <img src='{$productDetails['image']}' alt='Product Image'>
            </td>
            <td class='product-desc'>
                <h6>{$productDetails['name']}</h6>
            </td>
            <td class='qty'>
                <div class='quantity-input'>
                    <input type='number' value='$quantity' name='quantity' data-product-id='$productId'>
                </div>
            </td>
            <td class='product-availability'>
                <span class='badge bg-success'>In Stock</span>
            </td>
            <td>
                <h6 class='mb-0'>{$productDetails['price']}</h6>
            </td>
            <td class='text-end'>
                <button class='btn btn-remove rounded-pill mx-auto' onclick='removeFromCart($productId)'>
                    <i class='fal fa-trash-alt'></i>
                </button>
            </td>
        </tr>";
    }
}
?>
