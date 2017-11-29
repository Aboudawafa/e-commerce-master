<?php
require_once("../classes/Produit.php");
require_once("../classes/Util.php");

@$libelle = $_POST['libelle'];
@$prix = $_POST['prix'];
@$description = $_POST['description'];
@$id_categorie = $_POST['categorie'];
@$id = $_POST['id'];

 


if( !empty($libelle) && !empty($description) && !empty($id_categorie) && !empty($prix) ) 
{
	$p= new Produit();
	$util = new Util();
	$p->_libelle = $libelle;
	$p->_prix = $prix;
	$p->_description = $description;
	$p->_image = $util->upload('image', "../upload");
	$p->_id_categorie=$id_categorie;
	if( empty($id) ) 	// Ajout
		$id = $p->ajouter();
	else				// Modification
	{
		$p->_id = $id;
		$p->modifier();
	}

	header("Location: produit_liste.php");
} 
else 
	{echo  "tout les champs sont obligatoires .." ;}
?>