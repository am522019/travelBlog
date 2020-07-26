<!doctype html>
<html lang="en">

<head>
    <title>TRAVEL BLOG | <?= $page_title; ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@700&family=Lobster&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light  shadow-sm">
            <div class="container">
                <a class="navbar-brand text-info " href="./"><i class="fas fa-globe-americas fa-lg">TRAVEL</i></a>
                <button class="navbar-toggler bg-info" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span>
                        <i class="fas fa-route fa-lg"></i>
                    </span>
                </button>

                <div class=" collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">ABOUT</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="blog.php">BLOG</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <?php if (!isset($_SESSION['user_id'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="signin.php"> <i class="fas fa-sign-in-alt"></i> Signin</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="signup.php"> <i class="fas fa-user-plus"></i> Signup</a>
                        </li>
                        <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">
                                <img class="rounded-circle mr-3" width="30" height="30"
                                    src="images/<?= $_SESSION['user_image']; ?>" alt="">
                                <?= htmlentities($_SESSION['user_name']); ?> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>