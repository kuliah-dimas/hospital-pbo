<?php

session_start();

$isAuthenticated = isset($_SESSION['authenticated']);
if (!$isAuthenticated) {
    header("Location: ../login.php");
}

$email = isset($_SESSION['email']);
if ($email) {
    $userInfo = getUserInfo($conn, $email);
    $role = $userInfo['role'];
}

function getUserInfo($conn, $email)
{
    $getUserDetail = "SELECT full_name, email, role FROM user WHERE email = '$email'";
    $result = $conn->query($getUserDetail);
    $userInfo = mysqli_fetch_assoc($result);
    return $userInfo;
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit;
}

?>

<nav id="navBar" class="flex flex fixed items-start w-full justify-between px-10 py-5 backdrop-blur-md bg-white/35">
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
            <li><a href="hospital_list.php">Rumah Sakit</a></li>
            <li><a href="doctor_list.php">Dokter</a></li>
            <li><a href="user_list.php">Pengguna</a></li>
            <?php if ($isAuthenticated) : ?>
                <li>
                    <a class="bg-black rounded rounded-full text-white px-5 py-2" href="../index.php">User</a>
                </li>
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