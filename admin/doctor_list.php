<?php
function getDoctor($conn)
{
    $queryGetDoctor = "SELECT * FROM doctor";
    return $conn->query($queryGetDoctor);
}
$result = getDoctor($conn);

?>

<?php include('header_admin.php'); ?>

<div class="flex flex-col justify-center items-center pt-28 mb-20">
    <div class=" w-3/4">
        <div class="flex items-end">
            <div class="bg-[#9747ff] w-max p-3 font-bold text-white rounded-t-lg">Daftar Dokter</div>
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 32H32C20.7989 32 15.1984 32 10.9202 29.8201C7.15695 27.9027 4.09734 24.8431 2.17987 21.0798C0 16.8016 0 11.201 0 0V32Z" fill="#9747FF" />
            </svg>

        </div>
        <table class="bg-white w-full border-b-2 table-auto border-collapse rounded-tr-lg rounded-b-lg">
            <thead class="h-16 text-white ">
                <tr class="bg-[#9747ff]">
                    <th>#</th>
                    <th>Nama</th>
                    <th>Spesialisasi</th>
                    <th>Phone</th>
                    <th class="rounded-tr-lg">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                while ($doctor = mysqli_fetch_assoc($result)) :
                ?>
                    <tr class="text-center">
                        <td class="border-x border-r-2"><?= $count++ ?></td>
                        <td class="border-r border-r-2 font-bold"><?= $doctor["name"] ?></td>
                        <td class="border-r border-r-2"><?= $doctor["specialization"] ?></td>
                        <td class="border-r border-r-2"><?= $doctor["phone"] ?></td>
                        <td class="border-r border-r-2 p-2 ">
                            <form action="/admin/doctor_edit.php?doctor_id=<?= $doctor["doctor_id"] ?>" method="post">
                                <button type="submit" name="edit" class="bg-[#EEE170] w-[86px] rounded-full px-2 py-1">Edit</button>
                            </form>
                            <form action="/admin/doctor_delete.php?doctor_id=<?= $doctor["doctor_id"] ?>" method="post">
                                <button type="submit" name="submit" class="bg-[#F56767] w-[86px] rounded-full px-2 py-1 mt-2">Delete</button>
                            </form>
                        </td>
                    </tr>

                <?php endwhile; ?>

            </tbody>
        </table>
    </div>
</div>

<?php include('../footer.php'); ?>