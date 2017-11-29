<?php
require_once("Mysql.php");
class Produit extends Mysql
{
	// Les attributs privés
	private $_id;
	private $_libelle;
	private $_description;
	private $_prix;
	private $_image;
	private $_id_categorie;

	// Méthode magique pour les setters & getters
	public function __get($attribut) {
		if (property_exists($this, $attribut)) 
                return ( $this->$attribut ); 
        else
			exit("Erreur dans la calsse " . __CLASS__ . " : l'attribut $property n'existe pas!");     
    }

    public function __set($attribut, $value) {
        if (property_exists($this, $attribut)) {
            $this->$attribut = (mysqli_real_escape_string($this->get_cnx(), $value)) ;
        }
        else
        	exit("Erreur dans la calsse " . __CLASS__ . " : l'attribut $property n'existe pas!");
    }

	public function details($id)
	{
		$q = "SELECT * FROM produit WHERE id ='$id'";
		$res = $this->requete($q);
		$row = mysqli_fetch_array( $res); 
		$p = new Produit();
		
		$p->_id 			= $row['id'];
		$p->_libelle 		= $row['libelle'];
		$p->_image 		    = $row['image'];
		$p->_description	= $row['description'];
		$p->_prix	        = $row['prix'];
	    $p->_id_categorie	    = $row['id_categorie'];
		return $p;
	}


	public function liste()
	{
		$q = "SELECT * FROM produit ORDER BY libelle";
		$list_prod = array(); // Tableau VIDE
		$res = $this->requete($q);
		while($row = mysqli_fetch_array( $res)){
			$p= new Produit();

			$p->_id 			= $row['id'];
		    $p->_libelle 		= $row['libelle'];
		    $p->_image 		    = $row['image'];
		    $p->_description	= $row['description'];
            $p->_prix	        = $row['prix'];
	        $p->_id_categorie	= $row['id_categorie'];
		
			$list_prod[]=$p;
		}
		
		return $list_prod;
	}
	
	public function ajouter()
	{
	    $q = "INSERT INTO produit (id, libelle, image, description,prix,id_categorie) VALUES 
	  		(  null				, '$this->_libelle'		,
			  '$this->_image'	, '$this->_description'	, '$this->_prix'
			, '$this->_id_categorie')";
		$res = $this->requete($q);
		return mysqli_insert_id($this->get_cnx());
	}
	
	public function modifier(){
		$q = "UPDATE produit SET
			  libelle 	= '$this->_libelle',prix='$this->_prix',
			  image = IF('$this->_image' = '', image, '$this->_image') ,
			  description = '$this->_description' ,
			  id_categorie = '$this->_id_categorie'

			  WHERE id = '$this->_id' ";
	  
		$res = $this->requete($q);
		return $res;
	}

	public function supprimer($id){
		$q = "DELETE FROM produit WHERE id = '$id'";
		$res = $this->requete($q);
		return $res;
	}	 




	
}
?>