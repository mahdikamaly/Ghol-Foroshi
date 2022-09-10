<?php require_once '../../functions/pdo_connection.php' ;
require_once '../../functions/helpers.php';
require_once '../../functions/check-login.php';

global $pdo;

if(!isset($_GET['post_id']))
{
    redirect('panel/post/index.php');
}

//check for exists post id
$query = 'SELECT * FROM posts WHERE id = ?';
$statement = $pdo->prepare($query);
$statement->execute([$_GET['post_id']]);
$post = $statement->fetch();
if($post === false)
{
    redirect('panel/post/index.php');
}

if (
    isset($_POST['title']) && $_POST['title'] !== ''
    && isset($_POST['cat_id']) && $_POST['cat_id'] !== ''
    && isset($_POST['price']) && $_POST['price'] !== ''
    && isset($_FILES['image']) && $_FILES['image']['name'] !== ''
    && isset($_POST['height']) && $_POST['height'] !== ''
    && isset($_POST['shape']) && $_POST['shape'] !== ''
    && isset($_POST['brand']) && $_POST['brand'] !== ''
    && isset($_POST['size']) && $_POST['size'] !== ''
    && isset($_POST['description']) && $_POST['description'] !== ''
) 

 {
    $query = 'SELECT * FROM categories WHERE id = ?';
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['cat_id']]);
    $category = $statement->fetch();

    if(isset($_FILES['image']) && $_FILES['image']['name'] !== '')
    {
        $allowedMimes = ['png', 'jpeg', 'jpg', 'gif'];
        $imageMime = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if(!in_array($imageMime, $allowedMimes))
        {
            redirect('panel/post/index.php');
        }
        $basePath = dirname(dirname(__DIR__));
        if(file_exists($basePath . $post->image))
        {
            unlink($basePath . $post->image);
        }
        $image = '/assets/images/cards/' . date("Y_m_d_H_i_s") . '.' . $imageMime;
        $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);

        if($category !== false && $image_upload !== false)
        {
         $query = 'UPDATE posts SET title = ?, cat_id = ?, price = ?, image = ?,height = ?,`shape` = ?,brand = ?,`description` = ? , `size` = ?, updated_at = NOW() WHERE id = ? ;';
        $statement = $pdo->prepare($query);
        $statement->execute([$_POST['title'], $_POST['cat_id'], $_POST['price'], $image,$_POST['height'],$_POST['shape'],$_POST['brand'],$_POST['description'],$_POST['size'], $_GET['post_id']]);
        }
    }
    else{
        if($category !== false)
        {
         $query = 'UPDATE  posts SET title = ?, cat_id = ?, price = ?,height = ?,`shape` = ?,,brand = ?,`size` = ?, updated_at = NOW() WHERE id = ? ;';
        $statement = $pdo->prepare($query);
        $statement->execute([$_POST['title'], $_POST['cat_id'], $_POST['price'],$_POST['height'],$_POST['shape'],$_POST['color'],$_POST['brand'],$_POST['size'], $_GET['post_id']]);
        }
    }

    redirect('panel/post/index.php');
        
    }




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
        <main>
            <div class="post-create">
                <h1>ایجاد پست </h1>
                <form action="<?= url('panel/post/create.php') ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>
                            <span>نام </span>
                            <input type="text" name="title" value="<?= $post->title ?>">
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <span>قیمت </span>
                            <input type="text" name="price" <?= $post->price ?>>
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <span>سایز </span>
                            <input type="text" name="size" <?= $post->size ?>>
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <span>قد </span>
                            <input type="text" name="height" <?= $post->height ?>>
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <span>اصالت </span>
                            <input type="text" name="shape" <?= $post->shape ?>>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                            <span>توضیحات </span>
                            <input type="text" name="description" <?= $post->description ?>>
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <span>دسته بندی </span>
                            <select name="cat_id" id="">
                            <?php
                        global $pdo;
                        $query = "SELECT * FROM `categories`";
                        $statement = $pdo->prepare($query);
                        $statement->execute();
                        $categories = $statement->fetchAll();
                        foreach ($categories as $category) {
                        ?>
                                 <option value=<?= $category->id ?>><?= $category->name ?></option>
                                 <?php } ?>
                                </select>
                          
                        </label>
                    </div>


                    <div class="form-group">
                        <label>
                            <span>برند </span>
                            <input type="text" name="brand" <?= $post->brand ?>>
                        </label>
                    </div>


                    <div class="form-group">
                        <label>
                            <span>عکس نمایشی : </span>
                            <img id="image-element" src="<?= asset($post->image) ?>">
                            <input id="image-input" type="file" name="image" >
                            <small>
                                <iconify-icon icon="bxs:image-add"></iconify-icon>
                            افزودن عکس
                            </small>
                        </label>
                    </div>


                    <div class="form-group">
                        <button class="success">ثبت</button>
                      
                        <a class="danger" href="<?= url('panel/post/index.php') ?>">انصراف</a>
                    </div>
                </form>
            </div>
        </main>
        <?php require_once '../layouts/sidebar.php' ; ?>
    </div>

    <!-- Iconify -->
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>


    <script src="<?= asset('assets/js/admin-panel/category-create.js') ?>"></script>



</body>


</html>