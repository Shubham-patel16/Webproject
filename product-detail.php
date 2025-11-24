<?php
$title = "Product Details";
include 'includes/header.php';

// Sample product data (in a real app, this would come from database)
$products = [
    1 => [
        'name' => 'Gaming Laptop Pro',
        'category' => 'Laptops',
        'image' => 'images/laptop-1.jpg',
        'price' => 1299.99,
        'originalPrice' => 1499.99,
        'rating' => 4,
        'reviews' => 128,
        'description' => 'High-performance gaming laptop with the latest graphics card, fast processor, and stunning display. Perfect for gamers and content creators.',
        'specs' => [
            'Processor' => 'Intel Core i7-12700H',
            'Graphics' => 'NVIDIA RTX 4060',
            'RAM' => '16GB DDR4',
            'Storage' => '512GB SSD',
            'Display' => '15.6" FHD 144Hz',
            'Battery' => '6-cell 90Wh'
        ],
        'inStock' => true,
        'stockQty' => 15
    ],
    2 => [
        'name' => 'Desktop Workstation',
        'category' => 'Desktops',
        'image' => 'images/desktop-1.jpg',
        'price' => 899.99,
        'originalPrice' => 1099.99,
        'rating' => 4,
        'reviews' => 89,
        'description' => 'Powerful desktop workstation designed for professionals. Handles demanding tasks with ease.',
        'specs' => [
            'Processor' => 'AMD Ryzen 7 5800X',
            'Graphics' => 'NVIDIA RTX 3060',
            'RAM' => '32GB DDR4',
            'Storage' => '1TB SSD + 2TB HDD',
            'Power Supply' => '750W 80+ Gold',
            'Case' => 'Mid Tower ATX'
        ],
        'inStock' => true,
        'stockQty' => 8
    ],
    3 => [
        'name' => 'Wireless Mouse',
        'category' => 'Accessories',
        'image' => 'images/mouse.jpg',
        'price' => 29.99,
        'originalPrice' => 39.99,
        'rating' => 3,
        'reviews' => 156,
        'description' => 'Ergonomic wireless mouse with precision tracking and long battery life.',
        'specs' => [
            'Connectivity' => 'Wireless 2.4GHz',
            'DPI' => 'Up to 1600 DPI',
            'Battery' => 'AA Battery (12 months)',
            'Buttons' => '3 buttons + scroll wheel',
            'Compatibility' => 'Windows, Mac, Linux'
        ],
        'inStock' => true,
        'stockQty' => 50
    ],
    4 => [
        'name' => 'Gaming Keyboard RGB',
        'category' => 'Gaming',
        'image' => 'images/keyboard.jpg',
        'price' => 79.99,
        'originalPrice' => 99.99,
        'rating' => 3,
        'reviews' => 203,
        'description' => 'Mechanical gaming keyboard with customizable RGB lighting and tactile switches for responsive gameplay.',
        'specs' => [
            'Switches' => 'Mechanical (Blue)',
            'Key Rollover' => 'N-Key Rollover',
            'Lighting' => 'RGB per-key',
            'Connection' => 'Wired USB',
            'Material' => 'Aluminium top plate'
        ],
        'inStock' => true,
        'stockQty' => 30
    ],
    5 => [
        'name' => 'Graphics Card RTX 4080',
        'category' => 'Components',
        'image' => 'images/graphics-card.jpg',
        'price' => 1199.99,
        'originalPrice' => 1399.99,
        'rating' => 4,
        'reviews' => 312,   
        'description' => 'Top-tier graphics card delivering exceptional performance for gaming and content creation with ray tracing support.',
        'specs' => [
            'GPU' => 'NVIDIA RTX 4080',
            'Memory' => '16GB GDDR6X',
            'Bus' => 'PCIe 4.0',
            'Outputs' => '3x DisplayPort, 1x HDMI',
            'Power' => 'Requires 850W PSU'
        ],
        'inStock' => true,
        'stockQty' => 12
    ]
];

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 1;
if (!isset($products[$productId])) {
    // Show a friendly not-found message rather than silently falling back
?>
    <div class="min-vh-100">
        <div class="bg-light border-bottom">
            <div class="container px-4 py-3">
                <div class="d-flex align-items-center gap-2" style="font-size: 0.875rem;">
                    <a href="index.php" class="text-decoration-none" style="color: #667eea;">Home</a>
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-muted">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <a href="products.php" class="text-decoration-none" style="color: #667eea;">Products</a>
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-muted">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-dark fw-medium">Product Not Found</span>
                </div>
            </div>
        </div>

        <div class="container px-4 py-5">
            <div class="bg-white rounded border p-4 text-center">
                <h2 class="fw-bold mb-3">Product not found</h2>
                <p class="text-muted mb-4">The product you are looking for does not exist or has been removed.</p>
                <a href="products.php" class="btn btn-primary">Back to Products</a>
            </div>
        </div>
    </div>
<?php
    include 'includes/footer.php';
    exit;
} else {
    $product = $products[$productId];
}
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
                <a href="products.php" class="text-decoration-none" style="color: #667eea;">Products</a>
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-muted">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-dark fw-medium"><?php echo htmlspecialchars($product['name']); ?></span>
            </div>
        </div>
    </div>

    <div class="container px-4 py-5">
        <div class="row g-5">
            <!-- Product Image -->
            <div class="col-lg-6">
                <div class="bg-light rounded p-4 text-center" style="min-height: 500px; display: flex; align-items: center; justify-content: center;">
                    <img src="<?php echo $product['image']; ?>"
                        alt="<?php echo htmlspecialchars($product['name']); ?>"
                        class="img-fluid rounded"
                        style="max-height: 500px; object-fit: contain;">
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <p class="text-muted small mb-2"><?php echo htmlspecialchars($product['category']); ?></p>
                <h1 class="fw-bold mb-3" style="color: #333; font-size: 2.5rem;"><?php echo htmlspecialchars($product['name']); ?></h1>

                <!-- Rating -->
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="d-flex align-items-center gap-1">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <?php if ($i <= $product['rating']): ?>
                                <svg width="20" height="20" fill="#fbbf24" stroke="currentColor" viewBox="0 0 24 24" class="text-warning">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            <?php else: ?>
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-muted">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <span class="text-muted">(<?php echo $product['reviews']; ?> reviews)</span>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <div class="d-flex align-items-baseline gap-3 mb-2">
                        <span class="display-5 fw-bold" style="color: #667eea;">$<?php echo number_format($product['price'], 2); ?></span>
                        <?php if (isset($product['originalPrice'])): ?>
                            <span class="text-muted text-decoration-line-through fs-4">$<?php echo number_format($product['originalPrice'], 2); ?></span>
                            <span class="badge bg-danger">Save $<?php echo number_format($product['originalPrice'] - $product['price'], 2); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if ($product['inStock']): ?>
                        <p class="text-success mb-0">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="d-inline me-1">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            In Stock (<?php echo $product['stockQty']; ?> available)
                        </p>
                    <?php else: ?>
                        <p class="text-danger mb-0">Out of Stock</p>
                    <?php endif; ?>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h4 class="fw-bold mb-3" style="color: #333;">Description</h4>
                    <p class="text-muted" style="line-height: 1.8;"><?php echo htmlspecialchars($product['description']); ?></p>
                </div>

                <!-- Add to Cart -->
                <div class="mb-4">
                    <div class="d-flex gap-3 align-items-center mb-3">
                        <label class="fw-semibold" style="color: #333;">Quantity:</label>
                        <div class="input-group" style="width: 150px;">
                            <button class="btn btn-outline-secondary" type="button" onclick="changeQty(-1)">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </button>
                            <input type="number" class="form-control text-center" id="quantity" value="1" min="1" max="<?php echo $product['stockQty']; ?>">
                            <button class="btn btn-outline-secondary" type="button" onclick="changeQty(1)">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-lg w-100 mb-2"
                        onclick="addToCart(<?php echo $productId; ?>, <?php echo $product['price']; ?>, '<?php echo htmlspecialchars($product['name']); ?>', '<?php echo $product['image']; ?>')"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;"
                        <?php echo !$product['inStock'] ? 'disabled' : ''; ?>>
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="d-inline me-2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Add to Cart
                    </button>
                    <a href="cart.php" class="btn btn-outline-primary btn-lg w-100">
                        View Cart
                    </a>
                </div>
            </div>
        </div>

        <!-- Specifications -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="bg-white rounded border p-4">
                    <h3 class="fw-bold mb-4" style="color: #333;">Specifications</h3>
                    <div class="row">
                        <?php foreach ($product['specs'] as $key => $value): ?>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <span class="fw-semibold me-3" style="color: #667eea; min-width: 150px;"><?php echo htmlspecialchars($key); ?>:</span>
                                    <span class="text-muted"><?php echo htmlspecialchars($value); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeQty(change) {
        const input = document.getElementById('quantity');
        let currentQty = parseInt(input.value) || 1;
        const maxQty = parseInt(input.getAttribute('max')) || 999;
        currentQty = Math.max(1, Math.min(maxQty, currentQty + change));
        input.value = currentQty;
    }

    function addToCart(productId, price, name, image) {
        const quantity = parseInt(document.getElementById('quantity').value) || 1;

        // Get existing cart from localStorage or create new one
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Check if product already in cart
        const existingItem = cart.find(item => item.id === productId);
        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            cart.push({
                id: productId,
                name: name,
                price: price,
                image: image,
                quantity: quantity
            });
        }

        // Save to localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Update cart badge
        updateCartBadge();

        // Show success message
        alert('Product added to cart!');

        // Optionally redirect to cart
        // window.location.href = 'cart.php';
    }

    function updateCartBadge() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        const badge = document.querySelector('.cart-badge');
        if (badge) {
            badge.textContent = totalItems;
        }
    }

    // Update cart badge on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateCartBadge();
    });
</script>

<?php include 'includes/footer.php'; ?>