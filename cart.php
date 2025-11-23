<?php
$title = "Shopping Cart";
include 'includes/header.php';

// Sample cart items (in a real application, this would come from session/database)
$cartItems = [
    [
        'id' => 1,
        'name' => 'Gaming Laptop Pro',
        'image' => 'images/laptop-1.jpg',
        'price' => 1299.99,
        'quantity' => 1
    ],
    [
        'id' => 3,
        'name' => 'Wireless Mouse',
        'image' => 'images/mouse.jpg',
        'price' => 29.99,
        'quantity' => 2
    ],
    [
        'id' => 4,
        'name' => 'Gaming Keyboard RGB',
        'image' => 'images/keyboard.jpg',
        'price' => 79.99,
        'quantity' => 1
    ]
];

// Calculate totals
$subtotal = 0;
foreach ($cartItems as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$shipping = $subtotal > 50 ? 0 : 9.99;
$tax = $subtotal * 0.08; // 8% tax
$total = $subtotal + $shipping + $tax;
?>

<div class="min-vh-100">
    <!-- Breadcrumb -->
    <div class="bg-light border-bottom">
        <div class="container px-4 py-3">
            <div class="d-flex align-items-center gap-2" style="font-size: 0.875rem;">
                <a href="index.php" class="text-decoration-none" style="color: #667eea;">Home</a>
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-muted">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-dark fw-medium">Shopping Cart</span>
            </div>
        </div>
    </div>

    <div class="container px-4 py-5">
        <?php if (empty($cartItems)): ?>
            <!-- Empty Cart -->
            <div class="text-center py-5">
                <svg width="120" height="120" fill="none" stroke="#667eea" viewBox="0 0 24 24" class="mb-4 opacity-50">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h2 class="fw-bold mb-3" style="color: #333;">Your cart is empty</h2>
                <p class="text-muted mb-4">Looks like you haven't added any items to your cart yet.</p>
                <a href="products.php" class="btn btn-primary btn-lg px-5">
                    Continue Shopping
                </a>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold mb-0" style="color: #333;">Shopping Cart</h2>
                        <span class="text-muted"><?php echo count($cartItems); ?> item(s)</span>
                    </div>

                    <div class="bg-white rounded border">
                        <?php foreach ($cartItems as $index => $item): 
                            $itemTotal = $item['price'] * $item['quantity'];
                        ?>
                            <div class="p-4 <?php echo $index < count($cartItems) - 1 ? 'border-bottom' : ''; ?>">
                                <div class="row align-items-center">
                                    <!-- Product Image -->
                                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                                        <a href="product-detail.php?id=<?php echo $item['id']; ?>" class="text-decoration-none">
                                            <img src="<?php echo $item['image']; ?>" 
                                                 alt="<?php echo htmlspecialchars($item['name']); ?>" 
                                                 class="w-100 rounded"
                                                 style="height: 120px; object-fit: cover;">
                                        </a>
                                    </div>

                                    <!-- Product Info -->
                                    <div class="col-12 col-md-5 mb-3 mb-md-0">
                                        <h4 class="fw-semibold mb-2" style="color: #333;">
                                            <a href="product-detail.php?id=<?php echo $item['id']; ?>" 
                                               class="text-decoration-none" style="color: #333;">
                                                <?php echo htmlspecialchars($item['name']); ?>
                                            </a>
                                        </h4>
                                        <p class="text-muted small mb-2">Item #<?php echo $item['id']; ?></p>
                                        <p class="fw-bold mb-0" style="color: #667eea; font-size: 1.1rem;">
                                            $<?php echo number_format($item['price'], 2); ?>
                                        </p>
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="col-12 col-md-2 mb-3 mb-md-0">
                                        <label class="form-label small text-muted mb-1">Quantity</label>
                                        <div class="input-group" style="width: 120px;">
                                            <button class="btn btn-outline-secondary" type="button" 
                                                    onclick="updateQuantity(<?php echo $item['id']; ?>, -1)"
                                                    style="border-color: #dee2e6;">
                                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                </svg>
                                            </button>
                                            <input type="number" 
                                                   class="form-control text-center" 
                                                   value="<?php echo $item['quantity']; ?>" 
                                                   min="1" 
                                                   id="qty-<?php echo $item['id']; ?>"
                                                   onchange="updateQuantity(<?php echo $item['id']; ?>, 0, this.value)"
                                                   style="border-color: #dee2e6;">
                                            <button class="btn btn-outline-secondary" type="button"
                                                    onclick="updateQuantity(<?php echo $item['id']; ?>, 1)"
                                                    style="border-color: #dee2e6;">
                                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Item Total & Remove -->
                                    <div class="col-12 col-md-2 text-md-end">
                                        <p class="fw-bold mb-2" style="color: #333; font-size: 1.1rem;">
                                            $<?php echo number_format($itemTotal, 2); ?>
                                        </p>
                                        <button class="btn btn-link text-danger p-0 small" 
                                                onclick="removeItem(<?php echo $item['id']; ?>)"
                                                style="text-decoration: none;">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="d-inline me-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Continue Shopping -->
                    <div class="mt-4">
                        <a href="products.php" class="text-decoration-none" style="color: #667eea;">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="d-inline me-1">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="bg-white rounded border p-4" style="position: sticky; top: 20px;">
                        <h3 class="fw-bold mb-4" style="color: #333;">Order Summary</h3>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-semibold">$<?php echo number_format($subtotal, 2); ?></span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Shipping</span>
                            <span class="fw-semibold">
                                <?php if ($shipping == 0): ?>
                                    <span class="text-success">FREE</span>
                                <?php else: ?>
                                    $<?php echo number_format($shipping, 2); ?>
                                <?php endif; ?>
                            </span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Tax</span>
                            <span class="fw-semibold">$<?php echo number_format($tax, 2); ?></span>
                        </div>
                        
                        <?php if ($subtotal < 50): ?>
                            <div class="alert alert-info small mb-3">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="d-inline me-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Add $<?php echo number_format(50 - $subtotal, 2); ?> more for free shipping!
                            </div>
                        <?php endif; ?>
                        
                        <div class="border-top pt-3 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold" style="font-size: 1.2rem; color: #333;">Total</span>
                                <span class="fw-bold" style="font-size: 1.5rem; color: #667eea;">
                                    $<?php echo number_format($total, 2); ?>
                                </span>
                            </div>
                        </div>
                        
                        <a href="checkout.php" class="btn btn-primary w-100 btn-lg mb-3">
                            Proceed to Checkout
                        </a>
                        
                        <div class="text-center">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='30'%3E%3Ctext x='10' y='20' font-family='Arial' font-size='12' fill='%23666'%3ESecure Checkout%3C/text%3E%3C/svg%3E" 
                                 alt="Secure Checkout" 
                                 class="img-fluid opacity-50">
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function updateQuantity(itemId, change, newValue) {
    // In a real application, this would make an AJAX call to update the cart
    const input = document.getElementById('qty-' + itemId);
    let currentQty = parseInt(input.value) || 1;
    
    if (newValue !== undefined) {
        currentQty = parseInt(newValue) || 1;
    } else {
        currentQty = Math.max(1, currentQty + change);
    }
    
    input.value = currentQty;
    
    // Here you would update the cart via AJAX and refresh the totals
    console.log('Updated quantity for item', itemId, 'to', currentQty);
    // location.reload(); // Uncomment to reload page after update
}

function removeItem(itemId) {
    if (confirm('Are you sure you want to remove this item from your cart?')) {
        // In a real application, this would make an AJAX call to remove the item
        console.log('Removed item', itemId);
        // location.reload(); // Uncomment to reload page after removal
    }
}
</script>

<?php include 'includes/footer.php'; ?>
