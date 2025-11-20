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
            <source src="./images/video.mp4" type="video/mp4">
        </video>
        <!-- Overlay for better text readability -->
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark" style="opacity: 0.4; z-index: 1;"></div>
        <!-- Content -->
        <div class="container px-4 position-relative" style="z-index: 10; padding-top: 120px; padding-bottom: 120px;">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4">
                        Discover Your Next Great Read
                    </h1>
                    <p class="lead mb-4" style="opacity: 0.9;">
                        Explore curated books across all genres. From bestsellers to hidden gems,
                        find the perfect story to inspire and captivate you. Free shipping on orders over $50.
                    </p>
                    <a href="pages/products.php"
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
            <p class="text-center text-muted mb-4">Discover books across all genres</p>
            <div class="row g-4 justify-content-center">
                <!-- Fiction -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="pages/products.php?category=fiction" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center p-3"
                                    style="width: 70px; height: 70px;">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #667eea;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="fw-semibold mb-0" style="font-size: 0.95rem;">Fiction</h3>
                        </div>
                    </a>
                </div>

                <!-- Mystery -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="pages/products.php?category=mystery" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center p-3"
                                    style="width: 70px; height: 70px;">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #667eea;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="fw-semibold mb-0" style="font-size: 0.95rem;">Mystery</h3>
                        </div>
                    </a>
                </div>

                <!-- Romance -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="pages/products.php?category=romance" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center p-3"
                                    style="width: 70px; height: 70px;">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #667eea;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="fw-semibold mb-0" style="font-size: 0.95rem;">Romance</h3>
                        </div>
                    </a>
                </div>

                <!-- Science Fiction -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="pages/products.php?category=sci-fi" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center p-3"
                                    style="width: 70px; height: 70px;">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #667eea;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="fw-semibold mb-0" style="font-size: 0.95rem;">Science Fiction</h3>
                        </div>
                    </a>
                </div>

                <!-- Biography -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="pages/products.php?category=biography" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center p-3"
                                    style="width: 70px; height: 70px;">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #667eea;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="fw-semibold mb-0" style="font-size: 0.95rem;">Biography</h3>
                        </div>
                    </a>
                </div>

                <!-- History -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="pages/products.php?category=history" class="text-decoration-none">
                        <div class="category-card text-center">
                            <div class="category-icon mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center p-3"
                                    style="width: 70px; height: 70px;">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #667eea;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="fw-semibold mb-0" style="font-size: 0.95rem;">History</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>