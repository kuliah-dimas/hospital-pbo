<?php
include('header_admin.php');

$hospitalId = $_GET['hospital_id'];

$queryGetHospitalDetail = "SELECT name, address, phone, email, website, description, rating, num_ratings FROM hospital WHERE hospital_id = '$hospitalId'";
$result = mysqli_query($conn, $queryGetHospitalDetail);
if (mysqli_num_rows($result) > 0) {
    $hospitalData = mysqli_fetch_assoc($result);
    $name = $hospitalData['name'];
    $address = $hospitalData['address'];
    $phone = $hospitalData['phone'];
    $email = $hospitalData['email'];
    $website = $hospitalData['website'];
    $description = $hospitalData['description'];
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $description = $_POST['description'];

    $sqlInsertDataHospital = "UPDATE hospital
    SET name='$name', address='$address', phone='$phone', email='$email', website='$website', description='$description'
    WHERE hospital_id='$hospitalId'";

    $result = mysqli_query($conn, $sqlInsertDataHospital);
    if ($result) {
        echo "<script>alert('Berhasil ubah data rumah sakit.');</script>";
        header("Location: hospital_list.php");
    }
}
?>

<div class="flex justify-center items-center pt-28 mb-10">
    <form class="flex flex-col items-center gap-5 w-3/4 sm:w-1/2 lg:w-1/4 h-auto p-10 bg-white rounded-lg border-2" method="post">
        <h1 class="text-4xl font-bold">Edit Rumah Sakit</h1>

        <div class="flex flex-col gap-2 w-full">
            <label for="name" class="font-bold">Nama</label>
            <input class="border h-10 p-3 rounded-md" type="text" name="name" placeholder="Masukkan nama anda" value="<?= $name ?>">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="address" class="font-bold">Alamat</label>
            <input class="border h-10 p-3 rounded-md" type="address" name="address" placeholder="Masukkan alamat anda" value="<?= $address ?>">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="phone" class="font-bold">Nomor Telepon</label>
            <input class="border h-10 p-3 rounded-md" type="phone" name="phone" placeholder="Masukkan nomor telepon anda" value="<?= $phone ?>">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="email" class="font-bold">Email</label>
            <input class="border h-10 p-3 rounded-md" type="email" name="email" placeholder="Masukkan email anda" value="<?= $email ?>">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="website" class="font-bold">Website</label>
            <input class="border h-10 p-3 rounded-md" type="website" name="website" placeholder="Masukkan website anda" value="<?= $website ?>">
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