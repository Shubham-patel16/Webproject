<?php
// Start session
session_start();

// Simple registration processing (in a real app, this would connect to a database)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmpassword = isset($_POST['confirmpassword']) ? $_POST['confirmpassword'] : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $city = isset($_POST['city']) ? trim($_POST['city']) : '';
    $province = isset($_POST['province']) ? trim($_POST['province']) : '';
    $postal = isset($_POST['postal']) ? trim($_POST['postal']) : '';
    
    // Basic validation
    $errors = [];
    
    if (empty($firstname)) {
        $errors[] = 'First name is required.';
    }
    
    if (empty($lastname)) {
        $errors[] = 'Last name is required.';
    }
    
    if (empty($username)) {
        $errors[] = 'Username is required.';
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email is required.';
    }
    
    if (empty($password) || strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    }
    
    if ($password !== $confirmpassword) {
        $errors[] = 'Passwords do not match.';
    }
    
    if (empty($address)) {
        $errors[] = 'Address is required.';
    }
    
    if (empty($city)) {
        $errors[] = 'City is required.';
    }
    
    if (empty($province)) {
        $errors[] = 'Province is required.';
    }
    
    if (empty($postal)) {
        $errors[] = 'Postal code is required.';
    }
    
    // If no errors, process registration
    if (empty($errors)) {
        // In a real application, you would:
        // 1. Hash the password: $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // 2. Insert into database
        // 3. Send confirmation email
        
        // For demo purposes, just set session and redirect
        $_SESSION['user'] = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'email' => $email
        ];
        
        $_SESSION['success_message'] = 'Registration successful! Welcome to Premium Collection.';
        header('Location: index.php');
        exit;
    } else {
        // Store errors in session
        $_SESSION['registration_errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        header('Location: register.php');
        exit;
    }
} else {
    // If not POST, redirect to register page
    header('Location: register.php');
    exit;
}
?>

