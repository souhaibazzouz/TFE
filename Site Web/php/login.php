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
       <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; margin-top: -100px;">
           <form class="p-5 rounded shadow tm-bg-dark content-pad"
                 action="auth.php"
                 method="post"
                 style="width: 30rem;background-color: rgba(255, 255, 255, 1);">
               <h1 class="text-center text-dark pb-5 display-4">LOGIN
               </h1>
               <?php if (isset($_GET['error'])) {?>
               <div class="alert alert-danger" role="alert">
                   <?=htmlspecialchars($_GET['error'])?>
               </div>
               <?php }?>
               <div class="mb-3">
                   <label for="exampleInputEmail1"
                          class="form-label text-dark">Email address
                   </label>
                   <input type="email"
                          name="email"
                          value="<?php if (isset($_GET['email'])) echo (htmlspecialchars($_GET['email']));?>"
                          class="form-control text-dark"
                          id="exampleInputEmail1"
                          aria-describedby="emailHelp">
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
               <button type="button"
                       class="btn btn-primary"
                       onclick="location.href='../index.php'">RETURN
               </button>
               <button type="submit"
                       class="btn btn-primary">LOGIN
               </button>
           </form>
       </div>
    </div>
</body>
</html>
<?php
    }else{
        header('Location: admin.php');
    }
?>