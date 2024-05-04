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


<div class="section_form_input">
    <form class="form_custom" method="post">

        <h2>Tambah Rumah Sakit</h2>

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>
        </div>

        <div>
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="website">Website</label>
            <input type="text" id="website" name="website" required>
        </div>

        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" required></textarea>
        </div>

        <button type="submit" name="submit" class="button_custom" value="submit">Submit</button>
    </form>
</div>



<?php include('../footer.php'); ?>