<?php
include('header_admin.php');
require_once('../models/Message.php');

$message = new Message($conn);
$result = $message->getAllMessage();

?>


<div class="flex flex-col justify-center items-center pt-28 mb-20">
    <div class="w-full px-5 md:w-3/4">
        <div class=" flex items-end">
            <div class="bg-[#9747ff] w-max p-3 font-bold text-white rounded-t-lg">Daftar Pesan Masuk</div>
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
                        <th>Email</th>
                        <th>Pesan</th>
                        <th class="rounded-tr-lg">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows < 1) : ?>
                        <tr class="text-center h-10">
                            <td colspan="6">Tidak ada data pesan.</td>
                        </tr>
                    <?php else : ?>
                        <?php
                        $count = 1;
                        while ($row = $result->fetch_assoc()) :
                        ?>
                            <tr class="text-center">
                                <td class="border-r border-r-2 px-2 px-2"><?= $count++ ?></td>
                                <td class="border-r border-r-2 px-2 font-bold"><?= $row["name"] ?></td>
                                <td class="border-r border-r-2 px-2"><?= $row["email"] ?></td>
                                <td class="border-r border-r-2 px-2"><?= $row["message"] ?></td>
                                <td class="p-3">
                                    <form action="/admin/message_delete.php?message_id=<?= $row["message_id"] ?>" method="post">
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