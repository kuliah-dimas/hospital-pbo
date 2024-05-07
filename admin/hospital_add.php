<?php include('header_admin.php');
require_once('../models/Hospital.php');

$hospital = new Hospital($conn);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $image = $_POST['image'];
    $website = $_POST['website'];
    $description = $_POST['description'];

    $result = $hospital->insertHospital($name, $address, $phone, $email, $image, $website, $description);
    if ($result) {
        echo "<script>alert('Berhasil tambah Rumah Sakit.');</script>";
        echo "<script>window.location.href = 'hospital_list.php';</script>";
        exit();
    }
}
?>


<div class="flex justify-center items-center pt-28 mb-10 w-full px-5">
    <form class="flex flex-col items-center gap-5 sm:w-1/2 h-auto p-10 bg-white rounded-lg border-2" method="post">
        <h2 class="text-4xl sm:text-2xl font-bold">Tambah Rumah Sakit</h2>

        <div class="flex flex-col gap-2 w-full">
            <label for="name" class="font-bold">Nama</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="name" name="name" placeholder="Masukkan nama" required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="address" class="font-bold">Alamat</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="address" name="address" placeholder="Masukkan alamat" required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="phone" class="font-bold">Nomor Telepon</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="phone" name="phone" placeholder="Masukkan nomor telepon" required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="email" class="font-bold">Email</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="email" name="email" placeholder="Masukkan email" required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="image" class="font-bold">URL Gambar</label>
            <input class="border h-10 p-3 rounded-md" type="text" name="image" placeholder="Masukkan gambar">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="website" class="font-bold">Website</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="website" name="website" placeholder="Masukkan website" required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="description" class="font-bold">Keterangan</label>
            <textarea class="border h-36 p-3 rounded-md" type="text" name="description" id="description" placeholder="Masukan keterangan"></textarea>
        </div>

        <button class="flex justify-center items-center font-bold text-lg text-white bg-black rounded-full w-full h-10 mt-5" type="submit" name="submit" value="submit">
            Submit
        </button>
    </form>
</div>


<?php include('footer_admin.php') ?>