<?php 

require 'config.php';

    $hospital_id = $_GET["hospital_id"];

    $sql = "SELECT * FROM hospital WHERE hospital_id = $hospital_id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row["name"];
        $address = $row["address"];
        $phone = $row["phone"];
        $email = $row["email"];
        $website = $row["website"];
        $description = $row["description"];
        $rating = $row["rating"];
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  
    <section class="background_detail_rs">
        <div class="overlay"></div>
        <span><?= $name ?></span>
    </section>

    <section class="about_rs">
        <span><?= $description ?></span>
    </section>

    <section class="contact mt-5">
        <div class="address">
            <div class="icon">
                <i class="fas fa-map-pin"></i>
                <span>Alamat</span>
            </div>
            <span><?= $address ?></span>
        </div>
        <div class="phone">
            <div class="icon">
                <i class="fas fa-phone"></i>
                <span>Hubungi Kami</span>
            </div>
            <span>Phone <?= $phone ?></span>
        </div>
        <div class="email">
            <div class="icon">
                <i class="fas fa-envelope"></i>
                <span>Email</span>
            </div>
            <span><?= $email ?></span>
        </div>
    </section>

    <section class="table_doctor">
        <table border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Spesialisasi</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql = "
                    SELECT
                        d.doctor_id as doctor_id,
                        d.name AS doctor_name,
                        d.specialization as specialization,
                        d.phone as phone,
                        h.hospital_id,
                        h.name AS hospital_name
                    FROM
                        doctor d
                        INNER JOIN doctor_hospital dh ON d.doctor_id = dh.doctor_id
                        INNER JOIN hospital h ON dh.hospital_id = h.hospital_id
                    WHERE
                    h.hospital_id = '$hospital_id';";

                    $result = mysqli_query($conn, $sql);
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)):
                ?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td><?= $row["doctor_name"]?></td>
                    <td><?= $row["specialization"]?></td>
                    <td><?= $row["phone"]?></td>
                </tr>

                <?php endwhile; ?>
                
            </tbody>
        </table>

    </section>

</body>
</html>