<?php
require('../config.php');

$doctorId = $_GET['doctor_id'];

$sqlGetDoctorDetail = "SELECT name, specialization, phone FROM doctor WHERE doctor_id = '$doctorId'";
$result = mysqli_query($conn, $sqlGetDoctorDetail);
if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    $name = $userData['name'];
    $specialization = $userData['specialization'];
    $phone = $userData['phone'];
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];

    $sqlInsertDataDokter = "UPDATE doctor SET name='$name', specialization='$specialization', phone='$phone' WHERE doctor_id='$doctorId'";
    $result = mysqli_query($conn, $sqlInsertDataDokter);
    if ($result) {
        echo "<script>alert('Berhasil ubah data dokter.');</script>";
        header("Location: doctor_list.php");
    }
}
?>

<?php include('header_admin.php'); ?>

<div class="flex h-screen justify-center items-center">
    <form class="flex flex-col items-center gap-5 w-3/4 sm:w-1/2 lg:w-1/4 h-auto p-10 bg-white rounded-lg border-2"
        method="post">
        <h1 class="text-4xl font-bold">Edit Dokter</h1>

        <div class="flex flex-col gap-2 w-full">
            <label for="name" class="font-bold">Nama</label>
            <input class="border h-10 px-3 rounded-md" type="text" name="name" placeholder="Masukkan nama anda"
                value="<?= $name ?>">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="specialization" class="font-bold">Spesialisasi</label>
            <input class="border h-10 px-3 rounded-md" type="specialization" name="specialization"
                placeholder="Masukkan spesialisasi anda" value="<?= $specialization ?>">
        </div>
        <div class="flex flex-col gap-2 w-full">
            <label for="phone" class="font-bold">Nomor Telepon</label>
            <input class="border h-10 px-3 rounded-md" type="number" name="phone"
                placeholder="Masukkan nomor telepon anda" value="<?= $phone ?>">
        </div>

        <button class="flex justify-center items-center font-bold
                 text-lg text-white bg-black rounded-full w-full h-10 mt-5" name="submit">Submit</button>

    </form>


</div>
</body>

</html>