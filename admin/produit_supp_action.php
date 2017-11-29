<?php
require_once('verifier_access.php'); 
require_once("../classes/Produit.php");
$p = new Produit($bdd);

$p->supprimer((int)$_REQUEST['id']);
header("Location: produit_liste.php");
?>