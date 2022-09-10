<?php
session_start();

require_once 'functions/pdo_connection.php';
require_once 'functions/helpers.php'?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=asset('assets/css/index.css')?>">

    <!-- Slick css -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

</head>

<body>


<div class="wrapper">

<?php
require_once 'layouts/top-nav.php';
require_once 'layouts/header.php';
require_once 'layouts/top-nav-second.php'
?>


        <section class="intro f-center">
            <div class="left">
                <h3>
                    چون ز جُست و جوی دل نومید گشتم آمدم
                    خفته دیدم دل سِتان با دلسِتان ای عاشقان
                </h3>
                <h1>
                    جذاب‌ترین هدیه را از میان گل و گیاهان گل‌سِتان انتخاب کنید
                </h1>
                <p>
                    تازه‌ترین و زیباترین گل‌ها و گیاهان، لبخند را روی لب‌های عزیزانتون بیارید.
                    ما تلاش می کنیم تا شما بدون نیاز به وقت گذاشتن و بیرون اومدن توی ترافیک شهری و از هرکجای این کره
                    خاکی
                    بتونید تازه‌ترین گل‌ها را در شهر تهران هدیه دهید و یا در محل خودتون تحویل بگیرید.
                </p>
                <div class="buttons">
                    <a href="#" class="buy"> خرید کنید </a>
                    <a href="#" class="more-info"> اطلاعات بیشتر </a>
                </div>
            </div>
            <div class="right">
                <img src="assets/images/main-page/intro/1.png" alt="">
            </div>
        </section>
        <section class="article-one">
            <div class="left item">
                <img src="assets/images/main-page/article-one/1.webp" alt="">
                <div class="description">
                    <h3>حس خوب مراقب</h3>
                    <h1>نگهدارنده کاکتوس باش</h1>
                    <h2>از کوچیک تا بزرگ</h2>
                    <a href="#">اطلاعات بیشتر</a>
                </div>
            </div>
            <div class="right item">
                <img src="assets/images/main-page/article-one/2.webp" alt="">
                <div class="description">
                    <h3>حس خوب مراقب</h3>
                    <h1>نگهدارنده کاکتوس باش</h1>
                    <h2>از کوچیک تا بزرگ</h2>
                    <a href="#">اطلاعات بیشتر</a>
                </div>
            </div>
        </section>



        <section class="categories">
        <?php
global $pdo;
$query = "SELECT * FROM `categories`";
$statement = $pdo->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
foreach ($categories as $category) {
    ?>
        <div class="cat">
                <img src="<?=asset($category->image)?>" alt="">
                <div class="title">
                    <h1><?=$category->name?></h1>
                    <a href="<?=url('category.php?cat_id=' . $category->id)?>">مشاهده</a>
                </div>
            </div>
            <?php }?>
        </section>



        <div class="todays-product">
        <?php
global $pdo;
$query = "SELECT * FROM `categories`";
$statement = $pdo->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();

$query = "SELECT `posts`.*, categories.name AS category_name From posts LEFT JOIN categories ON posts.cat_id = categories.id WHERE `todaySpecial` = 10 ORDER BY `created_at` DESC ;";
$statement = $pdo->prepare($query);
$statement->execute();
$posts = $statement->fetchall();
foreach ($posts as $post) {
    ?>
        <div class="slide">
                <a href="<?= url('detail.php?post_id='.$post->id . '&cat_id='.$category->id) ?>" class="slide-header">
                    <img src="<?= asset($post->image) ?>" alt="">
                </a>
                <div class="slide-body">
                    <div class="header">
                <?=$post->title?>
                </div>
                    <div class="category">
                        <a href="<?= url('category.php?cat_id='. '&cat_id='.$post->cat_id)?>">  <?= $post->category_name ?></a>
                    </div>
                    <div class="body">
                       <?= $post->description ?>
                    </div>
                    <div class="buttons">
                        <a  class="shopping-cart success" href="<?= url('cart/cartController.php?post_id='.$post->id) ?>">
                            خرید
                            <iconify-icon icon="bi:bag"></iconify-icon>
                        </a>
                        <a  class="add-to-favoriote danger" href="<?= url('cart/famed.php?post_id='.$post->id) ?>">
                            علاقه مندی
                            <iconify-icon icon="el:heart-empty"></iconify-icon>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
           
        </div>


        <div class="top-sales">
            <div class="top-sales-header">
                پرفروش ترین محصولات
            </div>

            <div class="top-sales-body">

           <?php
global $pdo;
$query = "SELECT `posts`.*, categories.name AS category_name From posts LEFT JOIN categories ON posts.cat_id = categories.id WHERE `status` = 10 ORDER BY `created_at` DESC ;";
$statement = $pdo->prepare($query);
$statement->execute();
$posts = $statement->fetchall();
foreach ($posts as $post) {
    ?>
            <div href="<?=url('detail.php?post_id=' . $post->id. '&cat_id='.$post->cat_id)?>" class="card">

            <a href="<?= url('detail.php?post_id='.$post->id. '&cat_id='.$post->cat_id) ?>" class="card-header">
                        <img src="<?=asset($post->image)?>" alt="">
</a>
                    <a href="<?= url('detail.php?post_id='.$post->id. '&cat_id='.$post->cat_id) ?>" class="card-body">
                        <div class="name"><?=$post->title?></div>
                        <div class="price">
                            <span><?=$post->price?></span>
                            <small>تومان</small>
                        </div>
                    </a>
                    <div class="card-buttons">
                        <a class="shopping-cart" href="<?= url('cart/cartController.php?post_id='.$post->id) ?>">
                            خرید
                            <iconify-icon icon="bi:bag-fill"></iconify-icon>
                        </a>
                        <a class="<?php print $post->famed == 10 ? 'add-favorite danger' : 'add-favorite info' ?>" href="<?= url('cart/famed.php?post_id='.$post->id) ?>">
                      
                        <?php print $post->famed == 10 ?  'حذف' : 'علاقه مندی' ?>
                           
                        <iconify-icon icon="bi:heart-fill"></iconify-icon>

                        </a>

                    </div>


</div>
<?php }?>
        </div>

 <div class="recent-products">
            <div class="recent-products-header">
                محصولات اخیر
            </div>

            <div class="recent-products-body">
            <?php
global $pdo;
$query = "SELECT `posts`.*, categories.name AS category_name From posts LEFT JOIN categories ON posts.cat_id = categories.id WHERE `status` = 10 ORDER BY `created_at` ASC ;";
$statement = $pdo->prepare($query);
$statement->execute();
$posts = $statement->fetchall();
foreach ($posts as $post) {
    ?>
         <div class="card">
                    <a href="<?= url('detail.php?post_id='.$post->id. '&cat_id='.$post->cat_id) ?>" class="card-header">
                        <img src="<?=asset($post->image)?>" alt="">
</a>
                    <a href="<?= url('detail.php?post_id='.$post->id. '&cat_id='.$post->cat_id) ?>" class="card-body">
                        <div class="name"><?=$post->title?></div>
                        <div class="price">
                            <span><?=$post->price?></span>
                            <small>تومان</small>
                        </div>
</a>
                    <div class="card-buttons">


                    <form action="<?=url('index.php')?>" method="post" enctype="multipart/form-data">




                    <a type="submit" class="shopping-cart" href="<?=url('cart/cartController.php?post_id=') . $post->id?>">
                            خرید
                            <iconify-icon icon="bi:bag-fill"></iconify-icon>


                        </a>



                        <a class="<?php print $post->famed == 10 ? 'add-favorite danger' : 'add-favorite' ?>" href="<?= url('cart/famed.php?post_id='.$post->id) ?>">
                            افزودن
                            <iconify-icon icon="bi:heart-fill"></iconify-icon>
                        </a>
                    </div>
         </div>



        <?php }?>


    </div>
          <?php require_once 'layouts/footer.php'?>

        <!-- JQuery -->
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>




        <!--  Iconify  -->
        <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>


        <!-- Slick Slider Js -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


        <!-- Main Page Sliders -->
        <script src="<?=asset('assets/js/main-page/main-page-slider.js')?>"></script>















    </body>

</html>