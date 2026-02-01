<?php
session_start();
include '../backend/connect.php';

$email = $_POST['email'];
$password = $_POST['password'];

$res = $conn->query("SELECT * FROM admins WHERE email='$email' LIMIT 1");

if ($res && $res->num_rows === 1) {
    $admin = $res->fetch_assoc();

    if (password_verify($password, $admin['password'])) {

        // 🔥 THIS IS THE FIX 🔥
        $_SESSION['role']  = 'admin';
        $_SESSION['email'] = $admin['email'];
        $_SESSION['name']  = $admin['first_name'];

        header("Location: ../admin/dasbord.php");
        exit();
    }
}

// if login fails
header("Location: login.php?error=1");
exit();
