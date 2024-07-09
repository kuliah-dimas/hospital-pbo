<?php
require_once('../models/User.php');
session_start();

$user = new User($conn);


$isAuthenticated = $_SESSION['authenticated'] ?? false;
if (!$isAuthenticated) {
    header("Location: ../login.php");
}

$emailSession = $_SESSION['email'] ?? '';
if (isset($emailSession)) {
    $userInfo = $user->getUserDetailByEmail($emailSession)->fetch_assoc();
    $role =  $userInfo["role"];

    if ($role != "admin") {
        header("Location: ../index.php");
        exit();
    }
}


if (isset($_POST['logout'])) {
    $user->logout();
    exit;
}

?>
<nav id="navBar"
    class="z-10 flex flex fixed z-100 items-start w-full justify-between px-10 py-5 backdrop-blur-md bg-white/35">
    <a href="#">
        <div class="brand flex items-center gap-3">
            <img class="h-10 w-10" src="../assets/img/svg/brand_logo.svg" alt="Brand">
            <h1 class="text-2xl font-bold">HOSPITAL</h1>
        </div>
    </a>

    <div class="flex flex-col items-end gap-5 md:gap-0">
        <div class=" h-10 w-10 border flex justify-center items-center md:hidden" id="toggleMenu">
            <div>
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <ul id="navbarMenu" class="flex flex-col md:flex-row items-end justify-center md:items-center gap-5">
            <li><a href="../index.php">Home</a></li>
            <li class="relative">
                <a href="#">Rumah Sakit <i class="fas fa-angle-down"></i></a>
                <ul class="absolute hidden bg-white rounded-md shadow-md text-xs w-max">
                    <li><a href="hospital_list.php" class="block px-4 py-4 hover:bg-gray-100">Daftar Rumah Sakit</a>
                    </li>
                    <li><a href="hospital_add.php" class="block px-4 py-4 hover:bg-gray-100">Tambah Rumah Sakit</a></li>
                </ul>
            </li>
            <li class="relative">
                <a href="#">Dokter <i class="fas fa-angle-down"></i></a>
                <ul class="absolute hidden bg-white rounded-md shadow-md text-xs w-max">
                    <li><a href="doctor_list.php" class="block px-4 py-4 hover:bg-gray-100">Daftar Dokter</a></li>
                    <li><a href="doctor_add.php" class="block px-4 py-4 hover:bg-gray-100">Tambah Dokter</a></li>
                </ul>
            </li>
            <li class="relative">
                <a href="#">Pengguna <i class="fas fa-angle-down"></i></a>
                <ul class="absolute hidden bg-white rounded-md shadow-md text-xs w-max">
                    <li><a href="user_list.php" class="block px-4 py-4 hover:bg-gray-100">Daftar Pengguna</a></li>
                    <li><a href="user_add.php" class="block px-4 py-4 hover:bg-gray-100">Tambah Pengguna</a></li>
                </ul>
            </li>

            <li><a href="message_list.php">Pesan</a></li>


            <?php if ($isAuthenticated) : ?>
            <li>
                <a class="bg-black rounded rounded-full text-white px-5 py-2" href="../index.php">User</a>
            </li>
            <li>
                <form method="post">
                    <button class="bg-black rounded rounded-full text-white px-5 py-2" type="submit"
                        name="logout">Logout</button>
                </form>
            </li>
            <?php else : ?>
            <li>
                <a href="login.php">
                    <div class="bg-black rounded rounded-full text-white px-10 py-2">Login</div>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
