<?php
session_start();
include 'Database/db.php';

// Check if admin is logged in
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: admin-login.php');
    exit;
}

$title = "Add Product";
include 'includes/header.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = escapeInput($_POST['name']);
    $description = escapeInput($_POST['description']);
    $category = escapeInput($_POST['category']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);

    // Handle image: accept upload or URL
    $image_url = '';
    $uploadDir = 'images/';
    $uploadOk = false;

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $fileInfo = pathinfo($_FILES['image_file']['name']);
        $ext = strtolower($fileInfo['extension'] ?? '');
        if (in_array($ext, $allowedExt)) {
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0755, true);
            }
            $targetName = 'prod_' . uniqid() . '.' . $ext;
            $targetPath = $uploadDir . $targetName;
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $targetPath)) {
                $image_url = $targetPath;
                $uploadOk = true;
            }
        }
    }

    if (!$uploadOk) {
        $image_url = escapeInput($_POST['image_url'] ?? '');
    }

    // Detect which image column exists
    $imageColumn = 'image_url';
    if ($colRes = mysqli_query($conn, "SHOW COLUMNS FROM products LIKE 'image_url'")) {
        if (mysqli_num_rows($colRes) === 0) {
            $imageColumn = 'image';
        }
        mysqli_free_result($colRes);
    }

    // Build dynamic insert to support image_url or image column
    $columns = ['name', 'category', 'description', 'price', 'stock'];
    $placeholders = ['?', '?', '?', '?', '?'];
    $types = 'sssdi';
    $values = [$name, $category, $description, $price, $stock];

    if (!empty($imageColumn)) {
        $columns[] = $imageColumn;
        $placeholders[] = '?';
        $types .= 's';
        $values[] = $image_url;
    }

    $columnsSql = implode(', ', $columns);
    $placeholdersSql = implode(', ', $placeholders);

    $stmt = mysqli_prepare($conn, "INSERT INTO products ($columnsSql) VALUES ($placeholdersSql)");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, $types, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success_message'] = 'Product added successfully.';
            mysqli_stmt_close($stmt);
            header('Location: admin-products.php');
            exit;
        }
        $error = 'Error adding product: ' . mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
    } else {
        $error = 'Error preparing add-product query: ' . mysqli_error($conn);
    }
}

$categories = ['Laptops', 'Desktops', 'Gaming', 'Accessories', 'Components', 'Webcams'];
?>

<div class="min-vh-100" style="background-color: #f8f9fa;">
    <div class="bg-white border-bottom shadow-sm">
        <div class="container-fluid px-4 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0" style="color: #667eea;">Add New Product</h4>
                <a href="admin-products.php" class="btn btn-outline-secondary btn-sm">Back to Products</a>
            </div>
        </div>
    </div>

    <div class="container-fluid px-4 py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                        <?php endif; ?>

                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Product Name *</label>
                                    <input type="text" name="name" class="form-control" placeholder="e.g. 4K Streaming Webcam" required>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold d-flex justify-content-between align-items-center">
                                        <span>Description *</span>
                                        <small class="text-muted">Tell customers what makes it great.</small>
                                    </label>
                                    <textarea name="description" class="form-control" rows="5" placeholder="Key features, use cases, and specs" required></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Category *</label>
                                    <select name="category" class="form-select" required>
                                        <option value="">Select category...</option>
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Image URL (optional)</label>
                                    <input type="text" name="image_url" class="form-control" placeholder="images/product.jpg">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Price *</label>
                                    <input type="number" name="price" class="form-control" step="0.01" min="0" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Stock *</label>
                                    <input type="number" name="stock" class="form-control" min="0" required>
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="d-inline-block me-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Add Product
                                    </button>
                                    <a href="admin-products.php" class="btn btn-outline-secondary ms-2">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
