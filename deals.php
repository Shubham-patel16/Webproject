<?php
$title = "Deals";
include 'includes/header.php';

// Sample sale products data
$saleProducts = [
    [
        'id' => 1,
        'name' => 'Gaming Laptop Pro',
        'category' => 'Laptops',
        'image' => 'images/laptop-1.jpg',
        'price' => 999.99,
        'originalPrice' => 1299.99,
        'discount' => 23,
        'rating' => 4,
        'reviews' => 128
    ],
    [
        'id' => 2,
        'name' => 'Desktop Workstation',
        'category' => 'Desktops',
        'image' => 'images/desktop-1.jpg',
        'price' => 699.99,
        'originalPrice' => 899.99,
        'discount' => 22,
        'rating' => 4,
        'reviews' => 89
    ],
    [
        'id' => 3,
        'name' => 'Wireless Mouse',
        'category' => 'Accessories',
        'image' => 'images/mouse.jpg',
        'price' => 19.99,
        'originalPrice' => 29.99,
        'discount' => 33,
        'rating' => 3,
        'reviews' => 156
    ],
    [
        'id' => 4,
        'name' => 'Gaming Keyboard RGB',
        'category' => 'Gaming',
        'image' => 'images/keyboard.jpg',
        'price' => 59.99,
        'originalPrice' => 79.99,
        'discount' => 25,
        'rating' => 3,
        'reviews' => 203
    ]
];
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
                <span class="text-dark fw-medium">Deals</span>
            </div>
        </div>
    </div>

    <!-- Hero Banner -->
    <section class="py-5" style="background: linear-gradient(to right, #667eea, #fbbf24); color: white;">
        <div class="container px-4">
            <div class="d-flex align-items-center gap-3 mb-3">
                <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: white;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span class="fs-2 fw-bold">FLASH SALES</span>
            </div>
            <h1 class="display-4 fw-bold mb-2">Incredible Deals on Premium Tech Gear</h1>
            <p class="fs-5" style="opacity: 0.9;">Save big on the technology you love. Limited time offers!</p>
        </div>
    </section>

    <!-- Products Grid -->
    <div class="container px-4 py-5">
        <div class="row g-4">
            <?php foreach ($saleProducts as $product): ?>
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="text-decoration-none">
                        <div class="bg-white rounded border overflow-hidden h-100 position-relative"
                            style="transition: all 0.3s;"
                            onmouseover="this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'; this.style.borderColor='#667eea';"
                            onmouseout="this.style.boxShadow=''; this.style.borderColor='';">

                            <!-- Discount Badge -->
                            <div class="position-absolute top-0 end-0 m-3"
                                style="background-color: #dc3545; color: white; padding: 8px 16px; border-radius: 20px; font-weight: bold; font-size: 1.1rem; z-index: 10; box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);">
                                -<?php echo $product['discount']; ?>%
                            </div>

                            <!-- Product Image -->
                            <div class="position-relative"
                                style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                <img src="<?php echo $product['image']; ?>"
                                    alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-100 h-100"
                                    style="object-fit: cover; transition: transform 0.3s;"
                                    onmouseover="this.style.transform='scale(1.1)'"
                                    onmouseout="this.style.transform='scale(1)'">
                            </div>

                            <!-- Product Info -->
                            <div class="p-4">
                                <p class="text-muted small mb-2"><?php echo htmlspecialchars($product['category']); ?></p>
                                <h3 class="fw-semibold mb-3"
                                    style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                    <?php echo htmlspecialchars($product['name']); ?>
                                </h3>

                                <!-- Rating -->
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <div class="d-flex align-items-center gap-1">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <?php if ($i <= $product['rating']): ?>
                                                <svg width="16" height="16" fill="#fbbf24" stroke="currentColor" viewBox="0 0 24 24"
                                                    class="text-warning">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                </svg>
                                            <?php else: ?>
                                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    class="text-muted">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                </svg>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="text-muted small">(<?php echo $product['reviews']; ?>)</span>
                                </div>

                                <!-- Price -->
                                <div class="d-flex align-items-baseline gap-2">
                                    <span class="fs-4 fw-bold"
                                        style="color: #333;">$<?php echo number_format($product['price'], 2); ?></span>
                                    <span
                                        class="text-muted small text-decoration-line-through">$<?php echo number_format($product['originalPrice'], 2); ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>