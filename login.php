<?php
require 'config.php';
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];


  $sqlQuery = "SELECT email FROM user WHERE email = '$email' AND password = '$password' LIMIT 1;";
  $result = mysqli_query($conn, $sqlQuery);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      session_start();
      $_SESSION['authenticated'] = true;
      $_SESSION['email'] = $email;
      echo "<script>alert('Berhasil Login.');</script>";
      header("Location: index.php");
      exit;
    } else {
      echo "<script>alert('Gagal login, silahkan login kembali.');</script>";
    }
  } else {
    echo "<script>alert('Gagal menjalankan query.');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>CodePen - Finance Mobile Application-UX/UI Design Screen One</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="body">
        <div class="screen-1">
            <div class="title">
                <h1>Login</h1>
            </div>

            <form method="POST" action="login.php">
                <div class="textInput">
                    <label for="email">Email Address</label>
                    <div class="sec-2">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" placeholder="johndoe@gmail.com" required />
                    </div>
                </div>

                <div class="textInput">
                    <label for="password">Password</label>
                    <div class="sec-2">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input class="pas" type="password" name="password" placeholder="············" required />
                        <ion-icon class="show-hide" name="eye-outline"></ion-icon>
                    </div>
                </div>

                <button type="submit" name="submit" class="button-submit">
                    Submit
                </button>
            </form>

            <div class="w-full center">
                <span><a href="/register.php">Register</a></span>
            </div>
        </div>
    </div>
</body>

<script src="./assets/js/script.js"></script>

</html>