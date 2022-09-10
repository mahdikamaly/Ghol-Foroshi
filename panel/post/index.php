<?php require_once '../../functions/pdo_connection.php' ;
require_once '../../functions/helpers.php';
require_once '../../functions/check-login.php';
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= asset("assets/css/index.css") ?>">

    <title>پنل مدریت</title>
</head>

<body>

    <div class="wrapper-admin-panel">
    <?php require_once '../layouts/header.php' ; ?>
        <main class="posts">
            <div class="create-buttons">
                <a href="<?= url('panel/post/create.php') ?>" class="success">
                    ایجاد پست جدید
                    <iconify-icon icon="uil:create-dashboard"></iconify-icon>
                </a>
                <h1> پست ها</h1>
            </div>
            
            
            <div class="posts-body">
            <?php
                global $pdo;
                $query = "SELECT `posts`.*, categories.name AS category_name From posts LEFT JOIN categories ON posts.cat_id = categories.id";
                $statement = $pdo->prepare($query);
                $statement->execute();
                $posts = $statement->fetchall();
                foreach ($posts as $post) {
                ?>
            <div class="card">
                    <div class="card-header">
                        <img src="<?= asset($post->image) ?>" alt="">
                    </div>
                    <div class="card-body">
                        <div class="row card-id">
                            <label>کد  : </label>
                            <p>
                                <?= $post->id ?>
                            </p>
                        </div>
                        <div class="row card-title">
                            <label>نام  : </label>
                            <p>
                            <?= $post->title ?>
                            </p>
                        </div>
                        <div class="row card-price">
                            <label>قیمت  : </label>
                            <p>
                                <small>تومان</small> <span> <?= $post->price ?></span>
                            </p>
                        </div>
                        <div class="row card-size">
                            <label>سایز  : </label>
                            <p>
                            <?= $post->size ?>
                            </p>
                        </div>
                        <div class="row card-height">
                            <label>قد  : </label>
                            <p>
                                <small>سانتی متر</small>
                                <span> <?= $post->height ?></span>
                            </p>
                        </div>
                        <div class="row card-shape">
                            <label>اصالت: </label>
                            <p>
                            <?= $post->shape ?>
                            </p>
                        </div>
                        <div class="row card-brand">
                            <label>برند  : </label>
                            <p>
                            <?= $post->brand ?>
                            </p>
                        </div>
                        <div class="row card-cat">
                            <label>دسته بندی  : </label>
                            <p>
                            <?= $post->category_name ?>
                            </p>
                        </div>
                    </div>
                    <div class="card-buttons">
                        <a class="warning" href="<?= url('panel/post/edit.php?post_id='.$post->id) ?>">ویرایش</a>
                        <a class="danger" href="<?= url('panel/post/delete.php?post_id='.$post->id) ?>">حذف</a>
                        <a class="<?php print $post->status == 10 ? 'info' : 'dark' ?>" href="<?= url('panel/post/change-status.php?post_id='.$post->id) ?>"><?php print $post->status == 10 ? 'فعال' : 'غیر فعال' ?></a>
                        <a class="<?php print $post->todaySpecial == 10 ? 'success' : 'light' ?>" href="<?= url('panel/post/TodaySpecial.php?post_id='.$post->id) ?>">منتخب</a>
                    </div>
                
        
       
            </div>
            <?php } ?>
        </main>
        <?php require_once '../layouts/sidebar.php' ; ?>
    </div>

    <!-- Iconify -->
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
</body>


</html>