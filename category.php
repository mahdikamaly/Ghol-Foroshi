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
    <title> محصولات دسته بندی</title>
    <link rel="stylesheet" href="<?= asset('assets/css/index.css')?>">




    <!-- Slick css -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />





</head>

<body>

    <div class="wrapper ">
    <?php
require_once 'layouts/top-nav.php';
require_once 'layouts/header.php';
require_once 'layouts/top-nav-second.php'
?>


        <div class="recent-products">
            <div class="recent-products-header">
                محصولات دسته بندی
            </div>
            <div class="recent-products-body">
            <?php 
                            global $pdo;
                            $query = "SELECT * FROM `categories` WHERE `id`= ? ;";
                            $statement = $pdo->prepare($query);
                            $statement->execute([$_GET['cat_id']]);
                            $category = $statement->fetch();
                            if($category !== false){
                                ?>
        <?php 
                $query = "SELECT * FROM `posts` WHERE `status` = 10 AND cat_id = ? ";
                    $statement = $pdo->prepare($query);
                    $statement ->execute([$_GET['cat_id']]);
                    $posts = $statement->fetchall();
                    foreach($posts as $post){
                    ?>

            <div class="card">
                    <a href="<?= url('detail.php?post_id='.$post->id. '&cat_id='.$post->cat_id) ?>" class="card-header">
                        <img src="<?= asset($post->image) ?>" alt="">
                    </a>
                    <a class="card-body">
                        <div class="name"><?= $post->title ?></div>
                        <div class="price">
                            <span><?= $post->price ?></span>
                            <small>تومان</small>
                        </div>
                    </a>
                    <div class="card-buttons">
                        <a class="shopping-cart" href="#">
                            خرید
                            <iconify-icon icon="bi:bag-fill"></iconify-icon>
                        </a>
                        <a class="<?php print $post->famed == 10 ? 'add-favorite danger' : 'add-favorite' ?>" href="<?= url('cart/famed.php?post_id='.$post->id) ?>">
                            افزودن
                            <iconify-icon icon="bi:heart-fill"></iconify-icon>
                        </a>
                    </div>
                </div>
                <?php } ?> 
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













</body>

</html>