<?php
require('../config.php');
require_once('../models/Message.php');
require_once('../models/User.php');

session_start();

$user = new User($conn);
$message = new Message($conn);

$isAuthenticated = isset($_SESSION['authenticated']);
$email = $_SESSION['email'];
$messageId = $_GET['message_id'];

$selectUserSession  = $user->getUserDetailByEmail($email);
if (!$selectUserSession) {
    $errorMsg = "Gagal mengambil data user, " . mysqli_error($conn);
    echo "<script>alert('$errorMsg');</script>";
    header("Location: user_list.php");
    exit;
}
if (mysqli_num_rows($selectUserSession) > 0) {
    $userData = $selectUserSession->fetch_assoc();
    $role = $userData['role'];
}

$result = $message->deleteMessage($messageId);
if ($result) {
    echo "<script>alert('Berhasil hapus data pesan.');</script>";
    echo "<script>window.location.href='message_list.php';</script>";
}
