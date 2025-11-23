<?php
$title = "Products";
include 'includes/header.php';

// Define categories
$categories = ['All', 'Laptops', 'Desktops', 'Gaming', 'Accessories', 'Components', 'Software'];

// Get selected category from URL
$selectedCategory = isset($_GET['category']) ? ucfirst($_GET['category']) : 'All';
if (!in_array($selectedCategory, $categories)) {
    $selectedCategory = 'All';
}

// Get sort option from URL
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'featured';
$validSorts = ['featured', 'price-low', 'price-high', 'rating'];
if (!in_array($sortBy, $validSorts)) {
    $sortBy = 'featured';
}

?>

<div class="min-vh-100">
    <!-- Breadcrumb -->
    <div class="bg-light border-bottom">
        <div class="container px-4 py-3">
            <div class="d-flex align-items-center gap-2" style="font-size: 0.875rem;">
                <a href="index. yphp" class="text-decoration-none" style="color: #667eea;">Home</a>
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-muted">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-dark fw-medium">Products</span>
            </div>
        </div>
    </div>

    <div class="container px-4 py-5">
        <div class="row g-4">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="bg-white rounded border p-4">
                    <h3 class="fw-bold mb-4">Categories</h3>
                    <div class="d-flex flex-column gap-2">
                        <?php foreach ($categories as $cat): ?>
                            <a href="products.php?category=<?php echo $cat === 'All' ? '' : strtolower($cat); ?>&sort=<?php echo $sortBy; ?>"
                                class="text-decoration-none px-3 py-2 rounded <?php echo ($selectedCategory === $cat || ($cat === 'All' && $selectedCategory === 'All')) ? 'bg-primary text-white fw-semibold' : 'text-dark'; ?>"
                                style="<?php echo ($selectedCategory === $cat || ($cat === 'All' && $selectedCategory === 'All')) ? '' : 'transition: background-color 0.2s;'; ?>"
                                onmouseover="<?php echo ($selectedCategory === $cat || ($cat === 'All' && $selectedCategory === 'All')) ? '' : "this.style.backgroundColor='#f8f9fa'"; ?>"
                                onmouseout="<?php echo ($selectedCategory === $cat || ($cat === 'All' && $selectedCategory === 'All')) ? '' : "this.style.backgroundColor=''"; ?>">
                                <?php echo $cat; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <!-- Price Filter -->
                    <div class="mt-5 pt-4 border-top">
                        <h4 class="fw-semibold mb-4">Price Range</h4>
                        <div class="d-flex flex-column gap-3">
                            <label class="d-flex align-items-center gap-3" style="cursor: pointer;">
                                <input type="checkbox" checked class="form-check-input price-filter" data-min="0"
                                    data-max="100">
                                <span class="small">Under $100</span>
                            </label>
                            <label class="d-flex align-items-center gap-3" style="cursor: pointer;">
                                <input type="checkbox" checked class="form-check-input price-filter" data-min="100"
                                    data-max="500">
                                <span class="small">$100 - $500</span>
                            </label>
                            <label class="d-flex align-items-center gap-3" style="cursor: pointer;">
                                <input type="checkbox" checked class="form-check-input price-filter" data-min="500"
                                    data-max="1000">
                                <span class="small">$500 - $1000</span>
                            </label>
                            <label class="d-flex align-items-center gap-3" style="cursor: pointer;">
                                <input type="checkbox" checked class="form-check-input price-filter" data-min="1000"
                                    data-max="999999">
                                <span class="small">Over $1000</span>
                            </label>
                        </div>
                    </div>

                    <!-- Rating Filter -->
                    <div class="mt-5 pt-4 border-top">
                        <h4 class="fw-semibold mb-4">Rating</h4>
                        <div class="d-flex flex-column gap-3">
                            <?php for ($stars = 5; $stars >= 1; $stars--): ?>
                                <label class="d-flex align-items-center gap-3" style="cursor: pointer;">
                                    <input type="checkbox" <?php echo $stars >= 4 ? 'checked' : ''; ?>
                                        class="form-check-input rating-filter" data-rating="<?php echo $stars; ?>">
                                    <span class="small"><?php echo $stars; ?>
                                        <?php echo $stars === 1 ? 'Star' : 'Stars'; ?></span>
                                </label>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-md-9">
                <!-- Toolbar -->
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                    <div class="mb-3 mb-md-0">
                        <h2 class="fw-bold mb-1" style="font-size: 1.75rem;">
                            <?php echo $selectedCategory === 'All' ? 'All Products' : $selectedCategory; ?>
                        </h2>
                        <p class="text-muted mb-0">Showing <span id="product-count">15</span> products</p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <select name="sort" id="sort-select" class="form-select" style="width: auto;">
                            <option value="featured" <?php echo $sortBy === 'featured' ? 'selected' : ''; ?>>Featured
                            </option>
                            <option value="price-low" <?php echo $sortBy === 'price-low' ? 'selected' : ''; ?>>Price: Low
                                to High</option>
                            <option value="price-high" <?php echo $sortBy === 'price-high' ? 'selected' : ''; ?>>Price:
                                High to Low</option>
                            <option value="rating" <?php echo $sortBy === 'rating' ? 'selected' : ''; ?>>Highest Rated
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row g-4" id="products-container">
                    <!-- Product 1: Gaming Laptop Pro -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="1299.99" data-rating="4"
                        data-category="Laptops">
                        <a href="product-detail.php?id=1" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/laptop-1.jpg" alt="Gaming Laptop Pro" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Laptops</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        Gaming Laptop Pro
                                    </h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <span class="text-muted small">(128)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$1,299.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 2: Desktop Workstation -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="899.99" data-rating="4"
                        data-category="Desktops">
                        <a href="product-detail.php?id=2" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/desktop-1.jpg" alt="Desktop Workstation" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Desktops</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        Desktop Workstation
                                    </h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <span class="text-muted small">(89)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$899.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 3: Wireless Mouse -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="29.99" data-rating="3"
                        data-category="Accessories">
                        <a href="product-detail.php?id=3" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/mouse.jpg" alt="Wireless Mouse" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Accessories</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        Wireless Mouse
                                    </h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <span class="text-muted small">(156)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$29.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 4: Gaming Keyboard RGB -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="79.99" data-rating="3"
                        data-category="Gaming">
                        <a href="product-detail.php?id=4" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/keyboard.jpg" alt="Gaming Keyboard RGB" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Gaming</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        Gaming Keyboard RGB
                                    </h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <span class="text-muted small">(203)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$79.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 5: Graphics Card RTX 4080 -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="1199.99" data-rating="4"
                        data-category="Components">
                        <a href="product-detail.php?id=5" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/graphics-card.jpg" alt="Graphics Card RTX 4080" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Components</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        Graphics Card RTX 4080
                                    </h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <span class="text-muted small">(312)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$1,199.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 6: Office Suite Pro -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="149.99" data-rating="3"
                        data-category="Software">
                        <a href="product-detail.php?id=6" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/software.jpg" alt="Office Suite Pro" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Software</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        Office Suite Pro
                                    </h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <span class="text-muted small">(87)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$149.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 7: Ultrabook 14" -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="999.99" data-rating="3"
                        data-category="Laptops">
                        <a href="product-detail.php?id=7" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/laptop-2.jpg" alt="Ultrabook 14&quot;" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Laptops</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        Ultrabook 14"
                                    </h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <span class="text-muted small">(145)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$999.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 8: Gaming Desktop PC -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="1599.99" data-rating="3"
                        data-category="Desktops">
                        <a href="product-detail.php?id=8" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/desktop-2.jpg" alt="Gaming Desktop PC" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Desktops</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        Gaming Desktop PC
                                    </h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <span class="text-muted small">(201)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$1,599.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 9: USB-C Hub -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="49.99" data-rating="3"
                        data-category="Accessories">
                        <a href="product-detail.php?id=9" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/usb-hub.jpg" alt="USB-C Hub" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Accessories</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        USB-C Hub
                                    </h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-warning">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <span class="text-muted small">(92)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$49.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 10: SSD 1TB -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="89.99" data-rating="5"
                        data-category="Components">
                        <a href="product-detail.php?id=10" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/software.jpg" alt="SSD 1TB" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Components</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        SSD 1TB</h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                    viewBox="0 0 24 24" class="text-warning">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                </svg>
                                            <?php endfor; ?>
                                        </div>
                                        <span class="text-muted small">(245)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$89.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 11: RAM 32GB Kit -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="199.99" data-rating="4"
                        data-category="Components">
                        <a href="product-detail.php?id=11" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/graphics-card.jpg" alt="RAM 32GB Kit" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Components</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        RAM 32GB Kit</h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <?php for ($i = 1; $i <= 4; $i++): ?>
                                                <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                    viewBox="0 0 24 24" class="text-warning">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                </svg>
                                            <?php endfor; ?>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <span class="text-muted small">(178)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$199.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 12: Gaming Headset -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="129.99" data-rating="4"
                        data-category="Gaming">
                        <a href="product-detail.php?id=12" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/keyboard.jpg" alt="Gaming Headset" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Gaming</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        Gaming Headset</h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <?php for ($i = 1; $i <= 4; $i++): ?>
                                                <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                    viewBox="0 0 24 24" class="text-warning">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                </svg>
                                            <?php endfor; ?>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <span class="text-muted small">(312)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$129.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 13: Monitor 27" 4K -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="449.99" data-rating="5"
                        data-category="Accessories">
                        <a href="product-detail.php?id=13" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/desktop-2.jpg" alt="Monitor 27&quot; 4K" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Accessories</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        Monitor 27" 4K</h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                    viewBox="0 0 24 24" class="text-warning">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                </svg>
                                            <?php endfor; ?>
                                        </div>
                                        <span class="text-muted small">(421)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$449.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 14: Business Laptop -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="799.99" data-rating="4"
                        data-category="Laptops">
                        <a href="product-detail.php?id=14" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/laptop-2.jpg" alt="Business Laptop" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Laptops</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        Business Laptop</h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <?php for ($i = 1; $i <= 4; $i++): ?>
                                                <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                    viewBox="0 0 24 24" class="text-warning">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                </svg>
                                            <?php endfor; ?>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <span class="text-muted small">(267)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$799.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Product 15: Antivirus Software -->
                    <div class="col-12 col-sm-6 col-lg-4 product-item" data-price="59.99" data-rating="4"
                        data-category="Software">
                        <a href="product-detail.php?id=15" class="text-decoration-none">
                            <div class="bg-white rounded border overflow-hidden h-100" style="transition: all 0.3s;">
                                <div class="position-relative"
                                    style="height: 200px; background-color: #f8f9fa; overflow: hidden;">
                                    <img src="images/software.jpg" alt="Antivirus Software" class="w-100 h-100"
                                        style="object-fit: cover; transition: transform 0.3s;"
                                        onmouseover="this.style.transform='scale(1.1)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                </div>
                                <div class="p-4">
                                    <p class="text-muted small mb-2">Software</p>
                                    <h3 class="fw-semibold mb-3"
                                        style="min-height: 48px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; color: #333;">
                                        Antivirus Software</h3>
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="d-flex align-items-center gap-1">
                                            <?php for ($i = 1; $i <= 4; $i++): ?>
                                                <svg width="16" height="16" fill="#fbbf24" stroke="currentColor"
                                                    viewBox="0 0 24 24" class="text-warning">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                </svg>
                                            <?php endfor; ?>
                                            <svg width="16" height="16" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" class="text-muted">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </div>
                                        <span class="text-muted small">(534)</span>
                                    </div>
                                    <div class="d-flex align-items-baseline justify-content-between">
                                        <span class="fs-4 fw-bold" style="color: #333;">$59.99</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>