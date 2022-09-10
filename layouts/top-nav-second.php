<nav class="bottom-nav f-center">
            <ul class="left">
            <?php 
                            global $pdo;
                            $query = "SELECT * FROM `categories`";
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $categories = $statement->fetchAll();
                            foreach($categories as $category){
                            ?>
            <li><a href="<?= url('category.php?cat_id=' . $category->id) ?>">
                        <?= $category->name ?>
                    </a></li>
                    <?php } ?>
            </ul>
            <ul class="right">
                <li><a href="<?= url('index.php') ?>">
                        صفحه اصلی
                    </a></li> 
               
            </ul>
        </nav>