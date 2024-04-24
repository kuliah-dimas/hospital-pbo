<?php 

require 'config.php';

    session_start();

    $isAuthenticated = isset($_SESSION['authenticated']);
    $emailSession = $_SESSION['email'];

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

    if (isset($_POST['submit'])) {

        $rate = $_POST['rate'];
        $comment = $_POST['comment'];

        $sqlGetUserInfo = "SELECT user_id FROM user WHERE email = '$emailSession'";
        $resultUserInfo = mysqli_query($conn, $sqlGetUserInfo);

        if ($resultUserInfo) {
            $row = mysqli_fetch_assoc($resultUserInfo);
            $userID = $row["user_id"];

            $sqlInsertRating = "INSERT INTO rating (hospital_id, user_id, rating_value, comment) 
                                VALUES ('$hospital_id', '$userID', '$rate', '$comment')";
            $resultInsertRating = mysqli_query($conn, $sqlInsertRating); 
            
            if ($resultInsertRating) {
                echo "<script>alert('Berhasil memberikan rating.')</script>";
            } else {
                echo "<script>alert('Gagal memberikan rating.')</script>";
            }
        } else {
            echo "Gagal mengambil informasi user, silahkan login. " . mysqli_error($conn);
            header("Location: login.php");
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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="flex_bg">
        <div class="gradient-color-purple"></div>
    </div>

    <section class="about_detail_rs">
        <span>ABOUT</span>
        <span style="margin-left: 10px;"><i style="color:gold;" class="fa fa-star"></i> <?= $rating ?></span>
    </section>
    
  
    <section class="about_rs">
        <span><?= $name ?></span>    
        <span><?= $description ?></span>
    </section>

    <section class="contact mt-5">
        <div class="address">
            <div>Alamat</div>
            <div><?= $address ?></div>
        </div>
        <div class="phone">
            <div>Hubungi Kami</div>
            <div><?= $phone ?></div>
        </div>
        <div class="email">
            <div>Email</div>
            <div><?= $email ?></div>
        </div>

        <div class="Rating">
            <div>Pernah mengunjungi? beri rating.</div>
            <div class="button_border_governor toggleOpenRating" id="buttonPopupRating">Beri rating</div>
        </div>
        
    </section>



    <div class="popup_card_rating popupRating" id="popupCardRating">
            <h2>Beri Rating dan Komentar</h2>
            <form class="rating_card" method="post" action="detail_rs.php?hospital_id=<?= $hospital_id ?>">
                <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" title="text">1 star</label>
                </div>
                
                <textarea id="comment" name="comment" rows="4" cols="30"></textarea>
                <div style="display:flex;gap:10px;">
                <button type="submit" name="submit" value="submit" class="button_custom" style="margin-top: 10px;">Submit</button>

                    <div class="button_custom toggleCloseRating" style="margin-top: 10px;" >Close</div>
                </div>
            </form>
        </div>

    <section class="table_doctor">
        <div>Data Dokter di <?= $name ?></div>

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



    <script>
        const toggleOpenRating = document.querySelector(".toggleOpenRating");
        const toggleCloseRating = document.querySelector(".toggleCloseRating");
        const ratingCard = document.querySelector(".popupRating");

        toggleOpenRating.addEventListener("click", ()=> {
            ratingCard.style.display = ratingCard.style.display === "block" ? "none" : "block";
        });

        toggleCloseRating.addEventListener("click", ()=> {
            ratingCard.style.display = ratingCard.style.display === "block" ? "none" : "block";
        });

    </script>

</body>
</html>