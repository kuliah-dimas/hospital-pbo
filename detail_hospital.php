<?php

include('header.php');
require_once('./models/Hospital.php');

$hospitalId = $_GET['hospital_id'];

$hospital = new Hospital($conn);

$resultDetailHospital = $hospital->getDetailHospital($hospitalId);
while ($row = mysqli_fetch_assoc($resultDetailHospital)) {
    $hospitalName = $row["name"];
    $address = $row["address"];
    $phone = $row["phone"];
    $email = $row["email"];
    $website = $row["website"];
    $image = $row["image"];
    $description = $row["description"];
    $rating = $row["rating"];
}

$resultDoctorAtHospital = $hospital->getDoctorHospital($hospitalId);
$resultGetRating = $hospital->getRatingHospital($hospitalId);


if (isset($_POST['submit'])) {
    $rate = $_POST['rate'];
    $comment = $_POST['comment'];

    $queryInsertRatingHospital =
        "INSERT INTO rating(hospital_id, user_id, rating_value, comment) 
    VALUES('$hospitalId', '$userId', '$rate', '$comment');";

    $resultInsert = $conn->query($queryInsertRatingHospital);
    if ($resultInsert) {
        echo "<script>alert('Berhasil memberikan rating.');</script>";
        echo "<script>window.location.href = 'detail_hospital.php?hospital_id=$hospitalId';</script>";
    }
}

?>

<div class="flex justify-center pt-36 gap-10 w-full ">
    <div class="flex flex-col items-center justify-center gap-20 w-3/4 ">
        <div class="flex flex-col items-center gap-10">
            <div>
                <span class="text-3xl font-bold"><?= $hospitalName ?></span>
            </div>
            <div>
                <?php if (isset($image)) : ?>
                    <img class="h-[385px] w-[663px] rounded-lg" src="<?= $image ?>" alt="">
                <?php endif; ?>
            </div>
            <div class="text-justify ">
                <div class="flex items-center justify-center w-full">
                    <div class="xl:w-3/4">
                        <?= $description ?>
                    </div>
                </div>

                <div class="flex flex-col gap-4 mt-10">
                    <div>
                        <div class="font-bold text-lg text-[#294282]">Alamat</div>
                        <div><?= $address ?></div>
                    </div>

                    <div>
                        <div class="font-bold text-lg text-[#294282]">Hubungi Kami</div>
                        <div><?= $phone ?></div>
                    </div>

                    <div>
                        <div class="font-bold text-lg text-[#294282]">Alamat Email</div>
                        <div><?= $email ?></div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col w-full justify-center items-center">
                <div class="flex items-end w-full">
                    <div class="bg-[#9747ff] w-max p-3 font-bold text-white rounded-t-lg">Daftar Dokter
                    </div>
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 32H32C20.7989 32 15.1984 32 10.9202 29.8201C7.15695 27.9027 4.09734 24.8431 2.17987 21.0798C0 16.8016 0 11.201 0 0V32Z" fill="#9747FF" />
                    </svg>
                </div>
                <div class="overflow-x-auto w-full">
                    <table class="bg-white w-full table-auto border-collapse rounded-tr-lg rounded-b-xl">
                        <thead class="h-16 text-white ">
                            <tr class="bg-[#9747ff]  rounded-tr-lg">
                                <th>#</th>
                                <th>Nama Dokter</th>
                                <th>Spesialisasi</th>
                                <th>Nomor Telepon</th>
                            </tr>
                        <tbody>
                            </thead>
                            <?php
                            $count = 1;
                            while ($row = mysqli_fetch_assoc($resultDoctorAtHospital)) :
                            ?>
                                <tr class="text-center ">
                                    <td class="border-r border-r-2 p-3"><?= $count++ ?></td>
                                    <td class="border-r border-r-2 font-bold p-3"><?= $row['doctor_name']; ?></td>
                                    <td class="border-r border-r-2 p-3"><?= $row['specialization']; ?></td>
                                    <td class="border-r border-r-2 p-3"><?= $row["phone"] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <section class="rating w-full mb-20  p-5 bg-white rounded-lg border-2">
                <div class="font-bold text-3xl text-[#294282]">Penilaian Rumah Sakit</div>
                <?php
                while ($row = mysqli_fetch_assoc($resultGetRating)) :
                ?>
                    <div class=" bg-[#F5F5F5]/50 p-4 mt-5 rounded-md border-2">
                        <div class="flex items-center gap-4">
                            <div class="flex">
                                <div class="flex justify-center items-center text-white w-8 h-8 sm:w-[55px] sm:h-[55px] bg-black rounded-full">
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                            <div class="text-xs sm:text-sm">
                                <span class="font-bold"><?= $row['full_name']; ?></span>
                                <div class="flex items-center gap-2">
                                    <div class="rating flex  gap-2 items-center px-3 py-1 bg-[#DCE4FA] rounded-full">
                                        <i class="fa fa-star text-yellow-500"></i>
                                        <div class="font-bold"><?= $row['rating_value'] ?></div>
                                    </div>
                                    <span><?= $row['created_at'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <?= $row['comment']; ?>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div class="mt-10">
                    <form class="rating_card " method="post">


                        <?php if ($isAuthenticated) : ?>
                            <?php if (mysqli_num_rows($resultGetRating) == 0) : ?>
                                <div class="mb-5">
                                    Jadi dirimu yang pertama memberikan rating.
                                </div>
                            <?php endif; ?>

                            <div class="font-bold">
                                Berikan rating..
                            </div>
                            <div class="flex items-center ">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <input type="radio" id="star<?= $i ?>" name="rate" value="<?= $i ?>" class="hidden" />
                                    <label for="star<?= $i ?>" title="text" class="cursor-pointer" onclick="handleRating(<?= $i ?>)">
                                        <svg class="w-6 h-6 fill-current text-gray-500" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.31 6.91.82-5 4.87 1.18 7.19L12 18.77l-6.09 3.22 1.18-7.19-5-4.87 6.91-.82L12 2z">
                                            </path>
                                        </svg>
                                    </label>
                                <?php endfor; ?>
                            </div>
                            <textarea id="comment" name="comment" rows="4" cols="30" class="w-full mt-4 border rounded-lg focus:outline-none focus:border-blue-500 px-3 py-2"></textarea>
                            <button type="submit" name="submit" value="submit" class="mt-4 px-6 py-2 bg-black text-white font-bold rounded-lg focus:outline-none">Submit</button>
                        <?php else : ?>
                            <div class="mt-4 text-sm"><a class="text-[#F56767]" href="login.php">Login</a>
                                untuk memberikan rating.
                            </div>
                        <?php endif ?>
                    </form>
                </div>
            </section>
        </div>

    </div>
</div>

<script>
    function handleRating(rating) {
        const radios = document.querySelectorAll('input[name="rate"]');
        radios.forEach((radio, index) => {
            const starSVG = radio.nextElementSibling.querySelector('.w-6.h-6.fill-current');
            if (index < rating) {
                starSVG.classList.add('text-yellow-500');
                starSVG.classList.remove('text-gray-500');
            } else {
                starSVG.classList.remove('text-yellow-500');
                starSVG.classList.add('text-gray-500');
            }
        });
    }
</script>




<?php include('footer.php'); ?>