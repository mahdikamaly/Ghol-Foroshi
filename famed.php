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
    <title> علاقه مندی ها</title>
    <link rel="stylesheet" href="<?= asset('assets/css/index.css') ?>">




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

        <section class="liked-posts">
           
        <h1> علاقه مندی ها</h1>
            <div class="body">
               <!-- stop -->
             <?php
               global $pdo;
$query = "SELECT `posts`.*, categories.name AS category_name From posts LEFT JOIN categories ON posts.cat_id = categories.id WHERE `famed` = 10 ;";
$statement = $pdo->prepare($query);
$statement->execute();
$posts = $statement->fetchall();
foreach ($posts as $post) {?>
               <div class="card">
                    <div class="card-header">
                        <div class="image">
                            <img src="<?= asset($post->image) ?>" alt="">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="name">
                            <?= $post->title ?>
                        </div>
                        <div class="price">
                            <small>تومان</small>
                            <span> <?= $post->price ?></span>
                        </div>
                    </div>
                    <div class="card-buttons">
                        <a class="danger " href="<?= url('cart/famedpage.php?post_id='.$post->id) ?>">
                            <iconify-icon icon="fluent:delete-32-filled"></iconify-icon>حذف از علاقه مندی
                        </a>
                    </div>
                </div>
                <!-- stop -->
            <?php } ?>
            
            </div>
        </section>

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