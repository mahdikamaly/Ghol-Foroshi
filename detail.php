<?php
session_start();
require_once 'functions/pdo_connection.php';
require_once 'functions/helpers.php'

?>



<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه محصول</title>
    <link rel="stylesheet" href="<?= asset('assets/css/index.css')?>">
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

<?php
global $pdo;
$query = "SELECT * FROM `posts` WHERE `status` = 10 AND id = ?";
$statement = $pdo->prepare($query);
$statement->execute([$_GET['post_id']]);
$post = $statement->fetch();

?>
        <div class="product-detail">
            <div class="left">
                <h1 class="name">
                       <?= $post->title ?>
                </h1>
                <h2 class="price">
                    <small>تومان</small>
                    <span><?= $post->price ?></span>
                </h2>
                <ul class="props">
                    <h1>مشخصات محصول : </h1>
                    <li> <small>سایز</small> <span><?= $post->size ?></span> </li>
                    <li> <small>قد</small> <span><?= $post->height ?></span> </li>
                    <li> <small>اصالت</small> <span><?= $post->shape ?></span> </li>
                    <li> <small>برند </small> <span><?= $post->brand ?></span> </li>
                </ul>
                
                <form action="<?url('detail.php') ?>">
               
                <div class="input-count">
                        <div class="plus">
                            <iconify-icon class="success" icon="ant-design:plus-outlined" style="color: green;">
                            </iconify-icon>
                        </div>
                        <!-- <input class="cart-count" type="number" name="count" value="1"> -->
                        <!-- <div class="minus">
                            <iconify-icon icon="ant-design:minus-outlined" style="color: red;"></iconify-icon>
                        </div> -->
                    </div>
                    <a href="<?= url('cart/cartController.php?post_id='.$post->id) ?>" class="success">افزودن به سبد خرید</a>
</form>

            </div>
            <div class="right">
                <div class="image">
                    <img src="<?= asset($post->image) ?>" alt="">
                </div>
                <div class="address">
                <a href="<?= url('index.php') ?>">
                        خانه
                        <iconify-icon icon="akar-icons:chevron-left"></iconify-icon>
                    </a>
                    <?php 
                            global $pdo;
                            $query = "SELECT * FROM `categories` WHERE id = ?";
                            $statement = $pdo->prepare($query);
                            $statement->execute([$_GET['cat_id']]);
                            $category = $statement->fetch();
                            
                            ?>
                    <a href="<?= url('category.php?cat_id='.$post->cat_id) ?>">
                       <?= $category->name ?>
                        <iconify-icon icon="akar-icons:chevron-left"></iconify-icon>
                    </a>
                    
                    
                    <a href="<?= url('detail.php?post_id='.$post->id. '&cat_id='.$post->cat_id) ?>">
                       <?= $post->title ?>
                    </a>
                   
                </div>
                <div class="buttons">
                    <a class="<?php print $post->famed == 10 ? 'add-favorite danger' : 'add-favorite' ?>" href="<?= url('cart/fameddetail.php?post_id='.$post->id) ?>">
                        <!-- <span>افزودن به علاقه مندی</span> -->
                        <iconify-icon icon="bi:heart-fill"></iconify-icon>
                        <!-- <iconify-icon icon="bi:heart"></iconify-icon> -->
                    </a>
                    <a href="#">
                        <!-- <span>اشتراک گزاری</span> -->
                        <iconify-icon icon="bi:share-fill"></iconify-icon>
                    </a>
                </div>
            </div>
        </div>


        <div class="recent-products">
            <div class="recent-products-header">
                محصولات مرتبط
            </div>
            <div class="recent-products-body">
            <?php
global $pdo;
$query = "SELECT `posts`.*, categories.name AS category_name From posts LEFT JOIN categories ON posts.cat_id = categories.id WHERE `status` = 10 ORDER BY `created_at` DESC ;";
$statement = $pdo->prepare($query);
$statement->execute();
$posts = $statement->fetchall();
foreach ($posts as $post) {?>
                <div class="card">
                    <a href="<?= url('detail.php?post_id='. $post->id) ?>" class="card-header">
                        <img src="<?= asset($post->image) ?>" alt="">
                    </a>
                    <a href="<?= url('detail.php?post_id='. $post->id) ?>" class="card-body">
                        <div class="name">گلدان آپارتمانی بونسای</div>
                        <div class="price">
                            <span><?= $post->price ?></span>
                            <small>تومان</small>
                        </div>
                    </a>
                    <div class="card-buttons">
                        <a class="shopping-cart" href="<?= url('cart/cartController.php?post_id='.$post->id) ?>">
                            خرید
                            <iconify-icon icon="bi:bag-fill"></iconify-icon>
                        </a>
                        <a class="add-favoriote" href="<?= url('cart/fameddetail.php?post_id='.$post->id) ?>">
                            افزودن
                            <iconify-icon icon="bi:heart-fill"></iconify-icon>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
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
        <script src="<?= asset('assets/js/main-page/main-page-slider.js') ?>"></script>


        <!-- Detial Page Js -->
        <script src="<?= asset('assets/js/detail-page/detail-page.js')?>"></script>














</body>

</html>