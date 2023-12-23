
            <!-- Static Table Start -->
            <div class="data-table-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="sparkline13-list shadow-reset">
                                <div class="sparkline13-hd">
                                    <div class="main-sparkline13-hd">
                                        <h1> Rechercher dans le<span class="table-project-n"> Registre de Naissance</span> </h1>
                                    </div>
                                </div>
                               
                                <div class="sparkline13-graph">
                                    <div class="datatable-dashv1-list custom-datatable-overright">
                                        
                                         <form method="post">
                                                     
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                    <label class="login2 pull-right pull-right-pro">Date de naissance</label></div>
<div class="col-lg-7">
<input id="regmob" type="text" name="regmob" required="true" class="form-control" placeholder="exemple : 2001-07-10">
</div>
</div>
</div>
       

                                                <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                    <label class="login2 pull-right pull-right-pro">No. de registre</label></div>
<div class="col-lg-7">
<input id="certificateno" type="text" name="certificateno" required="true" class="form-control" placeholder="Numero de registre">
</div>
</div>
</div>


                                                     
                                                  
<div class="form-group-inner">
<div class="login-btn-inner">
  <div class="row">
<div class="col-lg-3"></div>
<div class="col-lg-9">
<div class="login-horizental cancel-wp pull-left">
                                                                            
 <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="search">Rechercher..</button>
</div>
</div>
</div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    
                                          <?php
if(isset($_POST['search']))
{ 

$regmob=$_POST['regmob'];
$certificateno=$_POST['certificateno'];
  ?>
  <h4 align="center">Resultat pour la date <?php echo $regmob;?> et no. de registre <?php echo $certificateno;?>  </h4>
                                                                        <h3 align="center">Certificat de Naissance</h3>
                                        <hr />
                                        <p align="left">La présente vise à attester que les renseignements suivants ont été tirés du dossier de naissance original.</p>
                                       
<?php
$vid=$_GET['viewid'];
$sql="SELECT * from  tblcertificat where DateofBirth=:regmob and  ApplicationID=:certificateno";
$query = $dbh -> prepare($sql);
$query-> bindParam(':regmob', $regmob, PDO::PARAM_STR);
$query-> bindParam(':certificateno', $certificateno, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $row)
{   
$certgendate=$row->UpdationDate;            ?>
<table border="1" class="table table-bordered">


<tr align="center">
<td colspan="4" >
<strong> No. de registre:</strong>   <?php  echo $row->ApplicationID;?></td></tr>


    <th scope>Nom complet</th>
    <td><?php  echo $row->FullName;?></td>
    <th scope>Sexe</th>
    <td><?php  echo $row->Gender;?></td>
  </tr>
   <tr>
    <th scope>Date de Naissance</th>
    <td><?php  echo $row->DateofBirth;?></td>
    <th scope>Lieu de Naissance</th>
    <td><?php  echo $row->PlaceofBirth;?></td>
  </tr>
  <tr>
     <th scope>Nom de la Mère</th>
    <td><?php  echo $row->NameOfMother;?></td>
    <th scope>Nom du Père</th>
    <td><?php  echo $row->NameofFather;?></td>
  
  </tr>
   <tr>
    <th scope>CNI du Père</th>
  <td><?php  echo $row->CniMother;?></td>
    <th scope>CNI de la Mère</th>
    <td><?php  echo $row->CniFather;?></td>

  </tr>
   <tr>
        <th scope>Telephone</th>
    <td><?php  echo $row->MobileNumber;?></td>
    <th scope>Adresse</th>
    <td><?php  echo $row->ParentAddress;?></td>

  </tr>
   <tr>

    <th scope>Date et Heure d'inscription</th>
    <td><?php  echo $row->Dateofapply;?></td>
  </tr>
 
  <?php }?>
</table>
          <?php if($certgendate==''){?>
            <p align="center" class="text-warning"><b>Certificat en cours de traitement</b> </p>
            <?php }else{?>
          <p align="left"><b>Date et Heure de generation du certificat :</b> <?php echo htmlentities($certgendate);?></p>
   <a href="download-certificate.php?cid=<?php  echo $row->ApplicationID;?>" class="btn btn-danger text-light">Telecharger</a>  
       </div></div>
  <?php }} ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
  <!-- Static Table End -->
 