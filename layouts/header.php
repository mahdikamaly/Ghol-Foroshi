<?php 

require_once 'functions/pdo_connection.php'; 
 require_once 'functions/helpers.php' ?>

<header class="f-center">
            <div class="left">
                <a class="search item" href="#">
                    <iconify-icon icon="bi:search"></iconify-icon>
                </a>
                <a class="favoriote item" href="<?= url('famed.php') ?>">
                    <iconify-icon icon="bi:heart"></iconify-icon>
                </a>
                <a class="shopping-cart item" href="<?= url('cart.php') ?>">
                  
                    <iconify-icon icon="bi:bag"></iconify-icon>
                </a>
            </div>
            <div class="mid">
                <div class="logo">
                    <img src="assets/images/main-page/2.png" alt="">
                </div>
            </div>
            <div class="right">
            <?php
            if(!isset($_SESSION['user'])){ ?>
            <a href="<?= url('auth/login.php') ?>" class="user">
                    <span>ورود / ثبت نام</span>
                    <iconify-icon icon="bxs:user"></iconify-icon>
                </a>
                <a href="<?= url('auth/adminLogin.php') ?>" class="user">
                    <span>ورود ادمین</span>
                    <iconify-icon icon="bxs:user"></iconify-icon>
                </a>
                
                <?php } else{ ?>
                <a href="<?= url('auth/logout.php') ?>" class="user">
                    <span>خروج</span>
                    <iconify-icon icon="bxs:user"></iconify-icon>
                </a>
                <?php if(isset($_SESSION['admin'])){ ?>
                <a href="<?= url('panel/post/index.php') ?>" class="user">
                    <span> پنل مدیریت</span>
                    <iconify-icon icon="bxs:user"></iconify-icon>
                </a>
                <?php } ?>

                <?php } ?>
                
              

                <div class="delivery">
                    <img src="assets/images/main-page/1.png" alt="">
                    <span>ارسال روز</span>
                </div>
            </div>
        </header>