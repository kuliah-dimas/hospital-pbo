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


<div class="flex h-screen justify-center items-center">
    <form class="flex flex-col items-center gap-5 w-3/4 sm:w-1/2 lg:w-1/4 h-auto p-10 bg-white rounded-lg border-2" method="post">

        <h2 class="text-4xl font-bold">Tambah Anggota</h2>

        <div class="flex flex-col gap-2 w-full">
            <label for="fullName" class="font-bold">Name</label>
            <input class="border h-10 px-3 rounded-md" type="text" id="fullName" name="fullName" placeholder="Masukkan nama" required>
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="email" class="font-bold">Email</label>
            <input class="border h-10 px-3 rounded-md" type="text" id="email" name="email" placeholder="Masukkan email" required>
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="password" class="font-bold">Nomor Telepon</label>
            <input class="border h-10 px-3 rounded-md" type="text" id="phone" name="phone" placeholder="Masukkan nomor telepon" required>
        </div>

        <div class="flex flex-col gap-2 w-full">
          <label for="role" class="font-bold">Role</label>
          <div class="flex flex-col border h-auto px-3 rounded-md">
            <div class="flex items-center">
              <input
                type="radio"
                id="admin"
                name="admin"
                required
                class="mr-2"
              />
              <label for="admin">Admin</label>
            </div>
            <div class="flex items-center">
              <input
                type="radio"
                id="basic"
                name="admin"
                required
                class="mr-2"
              />
              <label for="basic">Basic</label>
            </div>
          </div>
        </div>

        <button class="flex justify-center items-center font-bold
                 text-lg text-white bg-black rounded-full w-full h-10 mt-5" type="submit" name="submit" value="submit">Submit</button>
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