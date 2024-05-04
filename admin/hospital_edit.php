<?php
require('../config.php');

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

<?php include('header_admin.php'); ?>

<!-- implement here -->


<?php include('../footer.php.php'); ?>