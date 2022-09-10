
<?php
global $pdo;
$query = "SELECT * FROM `posts` WHERE `status` = 10 AND id = ?";
$statement = $pdo->prepare($query);
$statement->execute([$_GET['post_id']]);
$post = $statement->fetch();