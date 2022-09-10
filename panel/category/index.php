<?php require_once '../../functions/pdo_connection.php' ;
require_once '../../functions/helpers.php';
require_once '../../functions/check-login.php';?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= asset("assets/css/index.css") ?>>

    <title>پنل مدریت</title>
</head>

<body>

    <div class="wrapper-admin-panel">
     
    <?php require_once '../layouts/header.php' ; ?>

        <main class="categories">
            <div class="create-buttons">
                <a href="<?= url('panel/category/create.php') ?>" class="success">
                    ایجاد دسته بندی جدید
                    <iconify-icon icon="uil:create-dashboard"></iconify-icon>
                </a>
                <h1>دسته بندی ها</h1>
            </div>
            <table>
                <thead>
                    <th>#</th>
                    <th>عکس</th>
                    <th>نام دسته بندی</th>
                    <th>تاریخ ایجاد</th>
                    <th>کنترل ها</th>
                </thead>
                <?php 
                            global $pdo;
                            $query = "SELECT * FROM `categories`";
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $categories = $statement->fetchAll();
                            foreach($categories as $category){
                            ?>
                <tbody>
                    <tr>
                        <td>
                            <p><?= $category->id ?></p>
                        </td>
                        <td>
                            <p>
                                <img src="<?= asset($category->image) ?>" alt="">
                            </p>
                        </td>
                        <td>
                            <p><?= $category->name ?></p>
                        </td>
                        <td>
                            <p><?= $category->created_at ?></p>
                        </td>
                        <td>
                            <p>
                                <a href="<?= url('panel/category/delete.php?cat_id=').$category->id ?>">
                                    حذف
                                    <iconify-icon icon="icon-park-solid:delete"></iconify-icon>
                                    <a class="warning" href="<?= url('panel/category/edit.php?cat_id=').$category->id ?>">
                                        ویرایش
                                        <iconify-icon icon="ci:edit"></iconify-icon>
                                    </a>
                            </p>
                        </td>
                    </tr>
                </tbody>
                            <?php } ?>
            </table>
        </main>
                <?php require_once '../layouts/sidebar.php' ; ?>
    </div>

    <!-- Iconify -->
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
</body>


</html>