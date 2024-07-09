<?php
include('header_admin.php');
require_once('../models/User.php');

$userId = $_GET['user_id'] ?? 0;
if ($userId === 0) {
    header("Location: user_list.php");
    exit;
}

$user = new User($conn);
$result = $user->getUserDetail($userId);
if (mysqli_num_rows($result) > 0) {
    $userData = $result->fetch_assoc();
    $fullName = $userData['full_name'];
    $email = $userData['email'];
    $role = $userData['role'];
} else {
    header("Location: user_list.php");
    exit;
}

if (isset($_POST['submit'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $isEmailAlreadyExists = $user->getUserAlreadyEmailRegistered($email, $userId);
    if (mysqli_num_rows($isEmailAlreadyExists) > 0) {
        echo "<script>alert('Email telah digunakan.');</script>";
        echo "<script>window.location.href='user_list.php';</script>";
        exit;
    }

    $result = $user->updateUser($userId, $fullName, $email, $role);
    if ($result) {
        if ($emailSession == $email) {
            session_unset();
            session_destroy();
            echo "<script>alert('Kamu mengubah akun admin, silahkan login kembali.');</script>";
            echo "<script>window.location.href='../login.php';</script>";
            exit;
        } else {
            echo "<script>alert('Berhasil ubah data user.');</script>";
            echo "<script>window.location.href='user_list.php';</script>";
            exit;
        }
    }
}
?>


<div class="flex justify-center items-center pt-28 mb-10 w-full px-5">
    <form class="flex flex-col items-center gap-5 sm:w-1/2 h-auto p-10 bg-white rounded-lg border-2" method="post">
        <h2 class="text-4xl font-bold">Edit Pengguna</h2>

        <div class="flex flex-col gap-2 w-full">
            <label for="fullName" class="font-bold">Name</label>
            <input class="border h-10 px-3 rounded-md" type="text" id="fullName" name="fullName"
                placeholder="Masukkan nama lengkap" value="<?= $fullName ?>" required>
        </div>

        <div class=" flex flex-col gap-2 w-full">
            <label for="email" class="font-bold">Email</label>
            <input class="border h-10 px-3 rounded-md" type="text" id="email" name="email" placeholder="Masukkan email"
                value="<?= $email ?>" required>
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="role" class="font-bold">Role</label>
            <div class="flex flex-col h-auto px-3 rounded-md">
                <div class="flex items-center">
                    <input type="radio" id="admin" name="role" class="mr-2" value="admin"
                        <?php echo ($role == 'admin') ? 'checked' : ''; ?> required />
                    <label for="admin">Admin</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="basic" name="role" class="mr-2" value="basic"
                        <?php echo ($role == 'basic') ? 'checked' : ''; ?> required />
                    <label for="basic">Basic</label>
                </div>
            </div>
        </div>


        <button class="flex justify-center items-center font-bold
                 text-lg text-white bg-black rounded-full w-full h-10 mt-5" type="submit" name="submit"
            value="submit">Submit</button>
    </form>
</div>

<?php include('footer_admin.php') ?>
