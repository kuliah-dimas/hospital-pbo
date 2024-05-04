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


<div class="flex h-screen justify-center items-center">
    <form class="flex flex-col items-center gap-5 w-3/4 sm:w-1/2 lg:w-1/4 h-auto p-10 bg-white rounded-lg border-2"
        method="post">
        <h2 class="text-4xl font-bold">Tambah Rumah Sakit</h2>

        <div class="flex flex-col gap-2 w-full">
            <label for="fullName" class="font-bold">Name</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="fullName" name="fullName"
                placeholder="Masukkan nama" required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="alamat" class="font-bold">Alamat</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="alamat" name="alamat"
                placeholder="Masukkan alamat" required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="phone" class="font-bold">Nomor Telepon</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="phone" name="phone"
                placeholder="Masukkan nomor telepon" required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="email" class="font-bold">Email</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="email" name="email" placeholder="Masukkan email"
                required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="website" class="font-bold">Website</label>
            <input class="border h-10 p-3 rounded-md" type="text" id="website" name="website"
                placeholder="Masukkan website" required />
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="keterangan" class="font-bold">Keterangan</label>
            <textarea class="border h-36 p-3 rounded-md" type="text" name="keterangan" id="keterangan"
                placeholder="Masukan keterangan"></textarea>
        </div>

        <button
            class="flex justify-center items-center font-bold text-lg text-white bg-black rounded-full w-full h-10 mt-5"
            type="submit" name="submit" value="submit">
            Submit
        </button>
    </form>
</div>


<?php include('footer_admin.php') ?>