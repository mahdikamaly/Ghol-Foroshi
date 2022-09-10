<?php
    require_once '../../functions/helpers.php';
    require_once '../../functions/pdo_connection.php';
    require_once '../../functions/check-login.php';


    global $pdo;

        if(isset($_GET['user_id']) and $_GET['user_id'] !== '')
        {

        //check for exists post id
        $query = 'SELECT * FROM users WHERE id = ?';
        $statement = $pdo->prepare($query);
        $statement->execute([$_GET['user_id']]);
        $user = $statement->fetch();
        if($user !== false)
        {
           $is_admin = ($user->is_admin == 10) ? 0 : 10;
              $query = 'UPDATE users SET is_admin = ? WHERE id = ? ;';
            $statement = $pdo->prepare($query);
            $statement->execute([$is_admin, $_GET['user_id']]);
        }
          
        }

        redirect('panel/user');

