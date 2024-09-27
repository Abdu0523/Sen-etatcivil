<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obcsaid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
  {


$vid=$_GET['viewid'];
    $bookingid=$_GET['bookingid'];
    $status=$_POST['status'];
   $remark=$_POST['remark'];
  

$sql= "update tblcertificat set Status=:status,Remark=:remark where ID=:vid";
$query=$dbh->prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':remark',$remark,PDO::PARAM_STR);
$query->bindParam(':vid',$vid,PDO::PARAM_STR);

 $query->execute();

  echo '<script>alert("Mention Attribuée !!")</script>';
 echo "<script>window.location.href ='certificats.php'</script>";
}


  ?>
<!doctype html>
<html class="no-js" lang="fr">

<head>
   
    <title>Certificats | SEN&Eacute;TATCIVIL</title>
  
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- adminpro icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/adminpro-custon-icon.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- charts CSS
		============================================ -->
    <link rel="stylesheet" href="css/c3.min.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body class="materialdesign">
  
    <div class="wrapper-pro">
      <?php include_once('includes/sidebar.php');?>
        <?php include_once('includes/header.php');?>
       
            <!-- Breadcome start-->
            <div class="breadcome-area mg-b-30 small-dn">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcome-list shadow-reset">
                                <div class="row">
                                    
                                    <div class="col-lg-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="dashboard.php">Accueil</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">D&eacute;tail D&eacute;claration</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcome End-->

            <!-- Static Table Start -->
            <div class="data-table-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sparkline13-list shadow-reset">
                                <div class="sparkline13-hd">
                                    <div class="main-sparkline13-hd">
                                        <h1><span class="table-project-n">D&eacute;tail </span> D&eacute;claration</h1>
                                        
                                    </div>
                                </div>
                                <div class="sparkline13-graph">
                                    <div class="datatable-dashv1-list custom-datatable-overright">
                                       
            
<!-- ========================= Declaration Agent =========================== -->


<?php
    $vid=$_GET['viewid'];
    $sql="SELECT tblcertificat.*,tblagent.FirstName,tblagent.LastName,tblagent.MobileNumber,tblagent.Address from  tblcertificat join  tblagent on tblcertificat.UserID=tblagent.ID where tblcertificat.ID=:vid";
    $query = $dbh -> prepare($sql);
    $query-> bindParam(':vid', $vid, PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    $cnt=1;
    if($query->rowCount() > 0)
    {
    foreach($results as $row)
    { 
  ?>

<table border="1" class="table table-bordered">

<tr align="center">
<td colspan="4" style="font-size:20px;" class=" bread-blod text-black ">
 No. Certificat : <span class="text-danger">" <?php  echo $row->ApplicationID;?> "</span></td></tr>
          
  <tr align="center">
 <td colspan="4" style="font-size:20px;color:blue">
Déclarant
</td></tr>
    <tr>
    <th scope>Prenom</th>
    <td><?php  echo $row->FirstName;?></td>
    <th scope>Nom</th>
    <td><?php  echo $row->LastName;?></td>
  </tr>
  <tr>
    <th scope>T&eacute;l&eacute;phone</th>
    <td><?php  echo $row->MobileNumber;?></td>
    <th>Adresse</th>
    <td><?php  echo $row->Address;?></td>
  </tr>
<tr align="center">
<td colspan="4" style="font-size:20px;color:blue">
Détails de declaration</td></tr>
 <tr>
    <th scope>Date de declaration</th>
    <td><?php  echo $row->Dateofapply;?></td>
    <th scope>Certificat d'Accouchement</th>
    <?php if( $row->Cda == true ){ ?>
    <td><button type="button"> <?php echo $row->Cda?> </button></td>
    <?php }else{ ?>
      <td class=" text-danger"> Cda n'existe pas!</td>
    <?php } ?>
 </tr>
 <tr>
    <th scope>Nom complet</th>
    <td><?php  echo $row->FullName;?></td>
    <th scope>Genre</th>
    <td><?php  echo $row->Gender;?></td>
  </tr>
   <tr>
    <th scope>Date de naissance</th>
    <td><?php  echo $row->DateofBirth;?></td>
    <th scope>Lieu de naissance</th>
    <td><?php  echo $row->PlaceofBirth;?></td>
  </tr>
  <tr>
    <th scope>Nom de la Mère</th>
    <td><?php  echo $row->NameOfMother;?></td>
       <th scope>Nom du Père</th>
    <td><?php  echo $row->NameofFather;?></td>

  </tr>
   <tr>
<th scope>CIN de la Mère</th>
    <td><?php  echo $row->CniMother;?></td>
    <th scope>CIN du Père</th>
    <td><?php  echo $row->CniFather;?></td>

  </tr>
   <tr>
        <th scope>T&eacute;l&eacute;phone</th>
    <td><?php  echo $row->MobileNumber;?></td>
    <th scope>Adresse</th>
    <td><?php  echo $row->ParentAddress;?></td>

  </tr>
  <tr>
    
     <th>État final de la d&eacute;claration</th>

    <td> <?php  $status=$row->Status;
    
if($row->Status=="Approuvé")
{
  echo "Déclaration validée";
}

if($row->Status=="Rejeté")
{
 echo "Déclaration Rejetée ";
}


if($row->Status=="")
{
  echo "En attente";
}
 

     ;?></td>
     <th >Mention</th>
    <?php if($row->Status==""){ ?>

      <td class="text-danger" ><?php echo " Mention pas encore attribuée!"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->Remark);?>
                  </td>
                  <?php } ?>
  </tr>
 
<?php  if($row->Status=='Approuvé'): ?>
    <tr>
        <td colspan="4" style="text-align:center;">
    <a href="download-certificate.php?cid=<?php  echo $row->ApplicationID;?>" class="btn btn-danger"> 
    T&eacute;l&eacute;charger </a></td>
</tr>
<?php endif;?>

<?php $cnt=$cnt+1;} ?>


<!-- ========================= Declaration penratale =========================== -->

<?php  } else {?> 

<?php
    $vid=$_GET['viewid'];
    $sql="SELECT tblcertificat.* from  tblcertificat  where tblcertificat.ID=:vid";
    $query = $dbh -> prepare($sql);
    $query-> bindParam(':vid', $vid, PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    $cnt=1;
    if($query->rowCount() > 0)
    {
    foreach($results as $row)
    { 
  ?>

<table border="1" class="table table-bordered">
<tr align="center">
 <td colspan="4" style="font-size:20px; text-align:center;" class='text-warning'>
Certificat enregistré par déclaration Parentale
</td></tr>

<tr align="center">
<td colspan="4" style="font-size:20px;" class=" bread-blod text-black ">
 No. Certificat :  <span class="text-danger"> " <?php  echo $row->ApplicationID;?> "</span></td></tr>
          
  
    
<tr align="center">
<td colspan="4" style="font-size:20px;color:blue">
Détails de declaration</td></tr>
 <tr>
    <th scope>Date de declaration</th>
    <td><?php  echo $row->Dateofapply;?></td>
    <th scope>Certificat d'Accouchement</th>
    <?php if( $row->Cda == true ){ ?>
    <td><button type="button"> <?php echo $row->Cda?> </button></td>
    <?php }else{ ?>
      <td class=" text-danger"> Cda n'existe pas!</td>
    <?php } ?>
 </tr>
 <tr>
    <th scope>Nom complet</th>
    <td><?php  echo $row->FullName;?></td>
    <th scope>Genre</th>
    <td><?php  echo $row->Gender;?></td>
  </tr>
   <tr>
    <th scope>Date de naissance</th>
    <td><?php  echo $row->DateofBirth;?></td>
    <th scope>Lieu de naissance</th>
    <td><?php  echo $row->PlaceofBirth;?></td>
  </tr>
  <tr>
    <th scope>Nom de la Mère</th>
    <td><?php  echo $row->NameOfMother;?></td>
       <th scope>Nom du Père</th>
    <td><?php  echo $row->NameofFather;?></td>

  </tr>
   <tr>
<th scope>CIN de la Mère</th>
    <td><?php  echo $row->CniMother;?></td>
    <th scope>CIN du Père</th>
    <td><?php  echo $row->CniFather;?></td>

  </tr>
   <tr>
        <th scope>T&eacute;l&eacute;phone</th>
    <td><?php  echo $row->MobileNumber;?></td>
    <th scope>Adresse</th>
    <td><?php  echo $row->ParentAddress;?></td>

  </tr>
  <tr>
    
     <th>État final de la d&eacute;claration</th>

    <td> <?php  $status=$row->Status;
    
if($row->Status=="Approuvé")
{
  echo "Déclaration validée";
}

if($row->Status=="Rejeté")
{
 echo "Déclaration Rejetée ";
}


if($row->Status=="")
{
  echo "En attente";
}
 

     ;?></td>
     <th >Mention</th>
    <?php if($row->Status==""){ ?>

    <td class="text-danger" ><?php echo " Mention pas encore attribuée!"; ?></td>
<?php } else { ?>                  
    <td><?php  echo htmlentities($row->Remark);?></td>
  <?php } ?>
  </tr>
 
<?php  if($row->Status=='Approuvé'): ?>
    <tr>
        <td colspan="4" style="text-align:center;">
    <a href="download-certificate.php?cid=<?php  echo $row->ApplicationID;?>" class="btn btn-danger"> 
    T&eacute;l&eacute;charger </a></td>
</tr>
<?php endif;?>

   

  <?php $cnt=$cnt+1;}} ?>
 <?php }?>
</table>


<?php 

if ($status==""){
?> 
<p align="center"  style="padding-top: 20px">                            
 <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Trancher</button></p>  

<?php } ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Trancher</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">

                                <form method="post" name="submit">

                                
                               
     <tr>
    <th>D&eacute;cision :</th>
    <td>
    <textarea name="remark" placeholder="Remark" rows="6" cols="14" class="form-control wd-450" required="true"></textarea></td>
  </tr> 
   
 
  <tr>
    <th>Statut :</th>
    <td>

   <select name="status" class="form-control wd-450" required="true" >
     <option value="Approuvé" selected="true">Approuver</option>
     <option value="Rejeté">Rejeter</option>
   </select></td>
  </tr>
</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
 <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
  
  </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Static Table End -->
        </div>
    </div>
</div>
</div>
  <?php include_once('includes/footer.php');?>
   
    <!-- jquery
		============================================ -->
    <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- counterup JS
		============================================ -->
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <!-- peity JS
		============================================ -->
    <script src="js/peity/jquery.peity.min.js"></script>
    <script src="js/peity/peity-active.js"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script>
    <!-- data table JS
		============================================ -->
    <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>


</body>

</html><?php }  ?>
