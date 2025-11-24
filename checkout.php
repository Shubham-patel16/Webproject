<?php
session_start();
$title = "Checkout";
include 'includes/header.php';

// Get cart from localStorage via JavaScript or session
// For demo, using sample data
$cartItems = [
    [
        'id' => 1,
        'name' => 'Gaming Laptop Pro',
        'price' => 1299.99,
        'quantity' => 1
    ],
    [
        'id' => 3,
        'name' => 'Wireless Mouse',
        'price' => 29.99,
        'quantity' => 2
    ]
];

$subtotal = 0;
foreach ($cartItems as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$shipping = $subtotal > 50 ? 0 : 9.99;
$tax = $subtotal * 0.08;
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
                <a href="cart.php" class="text-decoration-none" style="color: #667eea;">Cart</a>
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-muted">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-dark fw-medium">Checkout</span>
            </div>
        </div>
    </div>

    <div class="container px-4 py-5">
        <div class="row g-4">
            <!-- Checkout Form -->
            <div class="col-lg-8">
                <h2 class="fw-bold mb-4" style="color: #333;">Checkout</h2>

                <!-- Shipping Information -->
                <div class="bg-white rounded border p-4 mb-4">
                    <h4 class="fw-bold mb-4" style="color: #667eea;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="d-inline me-2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Shipping Information
                    </h4>
                    <form id="checkoutForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">First Name</label>
                                <input type="text" class="form-control" name="firstname" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Last Name</label>
                                <input type="text" class="form-control" name="lastname" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Address</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">City</label>
                                <input type="text" class="form-control" name="city" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Province</label>
                                <select class="form-select" name="province" required>
                                    <option value="">Choose...</option>
                                    <option>ON</option>
                                    <option>QC</option>
                                    <option>BC</option>
                                    <option>AB</option>
                                    <option>MB</option>
                                    <option>NS</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Postal Code</label>
                                <input type="text" class="form-control" name="postal" required>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Payment Information -->
                <div class="bg-white rounded border p-4">
                    <h4 class="fw-bold mb-4" style="color: #667eea;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="d-inline me-2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Payment Information
                    </h4>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Card Number</label>
                            <input type="text" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Expiry Date</label>
                            <input type="text" class="form-control" placeholder="MM/YY" maxlength="5" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">CVV</label>
                            <input type="text" class="form-control" placeholder="123" maxlength="3" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Cardholder Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="bg-white rounded border p-4" style="position: sticky; top: 20px;">
                    <h3 class="fw-bold mb-4" style="color: #333;">Order Summary</h3>
                    
                    <!-- Cart Items -->
                    <div class="mb-4">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                <div>
                                    <p class="mb-0 fw-semibold small"><?php echo htmlspecialchars($item['name']); ?></p>
                                    <p class="mb-0 text-muted small">Qty: <?php echo $item['quantity']; ?></p>
                                </div>
                                <span class="fw-semibold">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
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
                    
                    <div class="border-top pt-3 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold" style="font-size: 1.2rem; color: #333;">Total</span>
                            <span class="fw-bold" style="font-size: 1.5rem; color: #667eea;">
                                $<?php echo number_format($total, 2); ?>
                            </span>
                        </div>
                    </div>
                    
                    <button type="submit" form="checkoutForm" class="btn btn-primary w-100 btn-lg mb-3"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;"
                            onclick="processCheckout(event)">
                        Place Order
                    </button>
                    
                    <div class="text-center">
                        <p class="small text-muted mb-0">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="d-inline me-1">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Secure Checkout
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function processCheckout(e) {
    e.preventDefault();
    if (confirm('Are you sure you want to place this order?')) {
        // In a real application, this would submit to a server
        alert('Order placed successfully! Thank you for your purchase.');
        // Clear cart
        localStorage.removeItem('cart');
        // Redirect to confirmation page
        window.location.href = 'index.php';
    }
}
</script>

<?php include 'includes/footer.php'; ?>
