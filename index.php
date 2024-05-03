<?php
require 'config.php';
session_start();


if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="absolute -z-10 h-screen w-[550px]
        -translate-x-32 opacity-30 rounded-full
        bg-blue-500 blur-[150px]">
    </div>

    <div class="absolute -z-10 h-screen w-[550px]
        translate-x-[800px] -translate-y-[200px] opacity-30 rounded-full
        bg-pink-500 blur-[200px]">
    </div>

    <div class="absolute -z-10 h-screen
        translate-x-[1500px] -translate-y-[200px] opacity-30 rounded-full
        bg-yellow-500 blur-[300px]">
    </div>

    <nav id="navBar" class="flex flex fixed items-center w-full justify-around py-5 px-10">
        <div class="brand flex items-center gap-3">
            <img class="h-10 w-10" src="/assets/img/svg/brand_logo.svg" alt="Brand">
            <h1 class="text-2xl font-bold">HOSPITAL</h1>
        </div>

        <ul class="flex items-center gap-10 ">
            <li>Home</li>
            <li><a href="hospital_list.php">Daftar Rumah Sakit</a></li>
            <li>Tentang Kami</li>
            <li>Contact</li>
            <li>
                <div class="bg-black rounded rounded-full  text-white px-10 py-2">Login</div>
            </li>
        </ul>
    </nav>

    <section class="content flex items-center justify-center h-screen">
        <div class="flex flex-col gap-10 mx-10">
            <div class="font-bold text-6xl w-max">
                <p class="text-[#294282]">Kami Membantu Anda</p>
                <p>Mencari</p>
                <p class="text-[#F56767]"> Rumah Sakit Terbaik.</p>
            </div>
            <a href="hospital_list.php">
                <div class="flex items-center gap-5 bg-[#294282] w-max px-7 py-2 rounded-full">
                    <p class="font-bold text-white">Cari Rumah Sakit</p>
                    <img src="/assets/img/svg/arrow.svg" alt="Arrow">
                </div>
            </a>
        </div>
        <div>
            <img src="/assets/img/svg/vector_doctor.svg" alt="Doctor">
        </div>
    </section>

    <script>
        const navBar = document.getElementById("navBar")
    </script>
</body>

</html>
