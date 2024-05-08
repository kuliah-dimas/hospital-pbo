<?php
session_start();
require_once('models/User.php');

$isAuthenticated = $_SESSION['authenticated'] ?? false;
$email = $_SESSION['email'] ?? '';
$requestUri = $_SERVER['REQUEST_URI'];

$user = new User($conn);
if ($isAuthenticated && !empty($email)) {
    $result = $user->getUserDetailByEmail($email);
    $userInfo = $result->fetch_assoc();
    if ($userInfo) {
        $role = $userInfo['role'];
        $userId = $userInfo['user_id'];
    }

    if (strpos($requestUri, '/admin/') === 0 && $role != "admin") {
        header("Location: ../login.php");
        exit;
    }

    if ($requestUri == "/register.php" || $requestUri == "/login.php") {
        header("Location: index.php");
        exit;
    }
}


if (isset($_POST['logout'])) {
    $user->logout();
    exit;
}


?>


<nav id="navBar" class="z-10 flex flex fixed z-100 items-start w-full justify-between px-10 py-5 backdrop-blur-md bg-white/35">
    <a href="index.php">
        <div class="brand flex items-center gap-3">
            <img class="h-10 w-10" src="assets/img/svg/brand_logo.svg" alt="Brand">
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
            <li><a href="index.php">Home</a></li>
            <li><a href="hospital_list.php">Daftar Rumah Sakit</a></li>
            <li><a href="about.php">Tentang Kami</a></li>
            <?php if ($isAuthenticated) : ?>
                <?php if ($role == "admin") : ?>
                    <li>
                        <a class="bg-black rounded rounded-full text-white px-5 py-2" href="/admin/hospital_list.php">Admin</a>
                    </li>
                <?php endif; ?>
                <li>
                    <form method="post">
                        <button class="bg-black rounded rounded-full text-white px-5 py-2" type="submit" name="logout">
                            Logout
                        </button>
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