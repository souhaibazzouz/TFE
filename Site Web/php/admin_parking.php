<?php
session_start();
include 'db_conn.php';
include 'database.php';

$alpha = $_SESSION['user_id'];
$conn = OpenCon();

foreach($conn->query("SELECT * FROM statuta_admin WHERE idAdmin='$alpha'") as $row){
    $id_statut_admin = $row["idStatutA"];
}

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

        <!-- Load Leaflet from CDN -->
        <link
                rel="stylesheet"
                href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
                integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
                crossorigin=""
        />
        <script
                src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
                integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
                crossorigin=""
        ></script>

        <!-- Load Esri Leaflet from CDN -->
        <script
                src="https://unpkg.com/esri-leaflet@2.3.3/dist/esri-leaflet.js"
                integrity="sha512-cMQ5e58BDuu1pr9BQ/eGRn6HaR6Olh0ofcHFWe5XesdCITVuSBiBZZbhCijBe5ya238f/zMMRYIMIIg1jxv4sQ=="
                crossorigin=""
        ></script>

        <!-- Load Esri Leaflet Geocoder from CDN -->
        <link
                rel="stylesheet"
                href="https://unpkg.com/esri-leaflet-geocoder@2.3.2/dist/esri-leaflet-geocoder.css"
                integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
                crossorigin=""
        />
        <script
                src="https://unpkg.com/esri-leaflet-geocoder@2.3.2/dist/esri-leaflet-geocoder.js"
                integrity="sha512-8twnXcrOGP3WfMvjB0jS5pNigFuIWj4ALwWEgxhZ+mxvjF5/FBPVd5uAxqT8dd2kUmTVK9+yQJ4CmTmSg/sXAQ=="
                crossorigin=""
        ></script>

        <style>
            table.table td a.yes {
                color: #99FF66;
            }
            table.table td a.no {
                color: #F44336;
            }
        </style>
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
                                    <li class="nav-item selected">
                                        <a class="nav-link" href="admin_parking.php" data-no="2">Parking</a>
                                        <div class="circle"></div>
                                    </li>
                                    <?php if ($id_statut_admin === '3') {?>
                                        <li class="nav-item">
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="d-flex justify-content-left">
                        <div class="col-md-11">

                            <div class="map-responsive text-dark" id="mapid">
                                <div id="map"></div>
                                <script>
                                    var parkingIcon = L.icon({
                                        iconUrl: '../img/parking.png',

                                        iconSize:     [38, 50], // size of the icon
                                        iconAnchor:   [10, 50], // point of the icon which will correspond to marker's location
                                        popupAnchor:  [9, -50] // point from which the popup should open relative to the iconAnchor
                                    });

                                    var mymap = L.map('mapid').setView([0.0, 0.0], 2);

                                    <?php if (isset($_GET['id'])) {
                                        $conn = OpenCon();
                                        $id = $_GET['id'];
                                        foreach($conn->query("SELECT * FROM parking WHERE idParking='$id' ORDER BY idParking DESC LIMIT 0, 1") as $row){
                                            $name = $row["name"];
                                            $adress = $row["adress"];
                                            $lat = $row["latCoor"];
                                            $lng = $row["lngCoor"];
                                            $tot_slot = $row["tot_slot"];
                                        }?>
                                        mymap.setView([<?php echo json_encode($lat); ?>, <?php echo json_encode($lng); ?>], 15)
                                        var markerEphec = L.marker([<?php echo json_encode($lat); ?>, <?php echo json_encode($lng); ?>], {icon: parkingIcon}).addTo(mymap);
                                        markerEphec.bindPopup("<b>Parking "
                                            +<?php echo json_encode($name); ?>
                                            +" "+<?php echo json_encode($adress); ?>
                                            +"</b><br> Nombre de place sur le parking:  "
                                            +<?php echo json_encode($tot_slot); ?>);
                                    <?php }?>

                                    L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                                        maxZoom: 20,
                                        subdomains:['mt0','mt1','mt2','mt3'],
                                    }).addTo(mymap);

                                    const searchControl = L.esri.Geocoding.geosearch().addTo(mymap);
                                    const results = L.layerGroup().addTo(mymap);

                                    let markers = [];
                                    searchControl.on("results", function (data) {
                                        markers = [];
                                        results.clearLayers();
                                        mymap.setView([0.0, 0.0], 2)
                                        // several results as several towns with same name (like)
                                        for (var i = data.results.length - 1; i >= 0; i--) {
                                            const result = data.results[i];
                                            const marker = L.marker(result.latlng);
                                            markers = [...markers, L.marker(marker)];
                                            results.addLayer(marker);
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 tm-contact-left text-light">
                    <div class="intro-left tm-bg-dark" style='background-color: rgba(255, 255, 255, 0.3);text-shadow: 2px 2px #000000;'>
                        <h2 class="mb-12">Parking en Attente:</h2>
                        <table class="table text-light">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom Complet</th>
                                <th>Adresse
                                </th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conn = OpenCon();

                            foreach($conn->query("SELECT * FROM parking") as $row){
                                $idParking=$row['idParking'];
                                $name=$row['name'];
                                $adress=$row['adress'];
                                foreach($conn->query("SELECT * FROM statutp_parking WHERE idParking='$idParking'") as $row1){
                                    $idStatutP = $row1['idStatutP'];

                                    if($idStatutP == '3'){
                                        echo "<tr><td>$idParking</td>
                                      <td><a id='$idParking' onClick='afficher_popup(this.id)'>$name</a></td>
                                      <td>$adress</td>
                                      <td>
                                        <a href='#' class='yes'><i class='bi bi-check-lg' title='Modifier'></i></a>
                                        <a href='#' class='no'><i class='bi bi-x-lg' title='Supprimer'></i></a></td>
                                      </tr>";
                                    }
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                        <script type="text/javascript">
                            function afficher_popup(clicked_id)
                            {
                                window.location.href = "admin_parking.php?id=" + clicked_id;
                            }
                        </script>
                    </div>
                </div>
            </div>
    </div>
    <div class="container-fluid">
        <footer class="row mx-auto tm-footer">
            <div class="col-md-4 px-0">
                &copy; Copyrights 2021. All Rights Reserved
            </div>
            <div class="col-md-4 px-0 tm-footer-right">
                <a rel="sponsored" href="pdf/CGU.pdf" target="_blank" class="tm-link-white">Conditions Générales d'Utilisation</a>
            </div>
            <div class="col-md-4 px-0 tm-footer-right">
                Designed by <a rel="sponsored" href="https://souhaibazzouz.github.io/portfolio/" target="_blank" class="tm-link-white">Souhaïb Azzouz</a>
            </div>
        </footer>
    </div>
    </body>
    </html>
    <?php
}else{
    header('Location: login.php');
}
?>