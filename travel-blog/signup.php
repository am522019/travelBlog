<?php

require_once 'app/helpers.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header('location:blog.php');
    exit;
}

$page_title = 'Sign Up page';
$error = [
    'name' => '',
    'email' => '',
    'password' => '',
    'submit' => '',
];

//if client clicked on the button
if (isset($_POST['submit'])) {
    if (isset($_SESSION['csrf_token']) && isset($_POST['csrf_token']) && $_SESSION['csrf_token'] == $_POST['csrf_token']) {

        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $name = mysqli_real_escape_string($link, $name);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $email = mysqli_real_escape_string($link, $email);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $passwordname = mysqli_real_escape_string($link, $password);
        $form_valid = true;
        $profile_image = 'user-profiile.png';
        define('MAX_FILE_SIZE', 1024 * 1024 * 5);

        if (!$name || mb_strlen($name) < 2 || mb_strlen($name) > 70) {
            $error['name'] = '*Name is required at least 2 chars';
            $form_valid = false;
        }
        if (!$email) {
            $error['email'] = '*Email is required';
            $form_valid = false;
        } elseif (email_exist($link, $email)) {
            $error['email'] = '*Email is taken';
            $form_valid = false;
        }

        if (!$password || strlen($password) < 6 || strlen($password) > 20) {
            $error['password'] = '*password is required min 6 chars max 20 ';
            $form_valid = false;
        }

        if (isset($_FILES['image']['error']) &&  $_FILES['image']['error'] == 0) {

            if (isset($_FILES['image']['size']) && $_FILES['image']['size'] <= MAX_FILE_SIZE) {

                if (isset($_FILES['image']['name'])) {

                    $allowed_ex = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
                    $details = pathinfo($_FILES['image']['name']);

                    if (in_array(strtolower($details['extension']), $allowed_ex)) {

                        if (isset($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
                            $profile_image = date('Y.m.d.H.i.s') . '-' . $_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $profile_image);
                        }
                    }
                }
            }
        }

        if ($form_valid) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users VALUES(null,'$name','$email','$password')";
            $result = mysqli_query($link, $sql);

            if ($result && mysqli_affected_rows($link) > 0) {
                $new_user_id = mysqli_insert_id($link);
                $sql = "INSERT INTO users_profile VALUES(null,$new_user_id,'$profile_image')";
                $result = mysqli_query($link, $sql);

                if ($result && mysqli_affected_rows($link) > 0) {
                    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                    $_SESSION['user_id'] = $new_user_id;
                    $_SESSION['user_name'] = $name;
                    $_SESSION['user_image'] = $profile_image;
                    header('location: blog.php');
                }
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
                        Sign UP Page
                    </h1>
                    <p>
                        sign up for new account
                    </p>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <form action="" method="POST" autocomplete="off" novalidate="novalidate"
                        enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?= $token ?>">
                        <div class="form-group">
                            <label for="name">*Name</label>
                            <input type="text" value="<?= old('name') ?>" name="name" id="name" class="form-control">
                            <span class="text-danger"><?= $error['name']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="email">*Email</label>
                            <input type="email" value="<?= old('email') ?>" name="email" id="email"
                                class="form-control">
                            <span class="text-danger"><?= $error['email']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="password">*Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <span class="text-danger"><?= $error['password']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="image">*Profile Image :</label>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="inputGroupFile01"
                                    aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <input type="submit" value="SingUp" name="submit" class="btn btn-primary">

                    </form>

                </div>
            </div>
        </section>
        <section id="main-content">

        </section>
    </div>
</main>

<?php include 'tpl/footer.php' ?>