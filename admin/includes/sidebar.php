     <?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obcsaid']==0)) {
  header('location:logout.php');
  } else{

  ?>
  
  <div class="left-sidebar-pro">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <a href="#"><img src="img/avatar.jpg" alt="" />
                    </a>
                    <?php
$aid=$_SESSION['obcsaid'];
$sql="SELECT AdminName from  tbladmin where ID=:aid";
$query = $dbh -> prepare($sql);
$query->bindParam(':aid',$aid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row){
               
?>
                    <h3><?php echo $row->AdminName?> </h3>
                    <p>Administrateur</p>
                    <?php $cnt=$cnt+1; }}?>
                </div>
                <div class="left-custom-menu-adp-wrap">
                    <ul class="nav navbar-nav left-sidebar-menu-pro">
                        
                        <li class="nav-item">
                                <a href="certificats.php"><i class="fa big-icon fa-folder"></i> <span class="mini-dn"> Certificats</span> <span class="indicator-right-menu mini-dn"></span></a>
                        </li>
                        <li class="nav-item">
                                <a href="registered-users.php"><i class="fa big-icon fa-users"></i> <span class="mini-dn"> Officiers & Agents</span> <span class="indicator-right-menu mini-dn"></span></a>
                            </li>
                        
                        <li class="nav-item">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-list"></i>  <span class="mini-dn"> Fonction On/Off </span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                                <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="registered-offices.php" class="dropdown-item"> gerer officiers</a>
                                <a href="registered-agents.php" class="dropdown-item">  gerer agents</a>
                            </div>
                            </li>
                            
                            <li class="nav-item">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa big-icon fa-plus"></i> <span class="mini-dn">Cr&eacute;er Utilisateur</span> <span class="indicator-right-menu mini-dn"><i class="fa indicator-mn fa-angle-left"></i></span></a>
                                <div role="menu" class="dropdown-menu left-menu-dropdown animated flipInX">
                                <a href="register-office.php" class="dropdown-item">+ officier</a>
                                <a href="register-agent.php" class="dropdown-item">+ agent</a>
                            </div>
                        </li>
                      
                    </ul>
                </div>
            </nav>
        </div>
        <?php }  ?>