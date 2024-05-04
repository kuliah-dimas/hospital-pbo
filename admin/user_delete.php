<?php
require('../config.php');

session_start();
$isAuthenticated = isset($_SESSION['authenticated']);
$email = $_SESSION['email'];
$userId = $_GET['user_id'];

$sqlSelectUserSession = "SELECT role FROM user WHERE email = '$email' LIMIT 1";
$resultUserSession = mysqli_query($conn, $sqlSelectUserSession);
if (!$resultUserSession) {
    $errorMsg = "Gagal mengambil data user, " . mysqli_error($conn);
    echo "<script>alert('$errorMsg');</script>";
    header("Location: user_list.php");
    exit();
}
if (mysqli_num_rows($resultUserSession) > 0) {
    $userData = mysqli_fetch_assoc($resultUserSession);
    $role = $userData['role'];
}

$getUserIsRelationWithUserUser = "SELECT user_id FROM rating WHERE user_id = '$userId' LIMIT 1";
$resultUserRelation = mysqli_query($conn, $getUserIsRelationWithUserUser);
if ($resultUserRelation && mysqli_num_rows($resultUserRelation) > 0) {
    echo "<script>alert('Tidak dapat dihapus, data user.');</script>";
    echo "<script>window.location.href='user_list.php';</script>";
    exit();
} else {
    $sqlDeleteUser = "DELETE FROM user WHERE user_id = $userId";
    $resultDeleteUser = mysqli_query($conn, $sqlDeleteUser);
    if ($resultDeleteUser) {
        echo "<script>alert('Berhasil hapus data user');</script>";
        echo "<script>window.location.href='user_list.php';</script>";
        exit();
    } else {
        $errorMsg = "Gagal menghapus data user, " . mysqli_error($conn);
        echo "<script>alert('$errorMsg');</script>";
        echo "<script>window.location.href='user_list.php';</script>";
        exit();
    }
}
