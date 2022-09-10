<?php require_once '../../functions/pdo_connection.php' ;
require_once '../../functions/helpers.php';
require_once '../../functions/check-login.php';
global $pdo;

        if(!isset($_GET['cat_id']))
        {
            redirect('panel/category/index.php');
        }

        //check for exists post id
        $query = 'SELECT * FROM categories WHERE id = ?';
        $statement = $pdo->prepare($query);
        $statement->execute([$_GET['cat_id']]);
        $category = $statement->fetch();
        if($category === false)
        {
            redirect('panel/category/index.php');
        }

        if(
            isset($_POST['name']) && $_POST['name'] !== '' 
        )
        {
        if(isset($_FILES['image']) && $_FILES['image']['name'] !== '')
        {
            $allowedMimes = ['png', 'jpeg', 'jpg', 'gif'];
            $imageMime = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            if(!in_array($imageMime, $allowedMimes))
            {
                redirect('panel/category/index.php');
            }
            $basePath = dirname(dirname(__DIR__));
            if(file_exists($basePath . $category->image))
            {
                unlink($basePath . $category->image);
            }
            $image = '/assets/images/category/' . date("Y_m_d_H_i_s") . '.' . $imageMime;
            $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);

            if($category !== false && $image_upload !== false)
            {
             $query = 'UPDATE  categories SET `name` = ?,image = ?, updated_at = NOW() WHERE id = ? ;';
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['name'],$image, $_GET['cat_id']]);
            }
        }
        else{
            if($category !== false)
            {
             $query = 'UPDATE  categories SET `name` = ?, updated_at = NOW() WHERE id = ? ;';
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['name'],$_GET['cat_id']]);
            }
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
               
               
                <form action="<?= url('panel/category/edit.php?cat_id='). $_GET['cat_id'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>
                            <span>نام </span>
                            <input type="text" name="name" value=<?= $category->name ?>>
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                        <img id="image-element" src="<?= asset($category->image) ?>">
                            <input id="image-input" type="file" name="image" accept="image/*">
                            <small>
                                <iconify-icon icon="bxs:image-add"></iconify-icon>
                            تغییر عکس
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


    <script src="<?= asset("/js/admin-panel/category-create.js") ?>"></script>



</body>


</html>