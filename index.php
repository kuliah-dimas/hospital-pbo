<?php
require 'config.php';
session_start();

    $isAuthenticated = isset($_SESSION['authenticated']);
    $email = $_SESSION['email'];

    if ($isAuthenticated && isset($email)) {
        $sqlSelectUserSession = "SELECT full_name, email, role FROM user WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $sqlSelectUserSession);
        if ($result && mysqli_num_rows($result) > 0) {
            $userData = mysqli_fetch_assoc($result);
            $fullName = $userData['full_name'];
            $userEmail = $userData['email'];
            $role = $userData['role'];
        }
    }

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
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    
    <nav>
        <?php if ($role === "admin" && $isAuthenticated): ?>
        <ul>
            <li><a href="#">Dashboard</a></li>            
            <li id="adminLink"><a href="#">Admin</a></li>
        </ul>
        <?php endif; ?>

        <div class="brand">Hospital</div>


        <?php if ($isAuthenticated): ?>
            <?php if ($role === "admin"): ?>
                <form method="post">
                    <button type="submit" class="button_custom" name="logout">Logout</button>
                </form>
            <?php endif; ?>
        <?php else: ?>
            <form action="login.php">
                <button type="submit" class="button_custom">Login</button>
            </form>
        <?php endif; ?>
    </nav>

    <div id="adminPopup" class="popup">
        <ul>
            <li><a href="#">Tambah Dokter</a></li>
            <li><a href="#">Tambah Rumah Sakit</a></li>
            <li><a href="#">Tambah Dokter ke Rumah Sakit</a></li>
        </ul>
    </div>

<div class="cards-rs">
    <div class="grid-3">
    <?php 
        $sql = "SELECT hospital_id, name, address, phone, rating FROM hospital ORDER BY rating DESC;";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)):
    ?>
        <article class="information [ card-rs ]">
            <span class="tag">Rumah Sakit</span>
            <span class="tag">
                <i class="fa fa-star"></i>
                <span><?= $row["rating"] ?></span>
            </span>
            <h2 class="title"><?= $row["name"] ?></h2>
            <p class="info"><?= $row["address"] ?>.</p>
            <p class="info">No Phone: <?= $row["phone"] ?>.</p>
            
            <a href="detail_rs.php?hospital_id=<?= $row["hospital_id"] ?>">
                <button class="button mt-5">
                    Lihat Detail
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="none">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M16.01 11H4v2h12.01v3L20 12l-3.99-4v3z" fill="currentColor"/>
                        </svg>
                </button>
            </a>
        </article>
    <?php endwhile; ?>
    </div>  
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
