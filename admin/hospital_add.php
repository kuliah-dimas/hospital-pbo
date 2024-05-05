<?php
include('header_admin.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $description = $_POST['description'];


    $queryInsertHospital = "INSERT INTO hospital (name, address, phone, email, website, description) VALUES ('$name', '$address','$phone', '$email', '$website', '$description');";
    $result = mysqli_query($conn, $queryInsertHospital);
    if ($result) {
        echo "<script>alert('Berhasil tambah Rumah Sakit.');</script>";
        echo "<script>window.location.href = 'hospital_list.php';</script>";
        exit();
    }
}
?>


<div class="flex justify-center items-center pt-28 mb-10 w-full px-5">
    <form class="flex flex-col items-center gap-5 sm:w-1/2 lg:w-1/4 h-auto p-10 bg-white rounded-lg border-2" method="post">
        <h2 class="text-4xl font-bold">Tambah Rumah Sakit</h2>

        <div class="flex flex-col gap-2 w-full">
            <label for="name" class="font-bold">Nama</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="name" name="name" placeholder="Masukkan nama rumah sakit" required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="address" class="font-bold">Alamat</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="address" name="address" placeholder="Masukkan alamat rumah sakit" required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="phone" class="font-bold">Nomor Telepon</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="phone" name="phone" placeholder="Masukkan nomor telepon rumah sakit" required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="email" class="font-bold">Email</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="email" name="email" placeholder="Masukkan email" required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="website" class="font-bold">Website</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="website" name="website" placeholder="Masukkan website rumah sakit" required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="description" class="font-bold">Keterangan</label>
            <textarea class="border h-36 p-3 rounded-md" type="text" name="description" id="description" placeholder="Masukan keterangan rumah sakit"></textarea>
        </div>

        <button class="flex justify-center items-center font-bold text-lg text-white bg-black rounded-full w-full h-10 mt-5" type="submit" name="submit" value="submit">
            Submit
        </button>
    </form>
</div>


<?php include('footer_admin.php') ?>