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
            <style>
                .table-responsive {
                    margin: 30px 0;
                }
                .table-wrapper {
                    background: #fff;
                    padding: 20px 25px;
                    border-radius: 3px;
                    min-width: 1000px;
                    box-shadow: 0 1px 1px rgba(0,0,0,.05);
                }
                .table-title {
                    padding-bottom: 15px;
                    background: #435d7d;
                    color: #fff;
                    padding: 16px 30px;
                    min-width: 100%;
                    margin: -20px -25px 10px;
                    border-radius: 3px 3px 0 0;
                }
                .table-title h2 {
                    margin: 5px 0 0;
                    font-size: 24px;
                }
                .table-title .btn-group {
                    float: right;
                }
                .table-title .btn {
                    color: #fff;
                    float: right;
                    font-size: 13px;
                    border: none;
                    min-width: 50px;
                    border-radius: 2px;
                    border: none;
                    outline: none !important;
                    margin-left: 10px;
                }
                .table-title .btn i {
                    float: left;
                    font-size: 21px;
                    margin-right: 5px;
                }
                .table-title .btn span {
                    float: left;
                    margin-top: 2px;
                }
                table.table tr th, table.table tr td {
                    border-color: #e9e9e9;
                    padding: 12px 15px;
                    vertical-align: middle;
                }
                table.table tr th:first-child {
                    width: 60px;
                }
                table.table tr th:last-child {
                    width: 100px;
                }
                table.table-striped tbody tr:nth-of-type(odd) {
                    background-color: #fcfcfc;
                }
                table.table-striped.table-hover tbody tr:hover {
                    background: #f5f5f5;
                }
                table.table th i {
                    font-size: 13px;
                    margin: 0 5px;
                    cursor: pointer;
                }
                table.table td:last-child i {
                    opacity: 0.9;
                    font-size: 22px;
                    margin: 0 5px;
                }
                table.table td a {
                    font-weight: bold;
                    color: #566787;
                    display: inline-block;
                    text-decoration: none;
                    outline: none !important;
                }
                table.table td a:hover {
                    color: #2196F3;
                }
                table.table td a.edit {
                    color: #FFC107;
                }
                table.table td a.delete {
                    color: #F44336;
                }
                table.table td i {
                    font-size: 19px;
                }
                table.table .avatar {
                    border-radius: 50%;
                    vertical-align: middle;
                    margin-right: 10px;
                }
                .pagination {
                    float: right;
                    margin: 0 0 5px;
                }
                .pagination li a {
                    border: none;
                    font-size: 13px;
                    min-width: 30px;
                    min-height: 30px;
                    color: #999;
                    margin: 0 2px;
                    line-height: 30px;
                    border-radius: 2px !important;
                    text-align: center;
                    padding: 0 6px;
                }
                .pagination li a:hover {
                    color: #666;
                }
                .pagination li.active a, .pagination li.active a.page-link {
                    background: #03A9F4;
                }
                .pagination li.active a:hover {
                    background: #0397d6;
                }
                .pagination li.disabled i {
                    color: #ccc;
                }
                .pagination li i {
                    font-size: 16px;
                    padding-top: 6px
                }
                .hint-text {
                    float: left;
                    margin-top: 10px;
                    font-size: 13px;
                }
                /* Custom checkbox */
                .custom-checkbox {
                    position: relative;
                }
                .custom-checkbox input[type="checkbox"] {
                    opacity: 0;
                    position: absolute;
                    margin: 5px 0 0 3px;
                    z-index: 9;
                }
                .custom-checkbox label:before{
                    width: 18px;
                    height: 18px;
                }
                .custom-checkbox label:before {
                    content: '';
                    margin-right: 10px;
                    display: inline-block;
                    vertical-align: text-top;
                    background: white;
                    border: 1px solid #bbb;
                    border-radius: 2px;
                    box-sizing: border-box;
                    z-index: 2;
                }
                .custom-checkbox input[type="checkbox"]:checked + label:after {
                    content: '';
                    position: absolute;
                    left: 6px;
                    top: 3px;
                    width: 6px;
                    height: 11px;
                    border: solid #000;
                    border-width: 0 3px 3px 0;
                    transform: inherit;
                    z-index: 3;
                    transform: rotateZ(45deg);
                }
                .custom-checkbox input[type="checkbox"]:checked + label:before {
                    border-color: #03A9F4;
                    background: #03A9F4;
                }
                .custom-checkbox input[type="checkbox"]:checked + label:after {
                    border-color: #fff;
                }
                .custom-checkbox input[type="checkbox"]:disabled + label:before {
                    color: #b8b8b8;
                    cursor: auto;
                    box-shadow: none;
                    background: #ddd;
                }

            </style>
        </head>
        <body>
        <picture id="bg-video">
            <img src="../img/space.JPG" alt="MDN">
        </picture>
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
            <div class="container-xl">
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-6">
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
                                    <h2>Gérer les <b>Administrateurs</b></h2>
                                </div>
                                <div class="col-sm-6">
                                    <a href="signup.php" class="btn btn-sm btn-success" title="Ajouter"><i class="bi bi-person-plus-fill"></i></i><span>Ajouter Administrateur</span></a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom Complet</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conn = OpenCon();
                            $count=1;

                            foreach($conn->query("SELECT * FROM admin") as $row){
                                $idAdmin=$row['idAdmin'];
                                foreach($conn->query("SELECT * FROM statuta_admin WHERE idAdmin='$idAdmin'") as $row1){
                                    $idStatutA = $row1['idStatutA'];

                                    if($idStatutA == '3'){
                                        $statut = 'SuperAdmin';
                                    }else if ($idStatutA == '2'){
                                        $statut = 'Supprime';
                                    }else{
                                        $statut = 'Actif';
                                    }
                                }
                                $full_name=$row['full_name'];
                                $username=$row['username'];
                                $email=$row['email'];
                                echo "<tr><td>$count</td>
                                      <td>$full_name</td>
                                      <td>$username</td>
                                      <td>$email</td>
                                      <td>$statut</td>
                                      <td>
                                        <a href='#' class='edit'><i class='bi bi-pencil-fill' title='Modifier'></i></a>
                                        <a href='#' class='delete'><i class='bi bi-trash-fill' title='Supprimer'></i></a></td>
                                      </tr>";
                                $count++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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