<?php
session_start();
include 'Database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? escapeInput($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Basic validation
    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = 'Please enter both email and password.';
        header('Location: login.php');
        exit;
    }

    // Query database for user with this email
    $query = "SELECT id, first_name, last_name, email, password FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (verifyPassword($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name']
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
        $_SESSION['login_error'] = 'Invalid email or password.';
        header('Location: login.php');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}
