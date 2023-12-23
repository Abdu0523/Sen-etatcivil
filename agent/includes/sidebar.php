        <?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obcsuid']==0)) {
  header('location:logout.php');
  } else{



  ?>
  <div class="left-sidebar-pro">
            <nav id="sidebar">
                <div class="sidebar-header">
                <a href="#"><img src="img/avatar.jpg" alt="" />
                    </a>
                     <?php
$uid=$_SESSION['obcsuid'];
$sql="SELECT FirstName,LastName from  tblagent where ID=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                    
                    <h3><?php  echo $row->FirstName;?></h3>
                    <p>Agent d'Etat Civil</p><?php $cnt=$cnt+1;}} ?>
                   
                </div>
                <div class="left-custom-menu-adp-wrap">
                    <ul class="nav navbar-nav left-sidebar-menu-pro">
                        <li class="nav-item">
                                <a href="dashboard.php" role="button" aria-expanded="false"><i class="fa big-icon fa-home"></i> <span class="mini-dn">Accueil</span></a>
                        </li>
                        <li class="nav-item">
                             <a href="certificates-list.php" role="button" aria-expanded="false"><i class="fa big-icon fa-user"></i> <span class="mini-dn">Le Registre</span> </a>

                         </li>
                        <li class="nav-item">
                            <a href="" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                <i class="fa big-icon fa-envelope"></i>
                                <span class="mini-dn">Form. de D&eacute;claration</span>
                                <span class="indicator-right-menu mini-dn">
                                    <i class="fa indicator-mn fa-angle-left"></i>
                                </span>
                            </a>
                            <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                            <a href="certificate-form.php" class="dropdown-item">D&eacute;clarer une naissance</a>
                            <a href="manage-forms.php" class="dropdown-item">Voir D&eacute;clarations</a>
                            </div>
                        </li>
                       
                   
                    </ul>
                </div>
            </nav>
        </div><?php }  ?>