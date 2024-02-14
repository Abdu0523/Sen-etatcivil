
<?php

session_start();
error_reporting(0);
include('includes/dbconnection.php');
{

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

  <!-- Variables CSS Files. -->
  <link href="assets/css/variables.css" rel="stylesheet">
  
  <!--  Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

 
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top" data-scrollto-offset="0">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo.png" alt="">
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
          <h2>Suivi de l'etat de votre Declaration</h2>
          <ol>
            <li><a href="index.php">Accueil</a></li>
            <li>Suiv. de Déclaration</li>
          </ol>
        </div>

      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Block Section ======= -->
    <section style="padding-top: 150px" class="inner-page">
       
      <div class="container">

<p style="color:green;">Vous pouvez maintenant consulter l'&eacute;tat de votre requete ci dessous.</p>
<div class="row ">
    <div class="col-md-10 col-sm-12 mx-auto text-center">
    <div class="sparkline13-graph">
    <div class="datatable-dashv1-list custom-datatable-overright">
                                        
     <form method="post">

                    <div class="form-group-inner">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="login2 pull-right pull-right-pro">Veuillez saisir le mot cl&eacute; : </label>
                            </div>
                            <div class="col-lg-5">
                                 <input id="searchdata" type="text" name="searchdata" required="true" class="form-control" placeholder="Numero de serie reçu aprés declaration">
                            </div>
                            <div class="col-lg-1">
                                        <button class="btn  btn-info text-light login-submit-cs" type="submit" name="search">Rechercher..</button>
                            </div>
                        </div>
                    </div>
     </form>
               <hr>                                  
<?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
  ?>
  <h4 align="center">R&eacute;sultats pour le mot-cl&eacute; "<?php echo $sdata;?>" </h4>
                                        
                                             
<?php
                                          
$sql="SELECT * from tblcertificat where ApplicationID like '$sdata%'";

$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
<div style="overflow: scroll;">  
<hr>                              
    <?php if($row->Status==""){ ?>

    <p class="bg-warning text-light"><?php echo "Votre declaration est en cours de traitement"; ?></p>
    <?php }else{ ?>
        <?php if($row->Status=="Approuvé"){ ?>

        <p class="bg-success text-light">Votre déclaration a été <?php echo htmlentities($row->Status); ?></p>
            <?php } else { ?>
                <p class="bg-danger text-light">Votre declaration a été <?php  echo htmlentities($row->Status);?> <br> veuilleur vous rapprocher du centre d'Etat civil pour un procedure de remediation</p>
                  <?php } }?>
<?php 
$cnt=$cnt+1;
} } else { ?>
  
    <p class="text-danger" > Desolé, Ce numero de registre n'exite pas dans notre base de donn&eacute;es</p>

 
  <?php } }?>
  </div>
</div>

    </section><!-- End Inner Page -->
    <section class="inner-page">
    </section>

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