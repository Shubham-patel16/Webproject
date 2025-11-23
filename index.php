<?php
$title = "Home Page";
include 'includes/header.php';
?>

<div class="min-vh-100">
    <!-- Hero Section -->
    <section class="position-relative text-white py-5 overflow-hidden" style="min-height: 600px;">
        <!-- Background Video -->
        <video autoplay muted loop playsinline class="position-absolute top-0 start-0 w-100 h-100"
            style="object-fit: cover; z-index: 0;">
            <source src="./images/Video.mp4" type="video/mp4">
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
</div>

<?php include 'includes/footer.php'; ?>