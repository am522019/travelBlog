<?php

require_once 'app/helpers.php';
session_start();
$page_title = 'BLOG PAGE';
$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
mysqli_query($link, "SET NAMES utf8");
//sec way-- mysqli_set_charset($link,'utf8')
$sql = "SELECT u.name,up.profile_image,p.*,Date_Format(p.date,'%d/%m/%Y %H:%i:%s') pdate FROM posts p 
        JOIN users u ON u.id = p.user_id 
        JOIN users_profile up ON u.id = up.user_id 
        ORDER BY p.date DESC";
$result = mysqli_query($link, $sql);

?>

<?php include 'tpl/header.php' ?>
<main class="min-height-900">
    <div class="container">
        <section id="header-content">
            <div class="row">
                <div class="col-12 mt-3 mb-4">
                    <h1 class="display-4">
                        TRAVEL BLOG
                    </h1>
                    <p>Travel (quotes)</p>
                    <p>
                        <?php if (user_auth()) : ?>
                        <a class="btn btn-info" href="add_post.php"><i class="fas fa-plus"></i> ADD POST</a>
                        <?php else : ?>
                        <a href="signup.php">Create An account and start you journey</a>
                        <?php endif; ?>
                    </p>

                </div>
            </div>
        </section>
        <section id="main-content">
            <div class="row">
                <?php while ($post = mysqli_fetch_assoc($result)) : ?>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <img width="30px" src="images/<?= $post['profile_image']; ?>" class="rounded-circle mr-3">
                            <span><?= htmlentities($post['name']); ?></span>
                            <span class="float-right">
                                <?= $post['pdate']; ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <h3><?= htmlentities($post['title']); ?></h3>
                            <p> <?= str_replace("\n", '<br>', htmlentities($post['article'])); ?></p>
                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']) :  ?>
                            <div class="float-right">
                                <div class="dropdown">
                                    <a class="text-dark dropdown-toggle-no-arrow dropdown-toggle text-decoration-none"
                                        href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="edit_post.php?pid=<?= $post['id']; ?>"> <i
                                                class="far fa-edit"></i> Edit</a>
                                        <a class="delete-post-btn dropdown-item"
                                            href="delete_post.php?pid=<?= $post['id']; ?>"><i
                                                class="fas fa-eraser"></i>Delete</a>

                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
    </div>
</main>

<?php include 'tpl/footer.php' ?>