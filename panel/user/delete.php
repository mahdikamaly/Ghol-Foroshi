<?php
 require_once '../../functions/helpers.php'; 
 require_once '../../functions/pdo_connection.php'; 
 require_once '../../functions/check-login.php';

 if(isset($_GET['user_id']) && $_GET['user_id'] !== ''){

    global $pdo;
    $query = "DELETE FROM `users` WHERE `id`= ? ;";
    $statement = $pdo->prepare($query);
    $statement->execute([$_GET['user_id']]);
    
 }
 redirect('panel/user/index.php');
?>