
<?php

session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obcsuid'] > 1)) {
  header('location:logout.php');
  } else{

if (isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $fname = $_POST['fname'];
    $pob = $_POST['pob'];
    $nameofmother = $_POST['nameofmother'];
    $nameoffather = $_POST['nameoffather'];
    $padd = $_POST['padd'];
    $postaladd = $_POST['postaladd'];
    $mobnumber = $_POST['mobnumber'];
    $address = $_POST['address'];
    
    // Génération d'un numéro de déclaration
    $appnumber = mt_rand(00000, 99999);

    // Stocker les données dans la session (à soumettre après le paiement)
    // $_SESSION['declaration_data'] = array(
    //     'appnumber' => $appnumber,
    //     'dob' => $dob,
    //     'gender' => $gender,
    //     'fname' => $fname,
    //     'pob' => $pob,
    //     'nameofmother' => $nameofmother,
    //     'nameoffather' => $nameoffather,
    //     'padd' => $padd,
    //     'postaladd' => $postaladd,
    //     'mobnumber' => $mobnumber,
    //     'address' => $address
    // );

    // // Redirection vers la page de paiement
    // header('Location: lien_vers_page_de_paiement.php');
    // exit();

    // Requête SQL pour l'insertion
    $sql = "INSERT INTO tblcertificat (ApplicationID, DateofBirth, Gender, FullName, PlaceofBirth, NameOfMother, NameofFather, CniMother, CniFather, MobileNumber, ParentAddress) VALUES (:appnumber, :dob, :gender, :fname, :pob, :nameofmother, :nameoffather, :padd, :postaladd, :mobnumber, :address)";

    // Préparation de la requête
    $query = $dbh->prepare($sql);

    // Liaison des paramètres
    $query->bindParam(':appnumber', $appnumber, PDO::PARAM_STR);
    $query->bindParam(':dob', $dob, PDO::PARAM_STR);
    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':pob', $pob, PDO::PARAM_STR);
    $query->bindParam(':nameofmother', $nameofmother, PDO::PARAM_STR);
    $query->bindParam(':nameoffather', $nameoffather, PDO::PARAM_STR);
    $query->bindParam(':padd', $padd, PDO::PARAM_STR);
    $query->bindParam(':postaladd', $postaladd, PDO::PARAM_STR);
    $query->bindParam(':mobnumber', $mobnumber, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);

    // Exécution de la requête
    $query->execute();

    // Vérification de l'insertion
    $LastInsertId = $dbh->lastInsertId();
    if ($LastInsertId > 0) {
        echo '<script>alert("Déclaration de naissance enregistrée avec succès")</script>';
        echo "<script>window.location.href ='num-certificat.php'</script>";
    } else {
        echo '<script>alert("Quelque chose a mal tourné. Veuillez réessayer")</script>';
    }
}
?>

  
  <!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SENETACIVIL</title>


  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Variables CSS Files. Uncomment your preferred color scheme -->
  <link href="assets/css/variables.css" rel="stylesheet">
 
  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

 
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top" data-scrollto-offset="0">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1><span>Sen&eacute;tatciviL</span></h1>
      </a>

         
              <i class="bi bi-list mobile-nav-toggle d-none"></i>
          </div>
      </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Formulaire de Déclaration</h2>
          <ol>
            <li><a href="index.html">Accueil</a></li>
            <li>Form. de Déclaration</li>
          </ol>
        </div>

      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <div class="inner-page">
      <div class="container" data-aos="fade-up">

        <div class="basic-form-area mg-b-15">
          <div class="container-fluid">
             
              <div class="row">
                  <div class="col-lg-12">
                      <div class="sparkline12-list shadow-reset mg-t-30">
                        
                          <div class="sparkline12-graph">
                              <div class="basic-login-form-ad">
                                  <div class="row">
                                      <div class="col-lg-12">
                                          <div class="all-form-element-inner">
                                          <section >
                                              <form method="post">
                                                  
                                                  <div class="form-group-inner">
                                                      <div class="row">
                                                          <div class="col-lg-3">
                                                              <label class="login2 pull-right pull-right-pro">Date de naissance</label>
                                                          </div>
                                                          <div class="col-lg-2">

                                                            <?php // Calcul de la date minimale (4 mois avant aujourd'hui)
                                                                    $minDate = date('Y-m-d', strtotime('-4 months'));
                                                                ?>
                                                                <input type="date" class="form-control" name="dob" value="" required="true" min="<?php echo $minDate; ?>" max="<?php echo date('Y-m-d'); ?>" />
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <br>
                                                  <div class="form-group-inner">
                                                      <div class="row">
                                                          <div class="col-lg-3 col-md-9 col-sm-9 col-xs-9">
                                                              <label class="login2 pull-right pull-right-pro"><span class="basic-ds-n">Sexe</span></label>
                                                          </div>
                                                          <div class="col-lg-9 col-md-3 col-sm-3 col-xs-3">
                                                              <div class="bt-df-checkbox">
                                                                 <p style="text-align: left;"> <input type="radio"  name="gender" id="gender" value="Feminin" checked="true">Feminin</p>
       
                                                             <p style="text-align: left;"> <input type="radio" name="gender" id="gender" value="Masculin">Masculin</p>
       
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <br>
                                                  <div class="form-group-inner">
                                                      <div class="row">
                                                          <div class="col-lg-3">
                                                              <label class="login2 pull-right pull-right-pro">Nom complet</label>
                                                          </div>
                                                          <div class="col-lg-9">
                                                              <input type="text" class="form-control" name="fname" value="" required="true" />
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <br>
                                                  <div class="form-group-inner">
                                                      <div class="row">
                                                          <div class="col-lg-3">
                                                              <label class="login2 pull-right pull-right-pro">Lieu de naissance</label>
                                                          </div>
                                                          <div class="col-lg-9">
                                                              <input type="text" class="form-control" required="true" value="" name="pob" />
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <br>
                                                      <div class="form-group-inner">
                                                      <div class="row">
                                                          <div class="col-lg-3">
                                                              <label class="login2 pull-right pull-right-pro">Nom complet de la Mère</label>
                                                          </div>
                                                          <div class="col-lg-9">
                                                              <input type="text" class="form-control" required="true" value="" name="nameofmother" />
                                                          </div>
                                                      </div>
                                                  </div>



<br>
                                                  <div class="form-group-inner">
                                                      <div class="row">
                                                          <div class="col-lg-3">
                                                              <label class="login2 pull-right pull-right-pro">Nom complet du père</label>
                                                          </div>
                                                          <div class="col-lg-9">
                                                              <input type="text" class="form-control" required="true" value="" name="nameoffather" />
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <br>
                                                  <div class="form-group-inner">
                                                      <div class="row">
                                                          <div class="col-lg-3">
                                                              <label class="login2 pull-right pull-right-pro">CIN de la Mère</label>
                                                          </div>
                                                          <div class="col-lg-9">
                                                              <input type="text" class="form-control" name="padd" value="" required="true" ></input>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <br>
                                                   <div class="form-group-inner">
                                                      <div class="row">
                                                          <div class="col-lg-3">
                                                              <label class="login2 pull-right pull-right-pro">CIN du Père</label>
                                                          </div>
                                                          <div class="col-lg-9">
                                                              <input type="text" class="form-control" name="postaladd" value="" required="true"></input>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <br>
                                                   <div class="form-group-inner">
                                                      <div class="row">
                                                          <div class="col-lg-3">
                                                              <label class="login2 pull-right pull-right-pro">Contacte du Père  </label>
                                                          </div>
                                                          <div class="col-lg-9">
                                                             <input type="text" class="form-control" required="true" value="" name="mobnumber" maxlength="10" pattern="[0-9]+" />
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <br>
                                                 <div class="form-group-inner">
                                                      <div class="row">
                                                          <div class="col-lg-3">
                                                              <label class="login2 pull-right pull-right-pro">Adresse</label>
                                                          </div>
                                                          <div class="col-lg-9">
                                                              <input type="text" class="form-control" required="true" name="address" value="" />
                                                          </div>
                                                      </div>
                                                  </div>
                                         <br>
                                              
                                                  <div class="form-group-inner">
                                                      <div class="login-btn-inner">
                                                          <div class="row">
                                                              <div class="col-lg-3"></div>
                                                              <div class="col-lg-9">
                                                                  <div class="login-horizental cancel-wp pull-left">
                                                                      
                                                                      <button class="btn  btn-info text-light " type="submit" name="submit">Eregistrer</button>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </form>
                                          </section>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

       

      </div>
</div><!-- End Inner Page -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

   
    <div class="footer-legal text-center">
      <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

        <div class="d-flex flex-column align-items-center align-items-lg-start">
          <div class="copyright">
            &copy; <?php echo date('Y'); ?> | <strong><span><a href="index.php">SEN&Eacute;TATCIVIL </a> </span></strong> - Tous droits réservés 
             
          </div>
          <div class="credits">
           
          Conçu par <a href="#">Abdou_ndour_ndiaye</a>
          </div>
        </div>

        

      </div>
    </div>

  </footer><!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
<?php } ?>