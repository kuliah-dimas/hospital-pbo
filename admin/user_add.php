<?php
require('../config.php');

session_start();
$isAuthenticated = isset($_SESSION['authenticated']);
$email = $_SESSION['email'];

$sqlSelectUserSession = "SELECT role FROM user WHERE email = '$email' LIMIT 1";
$result = mysqli_query($conn, $sqlSelectUserSession);
if (!$result) {
    $errorMsg = "Gagal mengambil data user, " . mysqli_error($conn);
    echo "<script>alert('$errorMsg');</script>";
    echo "<script>window.location.href='user_list.php';</script>";
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
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];


    $sqlSelectEmailIsAlreadyExists = "SELECT user_id FROM user WHERE email = '$email';";
    $resultEmailIsExists = mysqli_query($conn, $sqlSelectEmailIsAlreadyExists);
    if (mysqli_num_rows($resultEmailIsExists) > 0) {
        echo "<script>alert('Email telah digunakan.');</script>";
        echo "<script>window.location.href='user_list.php';</script>";
        return;
    }

    $sqlInsertData = "INSERT INTO user (full_name, email, password, role) VALUES ('$fullName', '$email', '$password', '$role');";
    $result = mysqli_query($conn, $sqlInsertData);
    if ($result) {
        echo "<script>alert('Berhasil tambah Pengguna.');</script>";
        echo "<script>window.location.href='user_list.php';</script>";
        exit();
    }
}
?>

<?php include('header_admin.php'); ?>


<div class="section_form_input">
    <form class="form_custom" method="post">

        <h2>Tambah Anggota</h2>

        <div>
            <label for="fullName">Name</label>
            <input type="text" id="fullName" name="fullName" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="text" id="password" name="password" required>
        </div>

        <div>
            <label for="role">Role</label>
            <input type="text" id="role" name="role" required>
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