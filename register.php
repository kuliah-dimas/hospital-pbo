<?php
require('config.php');
session_start();
$isAuthenticated = $_SESSION['authenticated'];
if ($isAuthenticated) {
  echo "<script>window.location.href = 'index.php';</script>";
}

function validateInputUser($email, $name, $password)
{

  if (empty($name) || trim($name) === '') {
    echo "<script>alert('Name is blank or contains only whitespace.');</script>";
    return false;
  }

  if (empty($email) || trim($email) === '') {
    echo "<script>alert('Email is blank or contains only whitespace.');</script>";
    return false;
  }

  if (empty($password) || trim($password) === '') {
    echo "<script>alert('Password is blank or contains only whitespace.');</script>";
    return false;
  }

  return true;
}

if (isset($_POST['submit'])) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  if (!validateInputUser($email, $name, $password)) {
    echo "<script>window.location.href = 'register.php';</script>";
    return;
  }

  $queryGetIsUserAlreadyExists = "SELECT email FROM user WHERE email = '$email';";
  $result = $conn->query($queryGetIsUserAlreadyExists);
  if ($result) {
    echo "<script>alert('Email telah digunakan.');</script>";
    echo "<script>window.location.href = 'register.php';</script>";
    return;
  }

  $queryInsert = "INSERT INTO user(full_name, email, password) VALUES('$name','$email','$password');";
  $result = $conn->query($queryInsert);
  if ($result) {
    echo "<script>alert('Berhasil daftar.');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
  } else {
    echo "<script>alert('Gagal daftar.');</script>";
    echo "<script>window.location.href = 'register.php';</script>";
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

  <?php include('header.php'); ?>

  <div class="flex justify-center items-center pt-28 mb-10 w-full px-5">
    <form class="flex flex-col items-center gap-5 w-3/4 sm:w-1/2 lg:w-1/4 h-auto p-10 bg-white rounded-lg border-2" method="post">
      <h1 class="text-4xl font-bold">Register</h1>

      <div class="flex flex-col gap-2 w-full">
        <label for="name" class="font-bold">Nama</label>
        <input class="border h-10 px-3 rounded-md" type="text" name="name" placeholder="Masukkan nama anda">
      </div>

      <div class="flex flex-col gap-2 w-full">
        <label for="email" class="font-bold">Email</label>
        <input class="border h-10 px-3 rounded-md" type="text" name="email" placeholder="Masukkan email anda">
      </div>

      <div class="flex flex-col gap-2 w-full">
        <label for="password" class="font-bold">Password</label>
        <input class="border h-10 px-3 rounded-md" type="password" name="password" placeholder="Masukkan password anda">
      </div>

      <button name="submit" class="flex justify-center items-center font-bold
                 text-lg text-white bg-black rounded-full w-full h-10 mt-5">Submit</button>
      <div>Sudah memiliki akun? <span class="text-red-400"><a href="login.php">Login</a></span></div>

    </form>
  </div>

  <script>
    let isHiddenMenu = false;
    const toggleMenu = document.getElementById("toggleMenu");
    const navbarMenu = document.getElementById("navbarMenu");

    function handleWindowResize() {
      const windowWidth = window.innerWidth;
      if (windowWidth > 768) {
        navbarMenu.style.display = "flex";
        navbarMenu.classList.add("flex-row");
      } else {
        navbarMenu.style.display = "none";
      }
    }

    window.addEventListener("resize", handleWindowResize);

    handleWindowResize();

    toggleMenu.addEventListener("click", () => {
      isHiddenMenu = !isHiddenMenu;
      if (isHiddenMenu) {
        navbarMenu.style.display = "none";
      } else {
        navbarMenu.style.display = "flex";
      }
    });
  </script>




</body>


</html>