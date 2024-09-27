<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obcsaid']==0)) {
  header('location:logout.php');
  } else{

  ?>
 <div class="content-inner-all">
            <div class="header-top-area">
                <div class="fixed-header-top">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12">
                                <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <div class="admin-logo logo-wrap-pro">
                                    <a href="#"><img src="img/logo/log.png" alt="" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-1 col-sm-1 col-xs-12">
                                <div class="header-top-menu tabl-d-n">
                                    <ul class="nav navbar-nav mai-top-nav">
                                        <li class="nav-item"><a href="dashboard.php" class="nav-link">ACCUEIL</a>
                                        </li>
                                        <li class="nav-item"><a href="certificats.php" class="nav-link">CERTIFICATS</a>
                                        </li>
                                      
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                <div class="header-right-info">
                                    <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                        
                                        <li class="nav-item">
                                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
 <?php
$aid=$_SESSION['obcsaid'];
$sql="SELECT FirstName from  tbloffice where ID=:aid";
$query = $dbh -> prepare($sql);
$query->bindParam(':aid',$aid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{  
?>
                                                <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                                                <span class="admin-name"><?php  echo $row->FirstName;?> </span>
                                                <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span><?php $cnt++;}}?>
                                            </a>
                                            <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX">
                                                
                                                <li><a href="profile.php"><span class="adminpro-icon adminpro-user-rounded author-log-ic"></span>Mon Profil</a>
                                                </li>
                                                 <li><a href="change-password.php"><span class="adminpro-icon adminpro-settings author-log-ic"></span>Reglage</a>
                                                </li>
                                                <li><a href="logout.php"><span class="adminpro-icon adminpro-locked author-log-ic"></span>Exit</a>
                                                </li>
                                            </ul>
                                        </li>
                                   
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php }  ?>