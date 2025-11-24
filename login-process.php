<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    // Basic validation
    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = 'Please enter both email and password.';
        header('Location: login.php');
        exit;
    }
    
    // In a real application, you would:
    // 1. Query database for user with this email
    // 2. Verify password: password_verify($password, $hashedPassword)
    // 3. Set session variables
    
    // For demo purposes, simple check
    // In production, use database and password hashing
    if ($email === 'demo@example.com' && $password === 'demo123') {
        $_SESSION['user'] = [
            'email' => $email,
            'name' => 'Demo User'
        ];
        $_SESSION['success_message'] = 'Login successful!';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['login_error'] = 'Invalid email or password.';
        header('Location: login.php');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}
?>

