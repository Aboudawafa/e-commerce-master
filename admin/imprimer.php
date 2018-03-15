<?php 
require_once('verifier_access.php'); 

@$id = $_GET['id'];

  require_once("../classes/Produit.php");

  require_once("../classes/Commande.php");
  //$prod= new Produit();
  //$prod = $prod->details($id);


  ob_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Gestion des produits</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">

  <link rel="stylesheet" type="text/css" href="bootstrap-wysihtml5/lib/css/bootstrap.min.css"></link>
     
</head>
<body>

<br>


  <div class="container2">

   <div class="clear"><p>&nbsp;</p></div>
   <div id="resultat-bien"></div>
   <form id="form_bien" class="form_valid" method="POST" action="imprimer.php" enctype="multipart/form-data">
    <table class="table table-striped">   
      <?php $cat = new Commande(); 
          $liste = $cat->liste();
          foreach($liste as $data )
          {
            if($data->_id==$id){
            ?>
       <tr>
        <th>
          id Commande :<span style="color:red;"></span>            
        </th>
            <td><?php echo $data->_id; ?></td>
        </tr>
        <tr>
        <th>
          Nom  :<span style="color:red;"></span>            
        </th>
            <td><?php echo $data->_nom; ?></td>
        </tr>
         <tr>
        <th>
          Prénom :<span style="color:red;"></span>            
        </th>
            <td><?php echo $data->_prenom; ?></td>
        </tr>
        <tr>
        <th>
         Du :<span style="color:red;"></span>            
        </th>
            <td><?php echo $data->_datecreation; ?></td>
        </tr>
        
       <?php }} ?>
     </table>
     
   
   </form>

 </div>

 <hr>


</body>

</html>
<?php 

$html = ob_get_contents();
ob_end_clean();

require "vendor/autoload.php";
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("cmd-" . $id . ".pdf");

?>