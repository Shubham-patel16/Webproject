<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['login_error'] = 'Please login to view your profile.';
    header('Location: login.php');
    exit;
}

include 'Database/db.php';

$userId = (int) $_SESSION['user']['id'];

// Determine available columns
$selectFields = "first_name, last_name, email, address, city, state, postal_code";
$usernameExists = false;
$createdAtExists = false;

if ($columnResult = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'username'")) {
    $usernameExists = mysqli_num_rows($columnResult) > 0;
    mysqli_free_result($columnResult);
}

if ($columnResult = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'created_at'")) {
    $createdAtExists = mysqli_num_rows($columnResult) > 0;
    mysqli_free_result($columnResult);
}

if ($usernameExists) {
    $selectFields .= ", username";
}

if ($createdAtExists) {
    $selectFields .= ", created_at";
}

$query = "SELECT $selectFields FROM users WHERE id = $userId LIMIT 1";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    $_SESSION['login_error'] = 'Unable to load your profile. Please login again.';
    header('Location: login.php');
    exit;
}

$userProfile = mysqli_fetch_assoc($result);
$title = "My Profile";
include 'includes/header.php';

$successMessage = $_SESSION['success_message'] ?? '';
unset($_SESSION['success_message']);
?>

<div class="min-vh-100" style="background-color: #f8f9fa;">
    <div class="bg-light border-bottom">
        <div class="container px-4 py-3">
            <div class="d-flex align-items-center gap-2" style="font-size: 0.875rem;">
                <a href="index.php" class="text-decoration-none" style="color: #667eea;">Home</a>
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-muted">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-dark fw-medium">My Profile</span>
            </div>
        </div>
    </div>

    <div class="container px-4 py-5">
        <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?php echo htmlspecialchars($successMessage); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 70px; height: 70px;">
                                <span class="text-primary fw-bold" style="font-size: 1.5rem;">
                                    <?php echo strtoupper(substr($userProfile['first_name'], 0, 1)); ?>
                                </span>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0" style="color: #333;">
                                    <?php echo htmlspecialchars($userProfile['first_name'] . ' ' . $userProfile['last_name']); ?>
                                </h3>
                                <?php if ($createdAtExists && !empty($userProfile['created_at'])): ?>
                                    <p class="text-muted mb-0">
                                        Member since <?php echo date('M Y', strtotime($userProfile['created_at'])); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <p class="text-muted small mb-1">Email</p>
                                    <p class="fw-semibold mb-0"><?php echo htmlspecialchars($userProfile['email']); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <p class="text-muted small mb-1">Username</p>
                                    <p class="fw-semibold mb-0">
                                        <?php echo $usernameExists && !empty($userProfile['username'])
                                            ? htmlspecialchars($userProfile['username'])
                                            : 'Not set'; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="border rounded p-3 h-100">
                                    <p class="text-muted small mb-1">Address</p>
                                    <p class="fw-semibold mb-0">
                                        <?php echo htmlspecialchars($userProfile['address']); ?><br>
                                        <?php echo htmlspecialchars($userProfile['city'] . ', ' . $userProfile['state']); ?>
                                        <?php echo htmlspecialchars($userProfile['postal_code']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="products.php" class="btn btn-outline-primary">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>