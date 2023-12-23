<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obcsaid']==0)) {
  header('location:logout.php');
}else{
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>Admin | SEN&Eacute;TATCIVIL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                                            <li><span class="bread-blod">Officiers & Agents</span>
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
            
        <!--  Office Table Start -->
        <div class="data-table-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sparkline13-list shadow-reset">
                                <div class="sparkline13-hd">
                                    <div class="main-sparkline13-hd">
                                        <h1> Liste OFFICIERS</h1>
                                    </div>
                                </div>
                                <div class="sparkline13-graph">
                                    <div class="datatable-dashv1-list custom-datatable-overright">
                                        <div id="toolbar1">
                                        <select class="form-control">
                                                <option value="all">Tout</option>
                                                <option value="selected">Selectionn&eacute;</option>
                                        </select>
                                        </div>
                                        <table id="table" data-toggle="table"  data-search="true"   data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar1">
                                            <thead>
                                            <tr>
                                                    <th data-field="state" data-checkbox="true"></th>
                                                    <th>#</th>
                                                    <th>Prenom</th>
                                                    <th>Nom</th>
                                                    <th>Contact</th>
                                                    <th>Adresse</th>
                                                    <th>Date Registrement </th>
                                                    <th>Etat </th>
                                                    <th data-field="action">Action</th>

                                                </tr>
                                            </thead>
                                            </thead>
                                            <tbody>
                                               
                                             
<?php

 $sql="SELECT * from tbloffice";
 $query = $dbh -> prepare($sql);
 $query->execute();
 $results=$query->fetchAll(PDO::FETCH_OBJ);
 $cnt=1;
 if($query->rowCount() > 0)
 {
 foreach($results as $row)
 {               ?>
                                                <tr >
                                                    <td></td>
                                                    <td><?php echo htmlentities($cnt);?></td>
                                                    <td><?php  echo htmlentities($row->FirstName);?></td>
                                                    <td><?php  echo htmlentities($row->LastName);?></td>
                                                   <td><?php  echo htmlentities($row->MobileNumber);?></td>
                                                    <td><?php  echo htmlentities($row->Address);?></td>
                                    
                                                    <td><?php  echo htmlentities($row->RegDate);?></td> 
                                                    <?php if($row->Status=="Actif"){ ?>

<td class=" success "><a href="registered-offices.php" class="btn  col-lg-11" role="button"><?php  echo htmlentities($row->Status);?> </a></td>
<?php } else { ?>
  <td class=" danger"><a href="registered-offices.php" class="btn col-lg-11" role="button"><?php  echo htmlentities($row->Status);?> </a></td>
<?php } ?>
                                                    <td class="datatable-ct">
                                                      <a href="edit-office.php?officer_id=<?php  echo htmlentities($row->ID);?>" class="btn btn-primary " >Modifier</a>
                                                    </td>
                                                </tr>
                                             <?php $cnt=$cnt+1;}} ?>  
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
            <!--  Office Table End -->


            <!--  Agent Table Start -->
<div class="data-table-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sparkline13-list shadow-reset">
                                <div class="sparkline13-hd">
                                    <div class="main-sparkline13-hd">
                                        <h1> Liste AGENTS </h1>                                     
                                    </div>
                                </div>
                                <div class="sparkline13-graph">
                                    <div class="datatable-dashv1-list custom-datatable-overright">
                                        <div id="toolbar">
                                        <select class="form-control">
                                                <option value="all">Tout</option>
                                                <option value="selected">Selectionn&eacute;</option>
                                        </select>
                                        </div>
                                        <table id="table" data-toggle="table"  data-search="true"   data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                            <thead>
                                            <tr>
                                                    <th data-field="state" data-checkbox="true"></th>
                                                    <th>#</th>
                                                    <th>Prenom</th>
                                                    <th>Nom</th>
                                                    <th>Contact</th>
                                                    <th>Adresse</th>
                                                    <th>Date Registrement </th>
                                                    <th>Etat </th>
                                                    <th data-field="action">Action</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                             
                                              <?php
                                          
$sql="SELECT * from tblagent";

$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                                  <tr>
                                                    <td></td>
                                                    <td><?php echo htmlentities($cnt);?></td>
                                                    <td><?php  echo htmlentities($row->FirstName);?></td>
                                                    <td><?php  echo htmlentities($row->LastName);?></td>
                                                    <td><?php  echo htmlentities($row->MobileNumber);?></td>
                                                    <td><?php  echo htmlentities($row->Address);?></td>
                                                    <td><?php  echo htmlentities($row->RegDate);?> </td>
                                                    <?php if($row->Status=="Actif"){ ?>

                                                      <td class=" success "><a href="registered-agents.php" class="btn  col-lg-11" role="button"><?php  echo htmlentities($row->Status);?> </a></td>
                                                      <?php } else { ?>
                                                        <td class=" danger"><a href="registered-agents.php" class="btn col-lg-11" role="button"><?php  echo htmlentities($row->Status);?> </a></td>
                                                      <?php } ?>
                                                    <td class="datatable-ct">
                                                      <a href="edit-agent.php?agent_id=<?php  echo htmlentities($row->ID);?>" class="btn btn-primary " >Modifier</a>
                                                    </td>
                                                    
                                                  </tr>
                                             <?php $cnt=$cnt+1;}} ?>  
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  Agent Table End -->

            

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

</html>
<?php }?> 
