<?php
require '../config.php';
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

if (!$isAuthenticated) {
    echo "<script>alert('Silahkan login terlebih dahulu.');</script>";
    header("Location: ../login.php");
    exit();
}

if ($role != "admin") {
    echo "<script>alert('Akses tidak diizinkan, silahkan hubungi admin.');</script>";
    header("Location: doctor_list.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor List</title>

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


    <div class="table_body_custom">
        <div>
            <div>
                <a href="/admin/hospital_add.php" class="button_action_custom">Tambah Rumah Sakit</a>
            </div>
            <div></div>
        </div>
        <table border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>Description</th>
                    <th>Rating</th>
                    <th>Rating</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM hospital";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                    <tr>
                        <td><?= $row['hospital_id'] ?></td>
                        <td><?= $row["name"] ?></td>
                        <td><?= $row["address"] ?></td>
                        <td><?= $row["phone"] ?></td>
                        <td><?= $row["email"] ?></td>
                        <td><?= $row["website"] ?></td>
                        <td><?= $row["description"] ?></td>
                        <td><?= $row["rating"] ?></td>
                        <td><?= $row["num_ratings"] ?></td>
                        <td>
                            <form action="/admin/hospital_edit.php?hospital_id=<?= $row["hospital_id"] ?>" method="post">
                                <button type="submit" name="edit" class="button_action_custom">Edit</button>
                            </form>
                            <form action="/admin/hospital_delete.php?hospital_id=<?= $row["hospital_id"] ?>" method="post">
                                <button type="submit" name="submit" class="button_action_custom">Delete</button>
                            </form>
                        </td>
                    </tr>

                <?php endwhile; ?>

            </tbody>
        </table>
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