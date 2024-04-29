<?php
require('../config.php');

session_start();
$isAuthenticated = isset($_SESSION['authenticated']);
$email = $_SESSION['email'];
$doctorId = $_GET['doctor_id'];

$sqlSelectUserSession = "SELECT role FROM user WHERE email = '$email' LIMIT 1";
$result = mysqli_query($conn, $sqlSelectUserSession);
if (!$result) {
    $errorMsg = "Gagal mengambil data user, " . mysqli_error($conn);
    echo "<script>alert('$errorMsg');</script>";
    echo "<script>window.location.href='doctor_list.php';</script>";
    exit();
}

if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    $role = $userData['role'];
}

if (!$isAuthenticated) {
    echo "<script>alert('Silahkan login terlebih dahulu.');</script>";
    echo "<script>window.location.href='../index.php';</script>";
    exit();
}

if ($role != "admin") {
    echo "<script>alert('Akses tidak diizinkan, silahkan hubungi admin.');</script>";
    echo "<script>window.location.href='../index.php';</script>";
}


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];

    $sqlInsertDataDokter = "INSERT INTO doctor (name, specialization, phone) VALUES ('$name', '$specialization', '$phone');";
    $result = mysqli_query($conn, $sqlInsertDataDokter);
    if ($result) {
        echo "<script>alert('Berhasil tambah dokter.');</script>";
        echo "<script>window.location.href='doctor_list.php';</script>";
        exit();
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
            <li><a href="/admin/doctor_list.php">Dokter</a></li>
            <li><a href="/admin/hospital_list.php">Rumah Sakit</a></li>
            <li><a href="/admin/user_list.php">Akun Pengguna</a></li>
        </ul>
    </div>

    <div class="section_form_input">
        <form class="form_custom" method="post">

            <h2>Tambah Dokter</h2>

            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div>
                <label for="specialization">Specialization</label>
                <input type="text" id="specialization" name="specialization" required>
            </div>

            <div>
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <button type="submit" name="submit" class="button_custom" value="submit">Submit</button>
        </form>
    </div>
</body>

</html>