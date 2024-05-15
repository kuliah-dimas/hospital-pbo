<?php

include('header.php');
require_once('./models/Hospital.php');
require_once('./models/Rating.php');

$hospitalId = $_GET['hospital_id'];

$hospital = new Hospital($conn);


$resultDetailHospital = $hospital->getDetailHospital($hospitalId);
while ($row = $resultDetailHospital->fetch_assoc()) {
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

$ratingObj = new Rating($conn);
if (isset($userId)) {
    $resultUserRating = $ratingObj->getRatingByHospitalAndUser($hospitalId, $userId);
    while ($row = $resultUserRating->fetch_assoc()) {
        $userRating = $row['rating_value'];
        $userComment = $row['comment'];
    }
}

if (isset($_POST['submit'])) {
    $rate = $_POST['rate'];
    $comment = $_POST['comment'];

    $resultUserRating = $ratingObj->getRatingByHospitalAndUser($hospitalId, $userId);
    if (mysqli_num_rows($resultUserRating) > 0) {
        echo "<script>alert('Gagal memberikan rating, kamu sudah pernah memberikan rating.');</script>";
        echo "<script>window.location.href = 'detail_hospital.php?hospital_id=$hospitalId';</script>";
        return;
    }

    $result = $hospital->insertRatingHospital($hospitalId, $userId, $rate, $comment);
    if ($result) {
        echo "<script>alert('Berhasil memberikan rating.');</script>";
    } else {
        echo "<script>alert('Gagal memberikan rating.');</script>";
    }

    $ratingObj->calculateAverageRating($hospitalId);

    echo "<script>window.location.href = 'detail_hospital.php?hospital_id=$hospitalId';</script>";
}

if (isset($_POST['submitEdit'])) {
    $rate = $_POST['rate'];
    $comment = $_POST['comment'];

    $result = $hospital->updateUserRatingHospital($hospitalId, $userId, $rate, $comment);
    if ($result) {
        echo "<script>alert('Berhasil ubah rating.');</script>";
    } else {
        echo "<script>alert('Gagal ubah rating.');</script>";
    }

    $ratingObj->calculateAverageRating($hospitalId);
    echo "<script>window.location.href = 'detail_hospital.php?hospital_id=$hospitalId';</script>";
}


?>

<div class="flex justify-center pt-36 gap-10 w-full ">
    <div class="flex flex-col items-center justify-center gap-2 px-5 sm:w-3/4 ">
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
                            while ($row = $resultDoctorAtHospital->fetch_assoc()) :
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
                while ($row = $resultGetRating->fetch_assoc()) :
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
                            <?php if (mysqli_num_rows($resultUserRating) != 0) : ?>
                                <div class="font-bold">Edit Rating</div>
                                <div class="flex items-center mt-3">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <input type="radio" id="star<?= $i ?>" name="rate" value="<?= $i ?>" <?= $i == $userRating ? 'checked' : '' ?> class="hidden" disabled />
                                        <label for="star<?= $i ?>" title="text" class="cursor-pointer" onclick="handleRating(<?= $i ?>)">
                                            <svg class="w-6 h-6 fill-current <?= $i <= $userRating ? 'text-yellow-500' : 'text-gray-500' ?>" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.31 6.91.82-5 4.87 1.18 7.19L12 18.77l-6.09 3.22 1.18-7.19-5-4.87 6.91-.82L12 2z">
                                                </path>
                                            </svg>
                                        </label>
                                    <?php endfor; ?>
                                </div>

                                <textarea id="comment" name="comment" rows="4" cols="30" class="w-full mt-4 border rounded-lg focus:outline-none focus:border-blue-500 px-3 py-2" placeholder="Edit pesan" disabled><?= $userComment ?></textarea>

                                <button type="button" name="edit" value="edit" class="mt-4 px-6 py-2 bg-black text-white font-bold rounded-lg focus:outline-none" onclick="handleEdit()">Edit</button>

                                <button type="submit" name="submitEdit" value="submitEdit" class="hidden mt-4 px-6 py-2 bg-black text-white font-bold rounded-lg focus:outline-none">Submit</button>

                                <button type="button" name="cancel" value="cancel" class="hidden mt-4 px-6 py-2 bg-black text-white font-bold rounded-lg focus:outline-none" onclick="handleCancel()">Cancel</button>

                            <?php else : ?>
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
                                <textarea id="comment" name="comment" rows="4" cols="30" class="w-full mt-4 border rounded-lg focus:outline-none focus:border-blue-500 px-3 py-2" placeholder="Tambahkan pesan"></textarea>

                                <button type="submit" name="submit" value="submit" class="mt-4 px-6 py-2 bg-black text-white font-bold rounded-lg focus:outline-none">Submit</button>
                            <?php endif; ?>
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

            if (radio.disabled == true) {
                return;
            }


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

    function handleEdit() {
        const editBtn = document.querySelector('[name="edit"]');
        const cancelBtn = document.querySelector('[name="cancel"]');
        const submitEditBtn = document.querySelector('[name="submitEdit"]');
        const textarea = document.getElementById('comment');


        editBtn.classList.add('hidden');
        cancelBtn.classList.remove('hidden');
        submitEditBtn.classList.remove('hidden');
        textarea.disabled = false;
        document.querySelectorAll('input[name="rate"]').forEach(radio => radio.disabled = false);
    }

    function handleCancel() {
        const editBtn = document.querySelector('[name="edit"]');
        const cancelBtn = document.querySelector('[name="cancel"]');
        const submitEditBtn = document.querySelector('[name="submitEdit"]');
        const textarea = document.getElementById('comment');

        editBtn.classList.remove('hidden');
        cancelBtn.classList.add('hidden');
        submitEditBtn.classList.add('hidden');
        textarea.disabled = true;
        document.querySelectorAll('input[name="rate"]').forEach(radio => radio.disabled = true);
    }
</script>


<?php include('footer.php'); ?>
