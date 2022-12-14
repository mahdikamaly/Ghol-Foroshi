<?php
    require_once '../../functions/helpers.php';
    require_once '../../functions/pdo_connection.php';
    require_once '../../functions/check-login.php';


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
           $todaySpecial = ($post->todaySpecial == 10) ? 0 : 10;
              $query = 'UPDATE posts SET `todaySpecial` = ? WHERE id = ? ;';
            $statement = $pdo->prepare($query);
            $statement->execute([$todaySpecial, $_GET['post_id']]);
        }
          
        }

        redirect('panel/post');

