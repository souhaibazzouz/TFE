<?php
session_start();

if (!isset($_SESSION['user_id']) && (!isset($_SESSION['user_email']))) {
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>2PAR</title>
        <link rel="shortcut icon" href="../img/logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/slick.css" type="text/css" />
        <link rel="stylesheet" href="../css/templatemo-style.css">
        <link rel="stylesheet" href="../css/leaflet.css" />
        <script src="../js/leaflet.js"></script>
    </head>
    <body>
    <picture id="bg-video">
        <img src="../img/space.JPG" alt="MDN">
    </picture>
    <div class="page-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="cd-slider-nav">
                        <nav class="navbar navbar-expand-lg" id="tm-nav">
                            <div class="navbar-brand" href="#0" data-no="1">
                                <img src="../img/logo.png" height="50" alt="Computer Hope"> 2Par
                            </div>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-supported-content" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;margin-top: 50px;">
            <div class="row justify-content-center">
                <form class="p-5 rounded shadow tm-bg-dark content-pad"
                      method="post"
                      action="signup_check.php"
                      style="width: 30rem;background-color: rgba(255, 255, 255, 1);">
                    <h1 class="text-center text-dark pb-5 display-4">REGISTER</h1>
                    <?php if (isset($_GET['error'])) {?>
                        <div class="alert alert-danger" role="alert">
                            <?=htmlspecialchars($_GET['error'])?>
                        </div>
                    <?php }?>
                    <?php if (isset($_GET['success'])) {?>
                        <div class="alert alert-success" role="alert">
                            <?=htmlspecialchars($_GET['success'])?>
                        </div>
                    <?php }?>
                    <div class="mb-3">
                        <label for="name"
                               class="form-label text-dark">Full Name
                        </label>
                        <?php if (isset($_GET['full_name'])){?>
                            <input type="text"
                                   class="form-control text-dark"
                                   name="full_name"
                                   id="full_name"
                                   value="<?php echo $_GET['full_name'];?>">
                        <?php }else{ ?>
                            <input type="text"
                                   class="form-control text-dark"
                                   name="full_name"
                                   id="full_name">
                        <?php }?>
                    </div>
                    <div class="mb-3">
                        <label for="username"
                               class="form-label text-dark">Username</label>
                        <?php if (isset($_GET['username'])){?>
                            <input type="text"
                                   class="form-control text-dark"
                                   name="username"
                                   id="username"
                                   value="<?php echo $_GET['username'];?>">
                        <?php }else{ ?>
                            <input type="text"
                                   class="form-control text-dark"
                                   name="username"
                                   id="username">
                        <?php }?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1"
                               class="form-label text-dark">Email address
                        </label>
                        <?php if (isset($_GET['email'])){?>
                            <input type="email"
                                   name="email"
                                   class="form-control text-dark"
                                   id="exampleInputEmail1"
                                   aria-describedby="emailHelp"
                                   value="<?php echo $_GET['email'];?>">
                        <?php }else{ ?>
                            <input type="email"
                                   name="email"
                                   class="form-control text-dark"
                                   id="exampleInputEmail1"
                                   aria-describedby="emailHelp">
                        <?php }?>

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1"
                               class="form-label text-dark">Password
                        </label>
                        <input type="password"
                               name="password"
                               class="form-control text-dark"
                               id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="confirm"
                               class="form-label text-dark">Confirm Password</label>
                        <div class="cols-sm-10">
                            <input type="password"
                                   class="form-control text-dark"
                                   name="confirm"
                                   id="confirm">
                        </div>
                    </div>
                    <a href="login.php" class="lienCreate">Already have an account?</a>
                    <button type="submit"
                            class="btn btn-primary btn-lg btn-block login-button">REGISTER
                    </button>
                </form>
            </div>
        </div>
    </div>
    </body>
    </html>
    <?php
}else{
    header('Location: admin.php');
}
?>