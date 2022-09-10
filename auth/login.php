
<?php
    session_start();
    require_once '../functions/helpers.php';
    require_once '../functions/pdo_connection.php';

    if(isset($_SESSION['user']))
    {
        unset($_SESSION['user']);
    }

    $error = '';

    if(
        isset($_POST['email']) && $_POST['email'] !== '' 
        && isset($_POST['password']) && $_POST['password'] !== '' )
        {
            global $pdo;
            $query = 'SELECT * FROM users WHERE email = ?';
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['email']]);
            $user = $statement->fetch();
            if($user !== false)
            {
                if(password_verify($_POST['password'], $user->password))
                {
                    $_SESSION['user'] = $user->email;
                    redirect('index.php');
                }
                else
                {
                    $error = 'رمز عبور اشتباه است';
                }
            }
            else
            {
                $error = 'ایمیل وارد شده اشتباه میباشد';
            }
        }
        else
        {
            if(!empty($_POST))
            $error = 'همه فیلد ها اجباری هستند';
        }

?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه ورود</title>
    <link rel="stylesheet" href="<?= asset('assets/css/index.css') ?>">




    <!-- Slick css -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />





</head>

<body>

    <div class="wrapper">
        

        <section class="sign-in">
            
            <h1 class="header">
            ورود کاربران 
            </h1>
            <p style="color: red ;"> <?= $error ?> </p>
            <form action="<?= url('auth/login.php') ?>" method="post" enctype="multipart/form-data" class="body">
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
                <div class="form-buttons">
                    <a class="navigator" href="<?= url('auth/register.php') ?>" >
                        حساب کاربری ندارید ؟ کلیک کنید
                    </a>
                    <label>
                        <a href="<?= url('index.php') ?>">
                            انصراف
                        </a>
                    </label>
                    <label >
                        <button>
                            ورود
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
        <script src="<?= asset('assets/js/Parallax/parallax.min.js') ?>"></script>


        <!-- Slick Slider Js -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>




        <!-- Main Page Sliders -->
        <script src="<?= asset('assets/js/main-page/main-page-slider.js') ?>"></script>


        <!-- Detial Page Js -->
        <script src="<?= asset('assets/js/detail-page/detail-page.js') ?>"></script>














</body>

</html>