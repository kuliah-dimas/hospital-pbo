<?php include('header.php');

function validateInputUser($email, $password)
{
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

function setSession($email)
{
    $_SESSION['authenticated'] = true;
    $_SESSION['email'] = $email;
}

if (isset($_POST['submit'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!validateInputUser($email, $password)) {
        echo "<script>window.location.href = 'login.php';</script>";
        return;
    }

    $queryInsert = "SELECT user_id FROM user WHERE email = '$email' AND password = '$password' LIMIT 1;";
    $result = $conn->query($queryInsert);
    if ($result) {

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Berhasil login.');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
            setSession($email);
        } else {
            echo "<script>alert('Gagal login, akun tidak ditemukan.');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        }
    } else {
        echo "<script>Gagal login.</script>";
        echo "<script>window.location.href = 'login.php';</script>";
    }
}

?>

<?php  ?>

<div class="flex justify-center items-center pt-28 mb-10 w-full px-5">
    <form
        class="flex flex-col items-center gap-5 w-full mx-2 sm:w-1/2 lg:w-1/4 h-auto p-10 bg-white rounded-lg border-2"
        method="post">
        <h1 class="text-4xl font-bold">Login</h1>

        <div class="flex flex-col gap-2 w-full">
            <label for="email" class="font-bold">Email</label>
            <input class="border h-10 px-3 rounded-md" type="text" name="email" placeholder="Masukkan email anda">
        </div>

        <div class="flex flex-col gap-2 w-full">
            <label for="password" class="font-bold">Password</label>
            <input class="border h-10 px-3 rounded-md" type="password" name="password"
                placeholder="Masukkan password anda">
        </div>

        <button class="flex justify-center items-center font-bold
                 text-lg text-white bg-black rounded-full w-full h-10 mt-5" name="submit">Submit</button>
        <div>Belum memiliki akun? <span class="text-red-400"><a href="register.php">Buat akun</a></span></div>

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