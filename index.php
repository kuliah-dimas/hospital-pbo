<?php include('header.php'); ?>

<section class="content flex flex-col-reverse lg:flex-row md:mx-5 pt-20 sm:mt-0 items-center justify-evenly h-screen">
    <div class="flex flex-col gap-10">
        <div class="flex flex-col gap-4 font-bold text-4xl md:text-6xl lg:text-5xl w-max">
            <p class="text-[#294282]">Kami Membantu Anda</p>
            <p>Mencari</p>
            <p class="text-[#F56767]"> Rumah Sakit Terbaik.</p>
        </div>
        <a href="hospital_list.php" class="w-min">
            <div class="flex items-center gap-5 bg-[#294282] w-max px-7 py-2 rounded-full">
                <p class="font-bold text-white">Cari Rumah Sakit</p>
                <img src="assets/img/svg/arrow.svg" alt="Arrow">
            </div>
        </a>
    </div>
    <div class="sm:m-10 md:m-0">
        <img src="assets/img/svg/vector_doctor.svg" alt="Doctor">
    </div>
</section>

<?php include('footer.php'); ?>