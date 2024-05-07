<?php
include('header_admin.php');

function getHospital($conn)
{
    $queryGetHospital = "SELECT * FROM hospital";
    return $conn->query($queryGetHospital);
}
$result = getHospital($conn);

?>

<div class="flex flex-col justify-center items-center pt-28 mb-20">
    <div class="w-full px-5 md:w-3/4">
        <div class=" flex items-end">
            <div class="bg-[#9747ff] w-max p-3 font-bold text-white rounded-t-lg">Daftar Rumah Sakit</div>
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 32H32C20.7989 32 15.1984 32 10.9202 29.8201C7.15695 27.9027 4.09734 24.8431 2.17987 21.0798C0 16.8016 0 11.201 0 0V32Z" fill="#9747FF" />
            </svg>

        </div>
        <div class="overflow-x-auto">
            <table class="bg-white w-full table-auto border-collapse rounded-tr-lg rounded-b-xl">
                <thead class="h-16 text-white ">
                    <tr class="bg-[#9747ff]  rounded-tr-lg">
                        <th>#</th>
                        <th>Nama</th>
                        <th>No Telp.</th>
                        <th>Email</th>
                        <th>Rating</th>
                        <th class="rounded-tr-lg">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows < 1) : ?>
                        <tr class="text-center h-10">
                            <td colspan="6">Tidak ada data rumah sakit.</td>
                        </tr>
                    <?php else : ?>
                        <?php
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)) :
                        ?>
                            <tr class="text-center">
                                <td class="border-r border-r-2 px-2"><?= $count++ ?></td>
                                <td class="border-r border-r-2 font-bold px-2"><?= $row["name"] ?></td>
                                <td class="border-r border-r-2 px-2"><?= $row["phone"] ?></td>
                                <td class="border-r border-r-2 px-2"><?= $row["email"] ?></td>
                                <td class="border-r border-r-2 p-2">
                                    <div class="flex justify-center items-center ">
                                        <div class="flex justify-center items-center gap-2 bg-[#DCE4FA] rounded-xl px-2 py-1 w-min">
                                            <i class="fa fa-star text-yellow-500"></i>
                                            <div><?= $row["rating"] ?></div>
                                        </div>

                                    </div>
                                </td>
                                <td class="p-3">
                                    <form action="/admin/hospital_edit.php?hospital_id=<?= $row["hospital_id"] ?>" method="post">
                                        <button type="submit" name="edit" class="bg-[#EEE170] w-[86px] rounded-full px-2 py-1">Edit</button>
                                    </form>
                                    <form action="/admin/hospital_delete.php?hospital_id=<?= $row["hospital_id"] ?>" method="post">
                                        <button type="submit" name="submit" class="bg-[#F56767] w-[86px] rounded-full px-2 py-1 mt-2">Delete</button>
                                    </form>
                                </td>
                            </tr>

                        <?php endwhile; ?>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include('footer_admin.php') ?>
