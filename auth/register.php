<?php require_once '../functions/pdo_connection.php';
require_once '../functions/helpers.php';

$error = '';
    if(
    isset($_POST['email']) && $_POST['email'] !== '' 
    && isset($_POST['full_name']) && $_POST['full_name'] !== '' 
    &&  isset($_POST['password']) && $_POST['password'] !== '' 
    &&  isset($_POST['confirm']) && $_POST['confirm'] !== '' )
    {
        global $pdo;
        if($_POST['password'] === $_POST['confirm'])
        {
            if(strlen($_POST['password']) > 6)
            {
                $query = 'SELECT * FROM users WHERE email = ?';
                $statement = $pdo->prepare($query);
                $statement->execute([$_POST['email']]);
                $user = $statement->fetch();
                if($user === false)
                {
                    $query = 'INSERT INTO users SET email = ?, full_name = ?, `password` = ?, created_at = NOW() ;';
                    $statement = $pdo->prepare($query);
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $statement->execute([$_POST['email'], $_POST['full_name'], $password]);
                    redirect('auth/login.php');
                }
                else
                {
                    $error = 'ایمیل وارد شده تکراری میباشد';
                }
            }
            else
            {
                $error = 'کلمه ی عبور باید حداقل ۵ کاراکتر باشد';
            }
        }
        else
        {
            $error = 'کلمه ی عبور با تاییدیه کلمه ی عبور مطابقت ندارد';
        }
    }
?>


<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه ثبت نام</title>
    <link rel="stylesheet" href="<?=asset('assets/css/index.css')?>">




    <!-- Slick css -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />





</head>

<body>

    <div class="wrapper">
        <section class="sign-up">
            <h1 class="header">
                ثبت نام کاربران
            </h1>
            <form action="<?= url('auth/register.php')?>" method="POST" enctype="multipart/form-data" class="body">
                <div class="form-group">
                    <label>
                        <span>
                            <iconify-icon icon="wpf:name"></iconify-icon>                            نام شما
                        </span>
                        <input type="text" name="full_name" >
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <span>
                            <iconify-icon icon="ic:baseline-attach-email"></iconify-icon>
                            ایمیل
                        </span>
                        <input type="email" name="email" >
                    </label>
                </div>

                <div class="form-group">
                    <label>
                        <span>
                            <iconify-icon icon="carbon:password"></iconify-icon>
                             گذرواژه
                        </span>
                        <input type="password" name="password" >
                    </label>

                </div>

                <div class="form-group">
                    <label>
                        <span>
                            <iconify-icon icon="carbon:password"></iconify-icon>
                            تاییدیه گذرواژه
                        </span>
                        <input type="password" name="confirm" >
                    </label>

                </div>

                
                <div class="form-buttons">
                    <a class="navigator" href="<?= url('auth/login.php') ?>" >
                        حساب کاربری دارید ؟ کلیک کنید
                    </a>
                    <label>
                        <a href="<?= url('index.php') ?>">
                            انصراف
                        </a>
                    </label>
                    <label>
                        <button>
                            ثبت نام
                        </button>
                    </label>
                </div>
            </form>
        </section>


        <!-- JQuery -->
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>




        <!--  Iconify  -->
        <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>


        <!-- Parllax js -->
        <script src="<?=asset('assets/js/Parallax/parallax.min.js')?>"></script>


        <!-- Slick Slider Js -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>




        <!-- Main Page Sliders -->
        <script src="<?=asset('assets/js/main-page/main-page-slider.js')?>"></script>


        <!-- Detial Page Js -->
        <script src="<?=asset('assets/js/detail-page/detail-page.js')?>"></script>














</body>

</html>