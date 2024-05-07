<?php
include('header_admin.php');

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

<div class="flex justify-center items-center pt-28 mb-10 w-full px-5">
    <form class="flex flex-col items-center gap-5 sm:w-1/2 h-auto p-10 bg-white rounded-lg border-2" method="post">
        <h2 class="text-4xl font-bold">Tambah Pengguna</h2>

        <div class="flex flex-col gap-2 w-full">
            <label for="fullName" class="font-bold">Name</label>
            <input class="border h-10 px-3 rounded-md" type="text" id="fullName" name="fullName" placeholder="Masukkan nama" required>
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="email" class="font-bold">Email</label>
            <input class="border h-10 px-3 rounded-md" type="text" id="email" name="email" placeholder="Masukkan email" required>
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="password" class="font-bold">Password</label>
            <input class="border h-10 px-3 rounded-md" type="text" id="phone" name="password" placeholder="Masukkan password" required>
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="role" class="font-bold">Role</label>
            <div class="flex flex-col h-auto px-3 rounded-md">
                <div class="flex items-center">
                    <input type="radio" id="admin" name="role" class="mr-2" value="admin" required />
                    <label for="admin">Admin</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="basic" name="role" class="mr-2" value="basic" required />
                    <label for="basic">Basic</label>
                </div>
            </div>
        </div>

        <button class="flex justify-center items-center font-bold
                 text-lg text-white bg-black rounded-full w-full h-10 mt-5" type="submit" name="submit" value="submit">Submit</button>
    </form>
</div>

<?php include('footer_admin.php') ?>
