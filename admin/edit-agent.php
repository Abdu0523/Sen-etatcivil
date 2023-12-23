<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $agent_id = $_POST['agent_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mobno = $_POST['mobno'];
    $add = $_POST['address'];

    $sql = "UPDATE tblagent SET FirstName = :fname, LastName = :lname, MobileNumber = :mobno, Address = :add  WHERE ID = :agent_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':agent_id', $agent_id, PDO::PARAM_INT);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':lname', $lname, PDO::PARAM_STR);
    $query->bindParam(':mobno', $mobno, PDO::PARAM_INT);
    $query->bindParam(':add', $add, PDO::PARAM_STR);

    $query->execute();

    if ($query) {
        echo "<script>alert('Mise à jour effectuée avec succès');</script>";
        echo "<script>window.location.href='registered-users.php'</script>";
    } else {
        echo "<script>alert('Quelque chose a mal tourné. Veuillez réessayer!');</script>";
        echo "<script>window.location.href='edit-agent.php?agent_id=$agent_id'</script>";
    }
}

if (isset($_GET['agent_id'])) {
    $agent_id = $_GET['agent_id'];

    // Récupérer les informations de l'Agent à partir de la base de données
    $sql = "SELECT * FROM tblagent WHERE ID = :agent_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':agent_id', $agent_id, PDO::PARAM_INT);
    $query->execute();
    $agent = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<!doctype html>
<html class="no-js" lang="fr">
<head>
    
    <title>Admin | SEN&Eacute;TATCIVIL</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
		
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
    <link rel="stylesheet" href="css/normalize.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="css/form.css">
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
        <?php include ('includes/sidebar.php'); ?>
        <?php include ('includes/header.php'); ?>
  
            <!-- Register Start-->
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
                                            <li><span class="bread-blod">Modifier Officier</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login-form-area mg-t-30 mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-15">
                        </div>
                      
                        <form class="adminpro-form" method="post">
                        <input type="hidden" name="officer_id" value="<?php echo $agent['ID']; ?>">
                            <div class="col-lg-12">
                            <div class="sparkline13-hd">
                                    <div class="main-sparkline13-hd">
                                        <h1>Editer AGENT </h1>
                                        <div class="sparkline13-outline-icon">
                                        </div>
                                    </div>
                                </div>
                            <div class="login-bg">
                               
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="login-input-head ">
                                                <p>Prenom</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <input type="text" name="fname" placeholder=" .... " value="<?php echo $agent['FirstName']; ?>" required="true" />
                                                <i class="fa fa-user login-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-lg-2">
                                            <div class="login-input-head">
                                                <p>Nom</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <input type="text" name="lname" placeholder=".... " value="<?php echo $agent['LastName']; ?>" required="true" />
                                                <i class="fa fa-user login-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="login-input-head">
                                                <p>T&eacute;l&eacute;phone</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <input type="text" name="mobno" maxlength="10" pattern="[0-9]+" placeholder="exmpl: 770777777" value="<?php echo $agent['MobileNumber']; ?>" required="true" />
                                                <i class="fa fa-mobile login-user" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-lg-2">
                                            <div class="login-input-head">
                                                <p>Addresse de r&eacute;sidence</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <input type="text" name="address" placeholder="exmpl: 'Mbour'"  value="<?php echo $agent['Address']; ?>" required="true" />
                                                <i class="fa fa-home login-user" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                                 
                                
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-8">
                                            <div class="login-button-pro">
                                               
                                                <button type="submit" class="login-button login-button-lg" name="submit">Modifier</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
            </div>
            <!-- Register End-->
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
    <!-- form validate JS
		============================================ -->
    <script src="js/jquery.form.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/form-active.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
</body>

</html>