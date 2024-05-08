<?php include('header.php');
require_once("models/Message.php");

$messageObj = new Message($conn);


if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $result = $messageObj->insertMessage($name, $email, $message);
    if ($result) {
        echo "<script>alert('Berhasil kirim pesan.');</script>";
    } else {
        echo "<script>alert('Gagal kirim pesan.');</script>";
    }

    echo "<script>window.location.href='about.php';</script>";
}


?>
<div class="flex flex-col items-center">

    <div class="flex ml-3 pt-28 text-4xl">
        <h1 class="text-right  my-1">Tentang</h1>
        <img src="assets/img/svg/brand_logo.svg" alt="hospital-brand" class="mx-2" />
        <h1 class="font-bold  my-2">HOSPITAL</h1>
    </div>

    <div class="container mt-10">
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <div class="w-full px-5 text-justify sm:mx-0 sm:w-1/2">
                <span class="font-bold">HOSPITAL</span> adalah platform daring yang menyediakan informasi
                terpercaya
                tentang layanan
                kesehatan,
                termasuk daftar rumah sakit dan dokter yang tersedia. Dengan fokus pada akurasi dan kualitas,
                kami
                membantu pengguna dalam memilih layanan kesehatan yang tepat sesuai kebutuhan mereka. Dengan
                ulasan
                dan penilaian pengguna lainnya, kami mempermudah proses pengambilan keputusan untuk memastikan
                pengalaman kesehatan yang memuaskan.
            </div>
            <div class="hidden sm:block  sm:w-1/2">
                <img src="assets/img/svg/search_hospital.svg" alt="search-hospital" />
            </div>
        </div>


        <div class="container mt-10 sm:mt-20">
            <div class="flex flex-col sm:flex-row justify-center h-min p-5 gap-5">
                <div class="bg-slate-100 rounded-xl w-full flex flex-col items-center">
                    <img src="assets/img/svg/eye_icon.svg" class="h-56 w-56" alt="Circle">
                    <div class="text-3xl font-bold">Visi Kami</div>
                    <div class="text-justify p-10 text-sm">
                        Menjadi sumber informasi kesehatan yang terdepan dengan memberikan akses cepat, akurat,
                        dan
                        terpercaya tentang layanan rumah sakit dan dokter, serta mendorong peningkatan kualitas
                        pelayanan
                        kesehatan melalui ulasan dan penilaian pengguna.
                    </div>

                </div>

                <div class="bg-slate-100 rounded-xl w-full flex flex-col justify-center items-center">
                    <img src="assets/img/svg/circle_icon.svg" class="h-56 w-56 mt-5" alt="Circle">
                    <div class="text-3xl font-bold mt-[1em]">Misi Kami</div>
                    <div class="text-justify p-10 text-sm">
                        1. Memberikan informasi kesehatan yang akurat dan terpercaya tentang rumah sakit dan
                        dokter.
                        <br>
                        2. Mempermudah proses pemilihan layanan kesehatan yang sesuai dengan kebutuhan pengguna.
                        <br>
                        3. Menginspirasi peningkatan kualitas pelayanan kesehatan melalui ulasan dan penilaian
                        pengguna.
                        <br>
                        4. Menjadi mitra dalam memastikan pengalaman kesehatan yang memuaskan dan berkualitas
                        bagi
                        masyarakat. <br>
                    </div>

                </div>
            </div>
        </div>

        <div class="container flex flex-col justify-center mt-28">
            <h2 class="text-center text-4xl font-semibold">Apa yang kami lakukan</h2>
            <div class="mt-20">
                <div>
                    <div class="flex flex-wrap  justify-center">
                        <img src="assets/img/rs_information.png" class="w-96 h-96 mx-4 flex justify-center items-center" />
                        <div class="self-center px-4 pr-20 lg:w-1/2">
                            <h1 class="font-semibold text-3xl text-[#294282] pt-4">02</h1>
                            <h2 class="font-semibold text-3xl pt-4">Informasi Berharga.</h2>
                            <p class="py-4">
                                Kami berdedikasi untuk memberikan informasi yang akurat dan terpercaya tentang layanan
                                kesehatan, termasuk daftar rumah sakit dan dokter yang tersedia. Melalui platform kami,
                                kami memudahkan pengguna dalam memilih layanan kesehatan yang sesuai dengan kebutuhan
                                mereka, serta memberikan ruang bagi ulasan dan penilaian pengguna untuk meningkatkan
                                kualitas pelayanan kesehatan secara keseluruhan.
                            </p>
                        </div>

                    </div>
                </div>

                <div class="mt-20">
                    <div class="flex flex-wrap justify-center">
                        <div class="self-center px-4 pl-20 lg:w-1/2">
                            <h1 class="font-semibold text-3xl text-[#294282] pt-4">02</h1>
                            <h2 class="font-semibold text-3xl pt-4">Mengumpulkan Pengalaman Berharga.</h2>
                            <p class="py-4">
                                Kami mengumpulkan kepuasan pasien tidak hanya untuk kepentingan internal rumah sakit,
                                tetapi juga untuk memberikan manfaat yang berguna bagi pasien lainnya. Melalui umpan
                                balik yang kami terima dari pasien, meningkatkan pengalaman pasien
                                yang sedang berobat saat ini, tetapi juga memastikan bahwa pasien di masa mendatang
                                dapat
                                mendapatkan pelayanan yang lebih baik dan lebih memuaskan. Dengan memperhatikan saran
                                dan masukan dari pasien.
                            </p>
                        </div>

                        <img src="assets/img/rating.png" class="w-96 h-96 mx-4 flex justify-center items-center" />


                    </div>
                </div>
            </div>
        </div>


        <div class="flex justify-center items-center pt-28 mb-10 w-full px-5">
            <form class="flex flex-col items-center gap-5 w-full mx-2 sm:mx-0 sm:w-1/2 h-auto p-10 bg-white rounded-lg border-2" method="post">
                <h2 class="text-4xl sm:text-2xl font-bold">Contact Us</h2>

                <div class="flex flex-col gap-2 w-full">
                    <label for="name" class="font-bold">Nama Lengkap</label>
                    <input class="border h-10 p-3 rounded-md" type="text" id="name" name="name" placeholder="Masukkan nama anda" required />
                </div>

                <div class="flex flex-col gap-2 w-full">
                    <label for="email" class="font-bold">Email</label>
                    <input class="border h-10 p-3 rounded-md" type="text" id="email" name="email" placeholder="Masukkan email anda" required />
                </div>

                <div class="flex flex-col gap-2 w-full">
                    <label for="message" class="font-bold">Pesan</label>
                    <textarea class="border h-36 p-3 rounded-md" type="text" name="message" id="message" placeholder="Masukkan pesan anda"></textarea>
                </div>

                <button class="flex justify-center items-center font-bold text-lg text-white bg-black rounded-full w-full h-10 mt-5" type="submit" name="submit" value="submit">
                    Submit
                </button>
            </form>
        </div>
    </div>

</div>
<?php include('footer.php'); ?>