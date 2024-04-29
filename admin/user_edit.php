<?php
require('../config.php');

session_start();
$isAuthenticated = isset($_SESSION['authenticated']);
$emailSession = $_SESSION['email'];
$userId = $_GET['user_id'];

$sqlSelectUserSession = "SELECT role FROM user WHERE email = '$emailSession' LIMIT 1";
$result = mysqli_query($conn, $sqlSelectUserSession);
if (!$result) {
    $errorMsg = "Gagal mengambil data user, " . mysqli_error($conn);
    echo "<script>alert('$errorMsg');</script>";
    header("Location: user_list.php");
    exit();
}

if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    $role = $userData['role'];
}

if (!$isAuthenticated) {
    echo "<script>alert('Silahkan login terlebih dahulu.');</script>";
    header("Location: ../index.php");
    exit();
}

if ($role != "admin") {
    echo "<script>alert('Akses tidak diizinkan, silahkan hubungi admin.');</script>";
    header("Location: ../index.php");
}


$sqlGetUserDetail = "SELECT full_name, email, role FROM user WHERE user_id = '$userId'";
$result = mysqli_query($conn, $sqlGetUserDetail);
if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    $fullName = $userData['full_name'];
    $email = $userData['email'];
    $role = $userData['role'];
}

if (isset($_POST['submit'])) {
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sqlSelectEmailIsAlreadyExists = "SELECT user_id FROM user WHERE email = '$email' AND user_id != '$userId';";
    $resultEmailIsExists = mysqli_query($conn, $sqlSelectEmailIsAlreadyExists);
    if (mysqli_num_rows($resultEmailIsExists) > 0) {
        echo "<script>alert('Email telah digunakan.');</script>";
        echo "<script>window.location.href='user_list.php';</script>";
        return;
    }

    $sqlInsertDataDokter = "UPDATE user SET full_name='$fullName', email='$email', role='$role' WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sqlInsertDataDokter);
    if ($result) {
        if ($emailSession == $email) {
            session_unset();
            session_destroy();
            echo "<script>alert('Kamu mengubah akun admin, silahkan login kembali.');</script>";
            echo "<script>window.location.href='../login.php';</script>";
            exit();
        } else {
            echo "<script>alert('Berhasil ubah data user.');</script>";
            echo "<script>window.location.href='user_list.php';</script>";
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

    <nav>
        <ul>
            <li><a href="../index.php">Dashboard</a></li>
            <?php if ($role === "admin" && $isAuthenticated) : ?>
                <li id="adminLink"><a href="#">Admin</a></li>
            <?php endif; ?>

        </ul>

        <a href="index.php">
            <div class="brand">Hospital</div>
        </a>


        <?php if ($isAuthenticated) : ?>
            <form method="post">
                <button type="submit" class="button_custom" name="logout">Logout</button>
            </form>
        <?php else : ?>
            <form action="login.php">
                <button type="submit" class="button_custom">Login</button>
            </form>
        <?php endif; ?>
    </nav>

    <div id="adminPopup" class="popup">
        <ul>
            <li><a href="/admin/user_list.php">Dokter</a></li>
            <li><a href="/admin/hospital_list.php">Rumah Sakit</a></li>
            <li><a href="/admin/user_list.php">Akun Pengguna</a></li>
        </ul>
    </div>

    <div class="section_form_input">
        <form class="form_custom" method="post">

            <h2>Edit User</h2>

            <div>
                <label for="name">Name</label>
                <input type="text" id="full_name" name="full_name" value="<?= $fullName ?>" required>
            </div>

            <div>
                <label for="email">email</label>
                <input type="text" id="email" name="email" value="<?= $email ?>" required>
            </div>

            <div>
                <label for="role">role</label>
                <input type="tel" id="role" name="role" value="<?= $role ?>" required>
            </div>

            <button type="submit" name="submit" class="button_custom" value="submit">Submit</button>
        </form>
    </div>
</body>

</html>