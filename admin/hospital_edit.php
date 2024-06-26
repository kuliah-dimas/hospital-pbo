<?php
include('header_admin.php');
require_once('../models/Hospital.php');

$hospitalId = $_GET['hospital_id'];
if (!isset($hospitalId)) {
    header("Location: hospital_list.php");
    exit;
}

$hospital = new Hospital($conn);

$result = $hospital->getDetailHospital($hospitalId);
if (mysqli_num_rows($result) > 0) {
    $hospitalData = $result->fetch_assoc();
    $name = $hospitalData['name'];
    $address = $hospitalData['address'];
    $phone = $hospitalData['phone'];
    $email = $hospitalData['email'];
    $image = $hospitalData['image'];
    $website = $hospitalData['website'];
    $description = $hospitalData['description'];
} else {
    header("Location: hospital_list.php");
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $image = $_POST['image'];
    $website = $_POST['website'];
    $description = $_POST['description'];

    $result =  $hospital->updateHospital($hospitalId, $name, $address, $phone, $email, $image, $website, $description);
    if ($result) {
        echo "<script>alert('Berhasil ubah data rumah sakit.');</script>";
        echo "<script>window.location.href='hospital_list.php';</script>";
    }
}
?>


<div class="flex justify-center items-center pt-28 mb-10 w-full px-5">
    <form class="flex flex-col items-center gap-5 sm:w-1/2 h-auto p-10 bg-white rounded-lg border-2" method="post">
        <h1 class="text-4xl font-bold">Edit Rumah Sakit</h1>

        <div class="flex flex-col gap-2 w-full">
            <label for="name" class="font-bold">Nama</label>
            <input class="border h-10 p-3 rounded-md" type="text" name="name" placeholder="Masukkan nama" value="<?= $name ?>">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="address" class="font-bold">Alamat</label>
            <input class="border h-10 p-3 rounded-md" type="address" name="address" placeholder="Masukkan alamat" value="<?= $address ?>">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="phone" class="font-bold">Nomor Telepon</label>
            <input class="border h-10 p-3 rounded-md" type="phone" name="phone" placeholder="Masukkan nomor telepon" value="<?= $phone ?>">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="email" class="font-bold">Email</label>
            <input class="border h-10 p-3 rounded-md" type="email" name="email" placeholder="Masukkan email" value="<?= $email ?>">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="image" class="font-bold">URL Gambar</label>
            <input class="border h-10 p-3 rounded-md" type="text" name="image" placeholder="Masukkan gambar" value="<?= $image ?>">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="website" class="font-bold">Website</label>
            <input class="border h-10 p-3 rounded-md" type="website" name="website" placeholder="Masukkan website" value="<?= $website ?>">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="description" class="font-bold">Deskripsi</label>
            <textarea rows="30" cols="20" class="border h-36 p-3 rounded-md" name="description" placeholder="Masukkan deskripsi"><?= $description ?></textarea>
        </div>

        <button class="flex justify-center items-center font-bold
                 text-lg text-white bg-black rounded-full w-full h-10 mt-5" name="submit">Submit</button>

    </form>
</div>

<?php include('footer_admin.php') ?>