<?php
$sqlGetUserDetail = "SELECT full_name, email, role FROM user WHERE user_id = '$userId'";
$result = mysqli_query($conn, $sqlGetUserDetail);
if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    $fullName = $userData['full_name'];
    $email = $userData['email'];
    $role = $userData['role'];
}

if (isset($_POST['submit'])) {
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sqlSelectEmailIsAlreadyExists = "SELECT user_id FROM user WHERE email = '$email' AND user_id != '$userId';";
    $resultEmailIsExists = mysqli_query($conn, $sqlSelectEmailIsAlreadyExists);
    if (mysqli_num_rows($resultEmailIsExists) > 0) {
        echo "<script>alert('Email telah digunakan.');</script>";
        echo "<script>window.location.href='user_list.php';</script>";
        return;
    }

    $sqlInsertDataDokter = "UPDATE user SET full_name='$fullName', email='$email', role='$role' WHERE user_id='$userId'";
    $result = mysqli_query($conn, $sqlInsertDataDokter);
    if ($result) {
        if ($emailSession == $email) {
            session_unset();
            session_destroy();
            echo "<script>alert('Kamu mengubah akun admin, silahkan login kembali.');</script>";
            echo "<script>window.location.href='../login.php';</script>";
            exit();
        } else {
            echo "<script>alert('Berhasil ubah data user.');</script>";
            echo "<script>window.location.href='user_list.php';</script>";
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('header_admin.php'); ?>

<div class="section_form_input">
    <form class="form_custom" method="post">

        <h2>Edit User</h2>

        <div>
            <label for="name">Name</label>
            <input type="text" id="full_name" name="full_name" value="<?= $fullName ?>" required>
        </div>

        <div>
            <label for="email">email</label>
            <input type="text" id="email" name="email" value="<?= $email ?>" required>
        </div>

        <div>
            <label for="role">role</label>
            <input type="tel" id="role" name="role" value="<?= $role ?>" required>
        </div>

        <button type="submit" name="submit" class="button_custom" value="submit">Submit</button>
    </form>
</div>
</body>

</html>