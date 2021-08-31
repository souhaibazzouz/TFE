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
                            <button type="button"
                                    class="btn btn-sm btn-outline-info py-0"
                                    onclick="location.href='../index.php'">Retour à la Page d'accueil</button>
                            </nav>
                        </div>
                    </div>
                </div>
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
                <div class="tm-bg-dark" style='text-shadow: 2px 2px #000000;'>
                    <h2 class="mb-4">Comment ajouter un parking sur le site?</h2>
                    <p class="mb-4">
                        Via la <span class="highlight">map</span> ci-dessous, choisissez l'endroit où se trouve le parking.
                        Un Message s'affichera avec les <span class="highlight">coordonnées GPS</span>  du parking. Ainsi, vous pourrez remplir
                        le <span class="highlight">formulaire</span> du parking et ainsi l'ajouter à la Base de Données.
                    </p>
                </div>
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="d-flex justify-content-left">
                        <div class="col-md-11">

                            <div class="map-responsive text-dark" id="mapid">
                                <div id="map"></div>
                                <?php
                                include 'database.php';
                                $conn = OpenCon();
                                $conn = null;
                                ?>
                                <script>
                                    var mymap = L.map('mapid').setView([0.0, 0.0], 1);
                                    var popup = L.popup()

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
                                        mymap.setView([0.0, 0.0], 1)
                                        // several results as several towns with same name (like)
                                        for (var i = data.results.length - 1; i >= 0; i--) {
                                            const result = data.results[i];
                                            const marker = L.marker(result.latlng);
                                            markers = [...markers, L.marker(marker)];
                                            results.addLayer(marker);
                                        }
                                    });

                                    function onMapClick(e) {
                                        popup
                                            .setLatLng(e.latlng)
                                            .setContent("<b>Latitude</b>: "
                                                + e.latlng.lat.toString().substr(0, 9)
                                                + ", <br/><b>Longitude</b>: "
                                                + e.latlng.lng.toString().substr(0, 9)
                                                + "."
                                            )
                                            .openOn(mymap);
                                    }

                                    mymap.on('click', onMapClick);
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 tm-contact-left">
                    <div class="intro-left tm-bg-dark" style='text-shadow: 2px 2px #000000;'>
                        <h2 class="mb-12">Ajout de Parking:</h2>
                        <div class="col-md-12 tm-contact-left">
                            <form action="addpark.php" name=”contact_form” method="POST" class="contact-form">
                                <div class="row">
                                    <div class="input-group tm-mb-30">
                                        <input name="name" type="text" class="form-control rounded-0 border-top-0 border-end-0 border-start-0" placeholder="Name" required>
                                    </div>
                                    <div class="input-group tm-mb-30">
                                        <input name="address" type="text" class="form-control rounded-0 border-top-0 border-end-0 border-start-0" placeholder="Address" required>
                                    </div>
                                    <div class="input-group tm-mb-30">
                                        <input name="latCoor" type="text" class="form-control rounded-0 border-top-0 border-end-0 border-start-0" placeholder="Latitude" required>
                                    </div>
                                    <div class="input-group tm-mb-30">
                                        <input name="lngCoor" type="text" class="form-control rounded-0 border-top-0 border-end-0 border-start-0" placeholder="Longitude" required>
                                    </div>
                                    <div class="input-group tm-mb-30">
                                        <input name="tot_slot" type="text" class="form-control rounded-0 border-top-0 border-end-0 border-start-0" placeholder="Nombre places totales" required>
                                    </div>
                                    <div class="input-group justify-content-end">
                                        <input type="submit" class="btn btn-primary tm-btn-pad-2" value="Envoyer">
                                    </div>
                                </div>
                            </form>
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