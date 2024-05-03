<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Rumah Sakit</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="absolute -z-10 h-[877px] w-[877px] 
        -translate-x-32 opacity-30 rounded-full 
        inset-0 bg-blue-500 blur-[150px]">
    </div>

    <div class="absolute -z-10 h-[877px] w-[877px] 
        translate-x-[800px] -translate-y-[200px] opacity-30 rounded-full 
        inset-0 bg-pink-500 blur-[200px]">
    </div>

    <div class="absolute -z-10 h-[877px] w-[877px] 
        translate-x-[1500px] -translate-y-[200px] opacity-30 rounded-full 
        inset-0 bg-yellow-500 blur-[300px]">
    </div>

    <nav class="flex flex fixed items-center w-full justify-around py-5 px-10">
        <div class="brand flex items-center gap-3">
            <img class="h-10 w-10" src="/assets/img/svg/brand_logo.svg" alt="Brand">
            <h1 class="text-2xl font-bold">HOSPITAL</h1>
        </div>

        <ul class="flex items-center gap-10">
            <li>Home</li>
            <li><a href="hospital_list.php">Daftar Rumah Sakit</a></li>
            <li>Tentang Kami</li>
            <li>Contact</li>
            <li>
                <div class="bg-black rounded rounded-full  text-white px-10 py-2">Login</div>
            </li>
        </ul>
    </nav>

    <section class="content">
        <section class="search"></section>

        <section class="hospital_list">
            <div>
                <div><i class="fa fa-star"></i> 5</div>
                <span>Siloam Hospitals Asri</span>
            </div>
        </section>
    </section>

</body>

</html>