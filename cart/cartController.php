<?php
    require_once '../functions/helpers.php';
    require_once '../functions/pdo_connection.php';
   

    global $pdo;

        if(isset($_GET['post_id']) and $_GET['post_id'] !== '')
        {

        //check for exists post id
        $query = 'SELECT * FROM posts WHERE id = ?';
        $statement = $pdo->prepare($query);
        $statement->execute([$_GET['post_id']]);
        $post = $statement->fetch();
        if($post !== false)
        {
           $cart = ($post->cart == 10) ? 0 : 10;
              $query = 'UPDATE posts SET `cart` = ? WHERE id = ? ;';
            $statement = $pdo->prepare($query);
            $statement->execute([$cart, $_GET['post_id']]);
        }
          
        }

        redirect('cart.php');

