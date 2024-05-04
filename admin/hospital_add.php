<?php
include('header_admin.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $description = $_POST['description'];


    $sqlInsertData = "INSERT INTO hospital (name, address, phone, email, website, description) VALUES ('$name', '$address',
'$phone', '$email', '$website', '$description');";
    $result = mysqli_query($conn, $sqlInsertData);
    if ($result) {
        echo "<script>
alert('Berhasil tambah Rumah Sakit.');
</script>";
        echo "<script>
window.location.href = 'hospital_list.php';
</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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



    <div class="flex h-screen justify-center items-center">
      <form
        class="flex flex-col items-center gap-5 w-3/4 sm:w-1/2 lg:w-1/4 h-auto p-10 bg-white rounded-lg border-2"
        method="post"
      >
        <h2 class="text-4xl font-bold">Tambah Rumah Sakit</h2>

        <div class="flex flex-col gap-2 w-full">
          <label for="fullName" class="font-bold">Name</label>
          <input
            class="border h-10 px-3 rounded-md"
            type="text"
            id="fullName"
            name="fullName"
            placeholder="Masukkan nama"
            required
          />
        </div>

        <div class="flex flex-col gap-2 w-full">
          <label for="alamat" class="font-bold">Alamat</label>
          <input
            class="border h-10 px-3 rounded-md"
            type="text"
            id="alamat"
            name="alamat"
            placeholder="Masukkan alamat"
            required
          />
        </div>

        <div class="flex flex-col gap-2 w-full">
          <label for="phone" class="font-bold">Nomor Telepon</label>
          <input
            class="border h-10 px-3 rounded-md"
            type="text"
            id="phone"
            name="phone"
            placeholder="Masukkan nomor telepon"
            required
          />
        </div>

        <div class="flex flex-col gap-2 w-full">
          <label for="email" class="font-bold">Email</label>
          <input
            class="border h-10 px-3 rounded-md"
            type="text"
            id="email"
            name="email"
            placeholder="Masukkan email"
            required
          />
        </div>

        <div class="flex flex-col gap-2 w-full">
          <label for="website" class="font-bold">Website</label>
          <input
            class="border h-10 px-3 rounded-md"
            type="text"
            id="website"
            name="website"
            placeholder="Masukkan website"
            required
          />
        </div>

        <div class="flex flex-col gap-2 w-full">
          <label for="keterangan" class="font-bold">Keterangan</label>
          <textarea
            class="border h-36 px-3 rounded-md"
            type="text"
            name="keterangan"
            id="keterangan"
            placeholder="Masukan keterangan"
          ></textarea>
        </div>

        <button
          class="flex justify-center items-center font-bold text-lg text-white bg-black rounded-full w-full h-10 mt-5"
          type="submit"
          name="submit"
          value="submit"
        >
          Submit
        </button>
      </form>
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