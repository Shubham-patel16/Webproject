<?php
$title = "Home Page";
include 'includes/header.php';
require_once 'Database/db.php';

// Default featured products (used as fallback if database is empty/unavailable)
$featuredProductsFallback = [
    [
        'id' => 1,
        'name' => 'Gaming Laptop Pro',
        'category' => 'Laptops',
        'image' => 'images/laptop-1.jpg',
        'price' => 1299.99,
        'rating' => 4,
        'reviews' => 128,
        'badge' => 'Best Seller'
    ],
    [
        'id' => 5,
        'name' => 'Graphics Card RTX 4080',
        'category' => 'Components',
        'image' => 'images/graphics-card.jpg',
        'price' => 1199.99,
        'rating' => 4,
        'reviews' => 312,
        'badge' => 'New'
    ],
    [
        'id' => 4,
        'name' => 'Gaming Keyboard RGB',
        'category' => 'Gaming',
        'image' => 'images/keyboard.jpg',
        'price' => 79.99,
        'rating' => 3,
        'reviews' => 203,
        'badge' => 'Hot'
    ],
    [
        'id' => 3,
        'name' => 'Wireless Mouse',
        'category' => 'Accessories',
        'image' => 'images/mouse.jpg',
        'price' => 29.99,
        'rating' => 3,
        'reviews' => 156,
        'badge' => 'Value'
    ]
];

// Try to pull latest products from the database so the section updates when admins add items
$featuredProducts = [];
try {
    // Check if created_at exists for ordering newest first
    $orderBy = "ORDER BY id DESC";
    $columnsResult = mysqli_query($conn, "SHOW COLUMNS FROM products LIKE 'created_at'");
    if ($columnsResult && mysqli_num_rows($columnsResult) > 0) {
        $orderBy = "ORDER BY created_at DESC";
    }

    $result = mysqli_query($conn, "SELECT id, name, category, image_url, price, rating, reviews, stock FROM products $orderBy LIMIT 4");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $featuredProducts[] = [
                'id' => (int)$row['id'],
                'name' => $row['name'] ?? '',
                'category' => $row['category'] ?? '',
                'image' => $row['image_url'] ?? '',
                'price' => isset($row['price']) ? (float)$row['price'] : 0,
                'rating' => isset($row['rating']) ? (int)$row['rating'] : 4,
                'reviews' => isset($row['reviews']) ? (int)$row['reviews'] : 0,
                // Use badge to quickly show availability
                'badge' => isset($row['stock']) && $row['stock'] > 0 ? 'In Stock' : 'Out of Stock'
            ];
        }
    }
} catch (Throwable $e) {
    // Ignore and rely on fallback data if DB is unavailable
}

if (empty($featuredProducts)) {
    $featuredProducts = $featuredProductsFallback;
}
?>

<div class="min-vh-100">
    <!-- Hero Section -->
    <section class="position-relative text-white py-5 overflow-hidden" style="min-height: 600px;">
        <!-- Background Video -->
        <video autoplay muted loop playsinline class="position-absolute top-0 start-0 w-100 h-100"
            style="object-fit: cover; z-index: 0;">
            <source src="./images/video.mp4" type="video/mp4">
        </video>
        <!-- Overlay for better text readability -->
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity: 0.4; z-index: 1;"></div>
        <!-- Content -->
        <div class="container px-4 position-relative" style="z-index: 10; padding-top: 120px; padding-bottom: 120px;">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4">
                        Discover Your Next Tech Upgrade
                    </h1>
                    <p class="lead mb-4" style="opacity: 0.9;">
                        Explore the latest computers, laptops, and tech accessories. From high-performance gaming rigs
                        to professional workstations,
                        find the perfect technology to power your productivity. Free shipping on orders over $50.
                    </p>
                    <a href="products.php"
                        class="btn btn-warning btn-lg px-5 py-3 fw-bold d-inline-flex align-items-center gap-2">
                        Shop Now
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5 position-relative" style="z-index: 5;">
        <div class="container px-4">
            <h2 class="text-center fw-bold mb-4" style="font-size: 2rem;">Explore & Shop by Category</h2>
            <p class="text-center text-muted mb-4">Discover computers and tech products</p>
            <div class="row g-4 justify-content-center">
                <!-- Laptops -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="products.php?category=laptops" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center p-3"
                                    style="width: 70px; height: 70px;">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #667eea;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="fw-semibold mb-0" style="font-size: 0.95rem;">Laptops</h3>
                        </div>
                    </a>
                </div>

                <!-- Desktops -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="products.php?category=desktops" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center p-3"
                                    style="width: 70px; height: 70px;">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #667eea;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="fw-semibold mb-0" style="font-size: 0.95rem;">Desktops</h3>
                        </div>
                    </a>
                </div>

                <!-- Accessories -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="products.php?category=accessories" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center p-3"
                                    style="width: 70px; height: 70px;">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #667eea;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="fw-semibold mb-0" style="font-size: 0.95rem;">Accessories</h3>
                        </div>
                    </a>
                </div>

                <!-- Gaming -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="products.php?category=gaming" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center p-3"
                                    style="width: 70px; height: 70px;">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #667eea;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="fw-semibold mb-0" style="font-size: 0.95rem;">Gaming</h3>
                        </div>
                    </a>
                </div>

                <!-- Components -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="products.php?category=components" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center p-3"
                                    style="width: 70px; height: 70px;">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #667eea;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="fw-semibold mb-0" style="font-size: 0.95rem;">Components</h3>
                        </div>
                    </a>
                </div>

                <!-- Software -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="products.php?category=software" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center p-3"
                                    style="width: 70px; height: 70px;">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #667eea;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="fw-semibold mb-0" style="font-size: 0.95rem;">Software</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
    </section>

    <!-- Featured Products Section -->
    <section class="py-5 bg-light">
        <div class="container px-4">
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
                <div>
                    <h2 class="fw-bold mb-2" style="font-size: 1.75rem;">Featured Products</h2>
                    <p class="text-muted mb-0">Top tech picks for every need</p>
                </div>
                <a href="products.php" class="text-decoration-none fw-semibold d-inline-flex align-items-center gap-2" style="color: #667eea;">
                    View All
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="row g-4">
                <?php foreach ($featuredProducts as $product): ?>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="text-decoration-none d-block h-100">
                            <div class="bg-white rounded border shadow-sm h-100 overflow-hidden" style="transition: transform 0.2s ease, box-shadow 0.2s ease;">
                                <div class="position-relative bg-light" style="height: 200px; overflow: hidden;">
                                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>"
                                        class="w-100 h-100" style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <?php if (!empty($product['badge'])): ?>
                                        <span class="position-absolute top-0 end-0 m-3 px-3 py-1 rounded-pill fw-semibold" style="background: #eef2ff; color: #4338ca; font-size: 0.8rem;">
                                            <?php echo htmlspecialchars($product['badge']); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2"><?php echo htmlspecialchars($product['category']); ?></p>
                                    <h3 class="fw-semibold mb-3 text-dark" style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden;"><?php echo htmlspecialchars($product['name']); ?></h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <?php $rating = isset($product['rating']) ? max(0, min(5, (int)$product['rating'])) : 0; ?>
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <svg width="16" height="16" fill="<?php echo $i <= $rating ? '#fbbf24' : 'none'; ?>" stroke="currentColor" viewBox="0 0 24 24" class="<?php echo $i <= $rating ? 'text-warning' : 'text-muted'; ?>">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                </svg>
                                            <?php endfor; ?>
                                        </div>
                                        <span class="text-muted small">(<?php echo isset($product['reviews']) ? (int)$product['reviews'] : 0; ?>)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold text-dark">$<?php echo number_format($product['price'], 2); ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>
