<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2PAR</title>
    <link rel="shortcut icon" href="img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/slick.css" type="text/css" />
    <link rel="stylesheet" href="css/templatemo-style.css">
    <link rel="stylesheet" href="css/leaflet.css" />
    <script src="js/leaflet.js"></script>

</head>
<body>
    <picture id="bg-video">
        <img src="img/space.JPG" alt="MDN">
    </picture>
    <div class="page-container">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12">
            <div class="cd-slider-nav">
              <nav class="navbar navbar-expand-lg" id="tm-nav">
                <div class="navbar-brand" href="#0" data-no="1">
                    <img src="img/logo.png" height="50" alt="Computer Hope"> 2Par
                </div>
				<div class="h-25 d-inline-block">
					<button type="button"
                            class="btn btn-sm btn-outline-light py-0"
                            onclick="location.href='php/login.php'">Administrateur</button>
				</div>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-supported-content" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbar-supported-content">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                      <li class="nav-item selected">
                        <a class="nav-link" aria-current="page" href="#0" data-no="1">Accueil</a>
                        <div class="circle"></div>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#0" data-no="2">Parking</a>
                        <div class="circle"></div>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#0" data-no="3">A propos</a>
                        <div class="circle"></div>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#0" data-no="4">Contact</a>
                        <div class="circle"></div>
                      </li>
                    </ul>
                  </div>
              </nav>
            </div>
          </div>          
        </div>        
      </div>      
      <div class="container-fluid tm-content-container">
        <ul class="cd-hero-slider mb-0 py-5">
          <li class="px-3" data-page-no="1">
            <div class="page-width-1 page-left">
              <div class="d-flex position-relative tm-border-top tm-border-bottom intro-container">
                <div class="intro-left tm-bg-dark" style='text-shadow: 2px 2px #000000;'>
                  <h2 class="mb-4">Bienvenue sur le site de 2Par</h2>
                  <p class="mb-4">
                    Marre de toujours devoir passer plusieurs  heures à chercher une place de parking?
                    Vous voudriez pouvoir en trouver une aussi rapidement qu'un claquement de doigt?<br>
                    <strong>Alors <span class="highlight">2Par</span> est fait pour vous!</strong>
                  </p>
                  <p class="mb-0">
                    2Par est un site web permettant de vérifier les places libres dans certains parkings.
                    Un drone <span class="highlight">Parrot</span>, survole les emplacements de parking pour mettre à jour une base de données qui répertorie pour vous les places libres.<br>
                  </p>
                  <hr>
                  <p class="mb-0 text-center">
                    <b>Alors qu'attendez-vous pour vous rendre dans l'onglet
                      <span class="highlight">Parking</span>
                      et trouver une place?</b>
                  </p>
                </div>
                <div class="intro-right"><br><br><br>
                  <img src="img/home-img-1.jpg" width="300" alt="Image" class="img-fluid intro-img-1">
                  <img src="img/home-img-0.jpg" width="300" alt="Image" class="img-fluid intro-img-2">
                </div>
                <div class="circle intro-circle-1"></div>
                <div class="circle intro-circle-2"></div>
                <div class="circle intro-circle-3"></div>
                <div class="circle intro-circle-4"></div>
              </div>
            </div>            
          </li>
          <li data-page-no="2">
              <div class="mx-auto page-width-2">
                <div class="map-responsive" id="mapid"></div>
				<?php
					include 'php/database.php';
					$conn = OpenCon();
					foreach($conn->query("SELECT * FROM parking WHERE name='EPHEC' ORDER BY idParking DESC LIMIT 0, 1") as $row){
						$name = $row["name"];
						$adress = $row["adress"];
						$tot_slot = $row["tot_slot"];
						$empty_slot = $row["empty_slot"];
						$date = $row["date"];
					}
					$conn = null;
				?>
                <script>
                  var mymap = L.map('mapid').setView([50.666985, 4.611713], 14);
                  var marker = L.marker([50.665799, 4.611490]).addTo(mymap);
                  marker.bindPopup("<b>Parking "
				  +<?php echo json_encode($name); ?>
				  +" "+<?php echo json_encode($adress); ?>
				  +"</b><br>"+<?php echo json_encode($empty_slot); ?>
				  +" places restantes sur "
				  +<?php echo json_encode($tot_slot); ?>
				  +"<br><br><h10><small>"+<?php echo json_encode($date); ?>
				  +"</small></h10>").openPopup();
                  var popup = L.popup();

                  L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                    maxZoom: 20,
                    subdomains:['mt0','mt1','mt2','mt3']
                  }).addTo(mymap);

                  mymap.on('click', onMapClick);
                </script>
            </div>
          </li>
          <li data-page-no="3" class="px-3">
            <div class="row">
              <div class="position-relative page-width-1 page-left">
              </div>
              <div class="d-inline position-relative page-width-1 page-right tm-border-top tm-border-bottom">
                <div class="circle intro-circle-1"></div>
                <div class="circle intro-circle-2"></div>
                <div class="circle intro-circle-3"></div>
                <div class="circle intro-circle-4"></div>
                <div class="tm-bg-dark content-pad" style='text-shadow: 2px 2px #000000;'>
                  <h2 class="mb-4">2Par, c'est quoi?</h2>
                  <p class="mb-4">
                    <span class="highlight">2Par</span> est un projet réalisé par un étudiant en Technologie de l'informatique
                    à l'EPHEC de Louvain-la-Neuve, <span class="highlight">Souhaïb Azzouz</span>. Ce projet,
                    conçu sous forme d'un TFE, prouvera l'habilité
                    de cet étudiant à manier les différents outils vu lors de son cursus et ainsi obtenir son diplôme.
                  <p>
                    Ce projet est venu d'une simple constatation; Souhaïb et un de ses amis
                    passaient trop de temps en voiture pour trouver une place de parking.
                    Ayant comme souhait de faire un <span class="highlight">TFE</span> en exploitant les possibilités technologique des drones,
                    il a mis en lien ces deux idées et a créé <span class="highlight">2Par</span>.
                  </p>
                  <p>
                    De nos jours, la <span class="highlight">voiture</span> est un moyen de locomotion qui assure
                    une grande partie des déplacements quotidiens.
                    Le problème : plus il y a de voitures, plus compliquée
                    et longue sera la recherche d’une place de parking.
                    Moins de temps et de distance à parcourir pour trouver un lieu de stationnement,
                    c'est moins de <span class="highlight">CO2</span> dans l'atmosphère!
                  </p>
                </div>
              </div>
            </div>
          </li>
          <li data-page-no="4">
            <div class="mx-auto page-width-2">
              <div class="row">
                <div class="col-md-6 me-0 ms-auto">
                  <h2 class="mb-4">Contacter 2Par</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 tm-contact-left" style='background-color: rgba(0,0,0,0.3);'>
                  <form action="php/form-to-email.php" name=”contact_form” method="POST" class="contact-form">
                    <div class="input-group tm-mb-30">
                        <input name="name" type="text" class="form-control rounded-0 border-top-0 border-end-0 border-start-0" placeholder="Name" required>
                    </div>
                    <div class="input-group tm-mb-30">
                        <input name="email" onblur="validateEmail(this);" type="text" class="form-control rounded-0 border-top-0 border-end-0 border-start-0" placeholder="Email" required>
                    </div>
                    <div class="input-group tm-mb-30">
                        <textarea rows="5" name="message" class="textarea form-control rounded-0 border-top-0 border-end-0 border-start-0" placeholder="Message" required></textarea>
                    </div>
                    <div class="input-group justify-content-end">
                        <input type="submit" class="btn btn-primary tm-btn-pad-2" value="Envoyer">
                    </div>
                  </form>
                </div>
                
                <script src="https://code.jquery.com/jquery-2.1.1.min.js"
                    type="text/javascript"></script>
                <script type="text/javascript">
                    function validateEmail(emailField){
                            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                    
                            if (reg.test(emailField.value) == false) 
                            {
                                alert('Adresse mail incorrect');
                                return false;
                            }
                    
                            return true;
                    
                    }
                
                    function validateContactForm() {
                        var valid = true;
            
                        $(".info").html("");
                        $(".input-field").css('border', '#e0dfdf 1px solid');
                        var userName = $("#name").val();
                        var userEmail = $("#email").val();
                        var content = $("#messag").val();
                        
                        if (userName == "") {
                            $("#name").html("Required.");
                            $("#userName").css('border', '#e66262 1px solid');
                            valid = false;
                        }
                        if (userEmail == "") {
                            $("#email").html("Required.");
                            $("#userEmail").css('border', '#e66262 1px solid');
                            valid = false;
                        }

                        if (content == "") {
                            $("#message").html("Required.");
                            $("#content").css('border', '#e66262 1px solid');
                            valid = false;
                        }
                        return valid;
                    }
                </script>
                
                
                <div class="col-md-6 tm-contact-right" style='background-color: rgba(0,0,0,0.3);'>
                  <div class="row">
                    <div class="col-8" style='text-shadow: 2px 2px #000000;'>
                      <p class="mb-4">
                        Vous avez des suggestions, un besoin ou toute autre demande?
                        Grâce à ce formulaire, envoyez-moi directement un e-mail avec votre message.
                        Je vous contacte en retour dans les plus brefs délais.
                      </p>
                      <p class="mb-0">
                        Si vous préférez avoir une discussion vocale, vous retrouverez mon numéro direct ci-dessous.
                      </p>
                    </div>
                    <div class="col-4">
                      <div class="d-inline d-none d-md-block">
                        <img src="img/me.jpg" alt="Image" class="img-thumbnail rounded mx-auto d-block">
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div>
                    Email: <a href="mailto:sou_sou_azzouz@hotmail.com" class="tm-link-white">sou_sou_azzouz@hotmail.com</a>
                  </div>
                  <div class="tm-mb-45">
                    Tel: <a href="tel:0485391549" class="tm-link-white">0485/39.15.49</a>
                  </div>
                </div>
              </div>
            </div>            
          </li>
        </ul>
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
  </div>
  <!-- Preloader, https://ihatetomatoes.net/create-custom-preloading-screen/ -->
  <div id="loader-wrapper">            
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
  </div>
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/slick.js"></script>
  <script src="js/templatemo-script.js"></script>
</body>
</html>