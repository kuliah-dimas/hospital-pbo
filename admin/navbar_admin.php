<?php

session_start();

$isAuthenticated = $_SESSION['authenticated'];
$email = $_SESSION['email'];

function getUserInfo($conn, $email)
{
    $getUserDetail = "SELECT full_name, email, role FROM user WHERE email = '$email'";
    $result = $conn->query($getUserDetail);
    $userInfo = mysqli_fetch_assoc($result);
    return $userInfo;
}

$userInfo = getUserInfo($conn, $email);
$role = $userInfo['role'];


if (!$isAuthenticated && $role != "admin") {
    echo "<script>window.location.href = '../login.php'</script>";
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit;
}

?>

<nav id="navBar" class="flex flex fixed items-start w-full justify-between px-10 py-5 backdrop-blur-md bg-white/35">
    <a href="index.php">
        <div class="brand flex items-center gap-3">
            <img class="h-10 w-10" src="/assets/img/svg/brand_logo.svg" alt="Brand">
            <h1 class="text-2xl font-bold">HOSPITAL</h1>
        </div>
    </a>

    <div>
        <div class="flex items-center justify-end">
            <div id="toggleMenu" class="flex items-center justify-center h-10 w-10 md:hidden">
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <ul id="navbarMenu" class="flex flex-col gap-5 items-end mt-4 md:mt-0 md:flex-row md:items-center md:gap-5">
            <li><a href="index.php">Home</a></li>
            <li><a href="/admin/hospital_list.php">Rumah Sakit</a></li>
            <li><a href="/admin/doctor_list.php">Dokter</a></li>
            <li><a href="/admin/user_list.php">Pengguna</a></li>
            <?php if ($isAuthenticated) : ?>

                <li>
                    <a class="bg-black rounded rounded-full text-white px-5 py-2" href="/admin/hospital_list.php">Home
                        User</a>
                </li>

                <li>
                    <form method="post">
                        <button class="bg-black rounded rounded-full text-white px-10 py-2" type="submit" name="logout">
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