<?php

require_once 'app/helpers.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header('location:blog.php');
    exit;
}

$page_title = 'SignIn page';
$error = '';

//if client clicked on the button
if (isset($_POST['submit'])) {

    if (isset($_SESSION['csrf_token']) && isset($_POST['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token']) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        //validation
        if (!$email) {
            $error = '*A valide email is required';
        } elseif (!$password) {
            $error = '*A password is required';
        } else {

            $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
            $email = mysqli_real_escape_string($link, $email);
            $password = mysqli_real_escape_string($link, $password);
            $sql = "SELECT u.*,up.profile_image FROM users u JOIN users_profile up ON u.id= up.user_id WHERE email='$email' LIMIT 1";
            $result = mysqli_query($link, $sql);

            if ($result && mysqli_num_rows($result) == 1) {

                $user = mysqli_fetch_assoc($result);

                if (password_verify($password, $user['password'])) {

                    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_image'] = $user['profile_image'];

                    header('location: blog.php');
                    exit;
                } else {
                    $error = '* wrong email or password !';
                }
            } else {
                $error = '* wrong email or password !';
            }
        }
    }

    $token = csrf();
} else {
    $token = csrf();
}
?>

<?php include 'tpl/header.php' ?>
<main class="min-height-900">
    <div class="container">
        <section id="header-content">
            <div class="row">
                <div class="col-12 mt-3 mb-4">
                    <h1 class="display-4">
                        Sign In Page
                    </h1>
                    <p>
                        Here you can sign in with your account,
                        <a href="signup.php">Open New Account</a>
                    </p>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <form action="" method="POST" autocomplete="off" novalidate="novalidate">
                        <input type="hidden" name="csrf_token" value="<?= $token ?>">
                        <div class="form-group">
                            <label for="email">*Email</label>
                            <input type="email" value="<?= old('email') ?>" name="email" id="email"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">*Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <input type="submit" value="SingIn" name="submit" class="btn btn-primary">
                        <span class="text-danger"><?= $error; ?></span>
                    </form>

                </div>
            </div>
        </section>
        <section id="main-content">

        </section>
    </div>
</main>

<?php include 'tpl/footer.php' ?>