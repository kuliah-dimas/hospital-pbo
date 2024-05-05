<?php
include('header_admin.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];

    $queryInsertDataDokter = "INSERT INTO doctor (name, specialization, phone) VALUES ('$name', '$specialization', '$phone');";
    $result = mysqli_query($conn, $queryInsertDataDokter);
    if ($result) {
        echo "<script>alert('Berhasil tambah dokter.');</script>";
        echo "<script>window.location.href='doctor_list.php';</script>";
    }
}
?>


<div class="flex justify-center items-center pt-28 mb-10 w-full px-5">
    <form class="flex flex-col items-center gap-5 sm:w-1/2 lg:w-1/4 h-auto p-10 bg-white rounded-lg border-2" method="post">
        <h1 class="text-4xl font-bold">Tambah Dokter</h1>

        <div class="flex flex-col gap-2 w-full">
            <label for="name" class="font-bold">Nama</label>
            <input class="border h-10 px-3 rounded-md" type="text" name="name" placeholder="Masukkan nama anda">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="specialization" class="font-bold">Spesialisasi</label>
            <input class="border h-10 px-3 rounded-md" type="specialization" name="specialization" placeholder="Masukkan spesialisasi anda">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="phone" class="font-bold">Nomor Telepon</label>
            <input class="border h-10 px-3 rounded-md" type="phone" name="phone" placeholder="Masukkan nomor telepon anda">
        </div>

        <button class="flex justify-center items-center font-bold
                 text-lg text-white bg-black rounded-full w-full h-10 mt-5" name="submit">Submit</button>

    </form>
</div>

<?php include('footer_admin.php') ?>