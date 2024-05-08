<?php include('header.php');

require_once('models/Article.php');
require_once('helper/convert_time.php');

$article = new Article();
$results =  $article->getArticle(20);
$articles =  $results['articles'];

?>

<section class="content flex flex-col items-center pt-28 px-5 sm:px-20 mb-20">
    <div class="flex flex-col w-full items-start mb-8 gap-3">
        <a href="index.php">
            <div><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</div>
        </a>
        <div class="font-bold text-xl">Baca Artikel Baru</div>
    </div>
    <div class="article_list grid grid-flow-row grid-cols-1 lg:grid-cols-2 xl:grid-cols-4 gap-5">
        <?php foreach ($articles as $articleData) : ?>
            <div class="hospital_card flex flex-col gap-4 justify-between border-2 border-gray-200 rounded-md items-start bg-white p-3 sm:p-5">
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
                    <a target="_blank" href="<?= $articleData['url'] ?>" class="bg-gray-300 py-1 px-2 rounded text-xs" href="news.php">Lihat Detail <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



</section>

<?php include('footer.php'); ?>