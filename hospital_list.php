<?php
include('header.php');

$query = $_GET['query'];
if (isset($query)) {
    $queryGetHospitalByName = "SELECT * FROM hospital WHERE name LIKE '%$query%';";
    $result = $conn->query($queryGetHospitalByName);
} else {
    $queryGetHospital = "SELECT * FROM hospital;";
    $result = $conn->query($queryGetHospital);
}

$isHospitalExists = mysqli_num_rows($result) > 0;
?>

<section class="content flex flex-col items-center pt-32 px-5 sm:px-20 -z-10 ">
    <form class="flex items-center w-full border-2 rounded-lg">
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fa fa-search"></i>
            </span>
            <input class="h-10 w-full pl-10 pr-3 text-center outline-none rounded-lg" type="text" name="query" placeholder="Cari Rumah Sakit..." value="<?= $query ?>">
            <?php if ($query) : ?>
                <span class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <a href="hospital_list.php">
                        <i class="fa fa-times"></i>
                    </a>
                </span>
                <form method="post">

                </form>
            <?php endif; ?>
        </div>
        <button type="submit" style="display: none;"></button>
    </form>


    <section class="hospital_list grid grid-flow-row  grid-cols-1  lg:grid-cols-2 xl:grid-cols-3 gap-5 my-10">
        <?php if (!$isHospitalExists) : ?>
            <div class="font-bold">Rumah sakit tidak ditemukan.</div>
        <?php else : ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="hospital_card flex flex-col justify-between border-2 border-gray-200 rounded-lg items-start bg-white p-3 sm:p-5">
                    <div class="flex flex-col gap-5 items-start">
                        <div class="title flex justify-center items-center gap-3">
                            <div class="rating flex justify-center gap-2 items-center px-3 py-1 bg-[#DCE4FA] rounded-md">
                                <i class="fa fa-star text-yellow-500"></i>
                                <div class="font-bold"><?= $row['rating'] ?></div>
                            </div>
                            <span class="font-bold"><?= $row['name'] ?></span>
                        </div>
                        <div class="address"><?= $row['address'] ?></div>
                    </div>
                    <div class="flex w-full justify-between mt-3">
                        <div class="phone flex items-center gap-3">
                            <i class="fas fa-phone p-2 bg-[#DCE4FA] rounded-md"></i>
                            <span><?= $row['phone'] ?></span>
                        </div>
                        <a href="detail_hospital.php?hospital_id=<?= $row['hospital_id'] ?>" class="px-5 py-2 border-2 border-[#DCE4FA] rounded-full">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>

    </section>
</section>

<?php include('footer.php'); ?>