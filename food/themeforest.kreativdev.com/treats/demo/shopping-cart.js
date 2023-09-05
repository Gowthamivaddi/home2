// Function to fetch cart items
function fetchCartItems() {
    $.get("get_cart_items.php", function(data) {
        $("#cart-items").html(data); // Update the HTML with retrieved cart items
    });
}

// Function to update cart quantities
function updateCart() {
    const updatedQuantities = [];

    $("input[name='quantity']").each(function() {
        const productId = $(this).data("productId");
        const quantity = $(this).val();
        updatedQuantities.push({ productId, quantity });
    });

    $.post("update_cart.php", { quantities: JSON.stringify(updatedQuantities) }, function(data) {
        fetchCartItems(); // Refresh cart items after updating
    });
}

// Function to remove item from cart
function removeFromCart(productId) {
    $.post("remove_from_cart.php", { productId }, function(data) {
        fetchCartItems(); // Refresh cart items after removing
    });
}

// Load cart items on page load
$(document).ready(function() {
    fetchCartItems();
});
