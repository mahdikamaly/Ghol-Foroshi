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
        <main class="users">
            <table>
                <thead>
                    <th>#</th>
                    <th>نام کامل</th>
                    <th>ایمیل</th>
                    <th> ادمین</th>
                    <th>تاریخ ثبت</th>
                    <th>کنترل ها</th>
                </thead>
                <?php
                    global $pdo;
                    $query = "SELECT * FROM `users`;";
                    $statement = $pdo->prepare($query);
                    $statement ->execute();
                    $users = $statement->fetchall();
                    foreach($users as $user) { ?>
                <tbody>

                    <tr>
                        <td>
                            <p><?= $user->id ?></p>
                        </td>
                         <td>
                            <p><?= $user->full_name ?></p>
                        </td>
                        <td>
                            <p><?= $user->email ?></p>
                        </td>
                        <td>
                            <p><?php print $user->is_admin == 10 ? 'هست' : 'نیست' ?></p>
                        </td>
                        <td>
                            <p><?= $user->created_at ?></p>
                        </td>
                        <td>
                            <p>
                                <a href="<?= url('panel/user/delete.php?user_id='. $user->id) ?>">
                                    حذف
                                    <iconify-icon icon="icon-park-solid:delete"></iconify-icon>
                                    <a class="<?= $user->is_admin == 10 ? 'success' : 'warning' ?>" href="<?= url('panel/user/PromotAdmin.php?user_id='. $user->id) ?>">
                                       
                                    <?= trim(print $user->is_admin == 10 ? 'تبدیل به کاربر' : 'ارتقا به ادمین' , 1 ) ?>

                                        <iconify-icon icon="bi:caret-up-square-fill" style="color: white;">
                                        </iconify-icon>
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