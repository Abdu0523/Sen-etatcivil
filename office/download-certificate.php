<?php
namespace Dompdf;
require_once 'dompdf/autoload.inc.php';
ob_start();
$con=mysqli_connect("localhost", "root", "", "etat-civil");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Extrait de Naissance </title>
<style>
table, th, td {
  border: 1px solid;
}
</style>
</head>
<body>
<h2 align="center">Extrait de Naissance</h2>

	<?php 

$cid=intval($_GET['cid']);
	$ret=mysqli_query($con,"SELECT tblcertificat.*,tblagent.FirstName,tblagent.LastName,tblagent.MobileNumber,tblagent.Address from  tblcertificat join  tblagent on tblcertificat.UserID=tblagent.ID where tblcertificat.ApplicationID='$cid'");

while ($row=mysqli_fetch_array($ret)) { ?>
<h3>Application / Certificate Number: <?php  echo $row['ApplicationID'];?></h3>
<table  align="center" border="1" width="100%">

<tr>
    <th width="150">Full Name</th>
    <td width="250"><?php  echo $row['FullName'];?></td>
    <th width="150">Gender</th>
    <td><?php  echo $row['Gender'];?></td>
  </tr>
   <tr>
    <th scope>Date of Birth</th>
    <td><?php  echo $row['DateofBirth'];?></td>
    <th scope>Place of Birth</th>
    <td><?php  echo $row['PlaceofBirth'];?></td>
  </tr>
</table>

  <table  align="center" border="1" width="100%" style="margin-top:3%;">
  <tr>
    <th width="150">Name of Mother</th>
    <td width="250"><?php  echo $row['NameOfMother'];?></td>
       <th width="150">Name of Father</th>
    <td><?php  echo $row['NameofFather'];?></td>

  </tr>
   <tr>
<th scope>CNI de la Mère</th>
    <td><?php  echo $row['CniMother'];?></td>
    <th scope>CNI du Père</th>
    <td><?php  echo $row['CniFather'];?></td>

  </tr>
   <tr>
        <th scope>Parents Mobile Number</th>
    <td><?php  echo $row['MobileNumber'];?></td>
    <th scope>Adresse des Parents</th>
    <td><?php  echo $row['ParentAddress'];?></td>

  </tr>


</table>

<table  align="center" border="1" width="100%" style="margin-top:3%;">
<tr>
	    <th width="150">numéro de certificat</th>
    <td><?php  echo $row['ApplicationID'];?></td>
    <th >date de declaration</th>
    <td><?php  echo $row['Dateofapply'];?></td>

  </tr>
   <tr>
    <th width="150">date de délivrance</th>
    <td><?php  echo $row['UpdationDate'];?></td>
  </tr>
</table>

<?php } ?>

<p>CECI EST UN CERTIFICAT GÉNÉRÉ PAR ORDINATEUR. </p>
</body>
</html>
<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->setPaper('A4', 'landscape');
$dompdf->load_html($html);
$dompdf->render();
//For view
//$dompdf->stream("",array("Attachment" => false));
// for download
$dompdf->stream("Birth-Certificate.pdf");
?>