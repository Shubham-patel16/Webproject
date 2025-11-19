<?php
// Determine base path based on current directory
$base_path = (strpos($_SERVER['PHP_SELF'], '/pages/') !== false) ? '../' : '';
$title = $title ?? "Home Page";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo $base_path; ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>css/style.css">
</head>

<body>
    <nav>
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <a href="<?php echo $base_path; ?>index.php" class="navbar-brand d-flex align-items-center gap-2">
                    <div class="logo-icon">
                        <svg class="logo-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                    <span class="logo-text">Premium Collection</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'products.php') ? 'active' : ''; ?>"
                                href="<?php echo $base_path; ?>pages/products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'deals.php') ? 'active' : ''; ?>"
                                href="<?php echo $base_path; ?>pages/deals.php">Deals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>"
                                href="<?php echo $base_path; ?>pages/about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $base_path; ?>pages/cart.php" class="cart-link">
                                <svg class="cart-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="cart-badge">0</span>
                            </a>
                        </li>
                        <li class="nav-item d-none d-sm-flex">
                            <div class="auth-buttons d-flex align-items-center gap-2 ms-2">
                                <a href="pages/login.php" class="btn-signin">Login</a>
                                <a href="pages/register.php" class="btn-signup">Register</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>