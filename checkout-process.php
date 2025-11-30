<?php
session_start();
include 'Database/db.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['login_error'] = 'Please login to complete your purchase.';
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Quick helpers
    $safeString = function ($value) use ($conn) {
        return mysqli_real_escape_string($conn, trim($value));
    };
    $slugify = function ($text) {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        return $text !== '' ? $text : 'item';
    };

    // Get form data
    $user_id = isset($_SESSION['user']['id']) ? (int)$_SESSION['user']['id'] : 0;
    $firstname = $safeString($_POST['firstname']);
    $lastname = $safeString($_POST['lastname']);
    $email = $safeString($_POST['email']);
    $address1 = $safeString($_POST['address']);
    $city = $safeString($_POST['city']);
    $province = $safeString($_POST['province']);
    $postal = $safeString($_POST['postal']);

    // Get cart items from POST
    $cart_items = isset($_POST['cart_items']) ? json_decode($_POST['cart_items'], true) : [];
    
    if (empty($cart_items)) {
        $_SESSION['order_error'] = 'Your cart is empty. Please add items to your cart before checkout.';
        header('Location: checkout.php');
        exit;
    }

    // Calculate totals
    $subtotal = 0;
    foreach ($cart_items as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    $shipping = $subtotal > 50 ? 0 : 9.99;
    $tax = $subtotal * 0.08;
    $total = $subtotal + $shipping + $tax;

    // Generate order number
    $order_number = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

    // Ensure we have a user for foreign key (guests become or reuse a record by email)
    if ($user_id === 0) {
        $lookupUser = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email' LIMIT 1");
        if ($lookupUser && mysqli_num_rows($lookupUser) > 0) {
            $user = mysqli_fetch_assoc($lookupUser);
            $user_id = (int)$user['id'];
        } else {
            // Check which columns exist in the users table
            $columns_query = "SHOW COLUMNS FROM users";
            $columns_result = mysqli_query($conn, $columns_query);
            $available_columns = [];
            if ($columns_result) {
                while ($col = mysqli_fetch_assoc($columns_result)) {
                    $available_columns[] = $col['Field'];
                }
            }
            
            $randomPassword = hashPassword(bin2hex(random_bytes(8)));
            
            // Build insert query based on available columns
            $insertFields = "first_name, last_name, email, password";
            $insertValues = "'$firstname', '$lastname', '$email', '$randomPassword'";
            
            // Add optional fields if they exist
            if (in_array('address', $available_columns)) {
                $insertFields .= ", address";
                $insertValues .= ", '$address1'";
            }
            if (in_array('city', $available_columns)) {
                $insertFields .= ", city";
                $insertValues .= ", '$city'";
            }
            if (in_array('state', $available_columns)) {
                $insertFields .= ", state";
                $insertValues .= ", '$province'";
            }
            if (in_array('postal_code', $available_columns)) {
                $insertFields .= ", postal_code";
                $insertValues .= ", '$postal'";
            }
            
            $insertUser = "INSERT INTO users ($insertFields) VALUES ($insertValues)";
            if (mysqli_query($conn, $insertUser)) {
                $user_id = mysqli_insert_id($conn);
            } else {
                $_SESSION['order_error'] = 'Error creating user for order. Please try again. Error: ' . mysqli_error($conn);
                header('Location: checkout.php');
                exit;
            }
        }
    }

    // Insert order - check which columns exist in orders table
    $order_columns_query = "SHOW COLUMNS FROM orders";
    $order_columns_result = mysqli_query($conn, $order_columns_query);
    $order_available_columns = [];
    if ($order_columns_result) {
        while ($col = mysqli_fetch_assoc($order_columns_result)) {
            $order_available_columns[] = $col['Field'];
        }
    }
    
    // Build order insert query based on available columns
    $orderFields = "user_id, order_number, total_amount, status";
    $orderValues = "$user_id, '$order_number', $total, 'pending'";
    
    // Add subtotal, shipping, tax if columns exist
    if (in_array('subtotal', $order_available_columns)) {
        $orderFields .= ", subtotal";
        $orderValues .= ", $subtotal";
    }
    if (in_array('shipping', $order_available_columns)) {
        $orderFields .= ", shipping";
        $orderValues .= ", $shipping";
    }
    if (in_array('tax', $order_available_columns)) {
        $orderFields .= ", tax";
        $orderValues .= ", $tax";
    }
    
    // Add optional fields if they exist
    if (in_array('payment_status', $order_available_columns)) {
        $orderFields .= ", payment_status";
        $orderValues .= ", 'unpaid'";
    }
    if (in_array('shipping_name', $order_available_columns)) {
        $shipping_name = trim("$firstname $lastname");
        $orderFields .= ", shipping_name";
        $orderValues .= ", '$shipping_name'";
    }
    if (in_array('shipping_firstname', $order_available_columns)) {
        $orderFields .= ", shipping_firstname, shipping_lastname";
        $orderValues .= ", '$firstname', '$lastname'";
    }
    if (in_array('shipping_address1', $order_available_columns) || in_array('shipping_address', $order_available_columns)) {
        $shipping_addr_col = in_array('shipping_address1', $order_available_columns) ? 'shipping_address1' : 'shipping_address';
        $orderFields .= ", $shipping_addr_col";
        $orderValues .= ", '$address1'";
    }
    if (in_array('shipping_city', $order_available_columns)) {
        $orderFields .= ", shipping_city";
        $orderValues .= ", '$city'";
    }
    if (in_array('shipping_state', $order_available_columns)) {
        $orderFields .= ", shipping_state";
        $orderValues .= ", '$province'";
    }
    if (in_array('shipping_province', $order_available_columns)) {
        $orderFields .= ", shipping_province";
        $orderValues .= ", '$province'";
    }
    if (in_array('shipping_postal', $order_available_columns) || in_array('shipping_postal_code', $order_available_columns)) {
        $shipping_postal_col = in_array('shipping_postal', $order_available_columns) ? 'shipping_postal' : 'shipping_postal_code';
        $orderFields .= ", $shipping_postal_col";
        $orderValues .= ", '$postal'";
    }
    
    $insert_order = "INSERT INTO orders ($orderFields) VALUES ($orderValues)";

    if (mysqli_query($conn, $insert_order)) {
        $order_id = mysqli_insert_id($conn);

        // Insert order items
        foreach ($cart_items as $item) {
            $product_id = isset($item['id']) ? (int)$item['id'] : 0;
            $product_name = $safeString($item['name']);
            $product_price = floatval($item['price']);
            $quantity = max(1, intval($item['quantity']));
            $item_subtotal = $product_price * $quantity;

            // Ensure product exists to satisfy FK
            $productExists = false;
            if ($product_id > 0) {
                $checkProduct = mysqli_query($conn, "SELECT id FROM products WHERE id = $product_id LIMIT 1");
                $productExists = $checkProduct && mysqli_num_rows($checkProduct) > 0;
            }

            if (!$productExists) {
                $slugBase = $slugify($product_name);
                $slug = $slugBase . '-' . uniqid();
                $insertProduct = "INSERT INTO products (name, slug, price, stock_quantity, image_path, rating, is_featured, is_active) 
                                  VALUES ('$product_name', '$slug', $product_price, 100, '', 5, 0, 1)";
                if (mysqli_query($conn, $insertProduct)) {
                    $product_id = mysqli_insert_id($conn);
                } else {
                    // Fallback to first product if exists
                    $fallback = mysqli_query($conn, "SELECT id FROM products LIMIT 1");
                    if ($fallback && mysqli_num_rows($fallback) > 0) {
                        $row = mysqli_fetch_assoc($fallback);
                        $product_id = (int)$row['id'];
                    } else {
                        $_SESSION['order_error'] = 'Unable to create product for order items.';
                        header('Location: checkout.php');
                        exit;
                    }
                }
            }

            // Check which columns exist in order_items table
            $order_items_columns_query = "SHOW COLUMNS FROM order_items";
            $order_items_columns_result = mysqli_query($conn, $order_items_columns_query);
            $order_items_available_columns = [];
            if ($order_items_columns_result) {
                while ($col = mysqli_fetch_assoc($order_items_columns_result)) {
                    $order_items_available_columns[] = $col['Field'];
                }
            }
            
            // Build insert query based on available columns
            $itemFields = "order_id, product_id, quantity, unit_price, total_price";
            $itemValues = "$order_id, $product_id, $quantity, $product_price, $item_subtotal";
            
            // Add optional fields if they exist
            if (in_array('product_name', $order_items_available_columns)) {
                $itemFields .= ", product_name";
                $itemValues .= ", '$product_name'";
            }
            if (in_array('product_price', $order_items_available_columns)) {
                $itemFields .= ", product_price";
                $itemValues .= ", $product_price";
            }
            if (in_array('subtotal', $order_items_available_columns)) {
                $itemFields .= ", subtotal";
                $itemValues .= ", $item_subtotal";
            }
            
            $insert_item = "INSERT INTO order_items ($itemFields) VALUES ($itemValues)";
            mysqli_query($conn, $insert_item);
        }

        $_SESSION['order_success'] = true;
        $_SESSION['order_number'] = $order_number;
        header('Location: order-confirmation.php');
        exit;
    } else {
        $_SESSION['order_error'] = 'Error placing order. Please try again.';
        header('Location: checkout.php');
        exit;
    }
} else {
    header('Location: checkout.php');
    exit;
}
