<?php
require 'config.php';

$query = $_GET['query'];
if (isset($query)) {
    $queryGetHospitalByName = "SELECT * FROM hospital WHERE name LIKE '%$query%';";
    $result = $conn->query($queryGetHospitalByName);
} else {
    $queryGetHospital = "SELECT * FROM hospital;";
    $result = $conn->query($queryGetHospital);
}
?>

<?php include('header.php'); ?>

<section class="content flex flex-col items-center pt-32 px-5 sm:px-20">

    <div class="flex items-center bg-white  w-full lg:w-1/2 rounded-lg py-3 border">
        <i class="fas fa-search mx-5"></i>
        <form class="w-full">
            <input class="w-full text-center outline-none rounded-lg -translate-x-5" type="text" name="query" placeholder="Cari Rumah Sakit..." value="<?= $query ?>">
            <button type="submit" style="display: none;"></button>
        </form>
    </div>

    <section class="hospital_list grid grid-flow-row  grid-cols-1  lg:grid-cols-2 xl:grid-cols-3 gap-5 my-10">
        <?php
        while ($row = mysqli_fetch_assoc($result)) :
        ?>
            <div class="hospital_card flex flex-col justify-between  border-2 border-gray-200 rounded-lg items-start bg-white p-3 sm:p-5">
                <div class="flex flex-col gap-5 items-start">
                    <div class="title flex justify-center items-center gap-3">
                        <div class="rating flex justify-center gap-2 items-center px-3 py-1 items-center bg-[#DCE4FA] rounded-md">
                            <i class="fa fa-star text-yellow-500"></i>
                            <div class="font-bold">
                                <?= $row['rating'] ?>
                            </div>
                        </div>
                        <span class="font-bold">
                            <?= $row['name'] ?>
                        </span>
                    </div>
                    <div class="address">
                        <?= $row['address'] ?>
                    </div>
                </div>
                <div class="flex w-full justify-between mt-3">
                    <div class="phone flex items-center gap-3">
                        <i class="fas fa-phone p-2 bg-[#DCE4FA] rounded-md"></i>
                        <span> <?= $row['phone'] ?>
                        </span>
                    </div>
                    <div class="px-5 py-2 border-2 border-[#DCE4FA] rounded-full">
                        Lihat Detail
                    </div>
                </div>
            </div>

        <?php endwhile; ?>
    </section>
</section>


<?php include('footer.php'); ?>