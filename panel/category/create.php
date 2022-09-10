<?php require_once '../../functions/pdo_connection.php' ;
require_once '../../functions/helpers.php';
require_once '../../functions/check-login.php';


if (isset($_POST['name']) && $_POST['name'] !== ''
&& isset($_FILES['image']) && $_FILES['image']['name'] !== ''
)
{
  
    $allowedMimes = ['png', 'jpeg', 'jpg', 'gif'];
    $imageMime = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    if(!in_array($imageMime, $allowedMimes))
    {
        redirect('panel/category/create.php');
    }
    $basePath = dirname(dirname(__DIR__));
    $image = '/assets/images/category/' . date("Y_m_d_H_i_s") . '.' . $imageMime;
    $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);

    if($category !== false && $image_upload !== false)
    {
     $query = 'INSERT INTO categories SET `name` = ?,  image = ?, created_at = NOW() ;';
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['name'], $image]);
    }

    redirect('panel/category/index.php');
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
            <div class="category-create">
                <h1>ایجاد دسته بندی</h1>
               
               
                <form action="<?= url('panel/category/create.php') ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>
                            <span>نام </span>
                            <input type="text" name="name">
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                            <input id="image-input" type="file" name="image" accept="image/*">
                            <small>
                                <iconify-icon icon="bxs:image-add"></iconify-icon>
                               افزودن عکس
                            </small>
                        </label>
                    </div>
                    <div class="form-group">
                        <button class="success">ثبت</button>
                        <a class="danger" href="<?= url('panel/category/index.php') ?>">انصراف</a>
                    </div>
                </form>
            </div>
        </main>
        <?php require_once '../layouts/sidebar.php' ; ?>
    </div>

    <!-- Iconify -->
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>


    <script src="<?= asset("assets/js/admin-panel/category-create.js") ?>"></script>



</body>


</html>