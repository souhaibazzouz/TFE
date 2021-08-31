<?php
session_start();
include 'db_conn.php';
include 'database.php';

$alpha = $_SESSION['user_id'];
$conn = OpenCon();

foreach($conn->query("SELECT * FROM statuta_admin WHERE idAdmin='$alpha'") as $row){
    $id_statut_admin = $row["idStatutA"];
}
if ($id_statut_admin === '3') {
    if (isset($_SESSION['user_id']) && (isset($_SESSION['user_email']))) {
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
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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
                                <div class="h-25 d-inline-block">
                                    <button type="button"
                                            class="btn btn-sm btn-outline-warning py-0"
                                            id="vidbutton"
                                            onclick="location.href='logout.php'">Déconnexion</button>
                                </div>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-supported-content" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbar-supported-content">
                                    <ul class="navbar-nav mb-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="admin.php" data-no="1">Admin</a>
                                            <div class="circle"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="admin_parking.php" data-no="2">Parking</a>
                                            <div class="circle"></div>
                                        </li>
                                        <?php if ($id_statut_admin === '3') {?>
                                            <li class="nav-item selected">
                                                <a class="nav-link" href="admin_client.php" data-no="3">Client</a>
                                                <div class="circle"></div>
                                            </li>
                                        <?php }?>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 100vh; margin-top: -100px">
                <i class="text-dark bi bi-person-circle" style="font-size: 14rem; text-shadow: 2px 2px #FFFFFF;"></i>
                <h1 class="text-center display-4"
                    style="margin-top: -50px;font-size: 2rem; text-shadow: 2px 2px #000000;"><?=$_SESSION['user_full_name']?></h1>
            </div>
        </div>
        </body>
        </html>
        <?php
    }else {
        header('Location: login.php');
    }
}else{
    header('Location: admin.php');
}
?>