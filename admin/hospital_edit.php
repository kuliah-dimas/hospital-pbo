<?php
require('../config.php');

session_start();
$isAuthenticated = isset($_SESSION['authenticated']);
$email = $_SESSION['email'];
$hospitalId = $_GET['hospital_id'];

$sqlSelectUserSession = "SELECT role FROM user WHERE email = '$email' LIMIT 1";
$result = mysqli_query($conn, $sqlSelectUserSession);
if (!$result) {
    $errorMsg = "Gagal mengambil data user, " . mysqli_error($conn);
    echo "<script>alert('$errorMsg');</script>";
    header("Location: hospital_list.php");
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


$sqlGetHospitalDetail = "SELECT name, address, phone, email, website, description, rating, num_ratings FROM hospital WHERE hospital_id = '$hospitalId'";
$result = mysqli_query($conn, $sqlGetHospitalDetail);
if (mysqli_num_rows($result) > 0) {
    $hospitalData = mysqli_fetch_assoc($result);
    $name = $hospitalData['name'];
    $address = $hospitalData['address'];
    $phone = $hospitalData['phone'];
    $email = $hospitalData['email'];
    $website = $hospitalData['website'];
    $description = $hospitalData['description'];
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $description = $_POST['description'];

    $sqlInsertDataHospital = "UPDATE hospital
    SET name='$name', address='$address', phone='$phone', email='$email', website='$website', description='$description'
    WHERE hospital_id='$hospitalId'";

    $result = mysqli_query($conn, $sqlInsertDataHospital);
    if ($result) {
        echo "<script>alert('Berhasil ubah data rumah sakit.');</script>";
        header("Location: hospital_list.php");
        // exit();
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
            <li><a href="/admin/hospital_list">Rumah Sakit</a></li>
            <li><a href="/admin/user_list.php">Akun Pengguna</a></li>
        </ul>
    </div>



    <div class="section_form_input">
        <form class="form_custom" method="post">

            <h2>Tambah Rumah Sakit</h2>

            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?= $name ?>" required>
            </div>

            <div>
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?= $address ?>" required>
            </div>

            <div>
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" value="<?= $phone ?>" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= $email ?>" required>
            </div>

            <div>
                <label for="website">Website</label>
                <input type="text" id="website" name="website" value="<?= $website ?>" required>
            </div>

            <div>
                <label for="description">Description</label>
                <input type="text" id="description" name="description" value="<?= $description ?>" required>
            </div>

            <button type="submit" name="submit" class="button_custom" value="submit">Submit</button>
        </form>
    </div>


    <script>
        function showAdminPopup() {
            var popup = document.getElementById('adminPopup');
            popup.style.display = popup.style.display === 'none' ? 'block' : 'none';
        }

        document.getElementById('adminLink').addEventListener('click', function(event) {
            event.preventDefault();
            showAdminPopup();
        });
    </script>
</body>

</html>