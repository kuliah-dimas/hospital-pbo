<?php include('header.php');
require_once('models/Article.php');
require_once('helper/convert_time.php');

$article = new Article();
$results =  $article->getArticle(4);
$articles =  $results['articles'];

?>

<section
    class="h-screen flex flex-col-reverse lg:flex-row md:mx-5 xl:mx-36 pt-20 sm:mt-0 items-center justify-evenly sm:justify-between">
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

<section class="article mx-5 mt-10 sm:mt-0 lg:mx-36 flex flex-col gap-5 mb-20">
    <div class="flex w-full justify-between items-center">
        <div class="font-bold text-xl">Baca Artikel Baru</div>
        <a class="bg-gray-300 py-1 px-2 rounded text-xs" href="news.php">Lihat Semua <i class="fa fa-angle-right"
                aria-hidden="true"></i></a>
    </div>
    <div class="article_list grid grid-flow-row grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-5">
        <?php foreach ($articles as $articleData) : ?>
        <div
            class="hospital_card flex flex-col gap-4 justify-between border-2 border-gray-200 rounded-md items-start bg-white p-3 sm:p-5">
            <div class="flex w-full justify-between gap-2 text-xs">
                <div>
                    <?= $articleData['source']['name'] ?>
                </div>
                <div>
                    <?= convertTime($articleData['publishedAt']); ?>
                </div>
            </div>

            <div class="flex flex-col gap-5 items-start">
                <div class="title flex justify-center items-center gap-3">
                    <span class="font-bold"><?= $articleData['title'] ?></span>
                </div>
            </div>

            <div class="w-full flex justify-end">
                <a target="_blank" href="<?= $articleData['url'] ?>" class="bg-gray-300 py-1 px-2 rounded text-xs"
                    href="news.php">Lihat Detail <i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</section>

<?php include('footer.php'); ?>