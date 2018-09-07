<?php

class Media extends cat_has_media{
	
	public function __construct(){

	}

	const path="../uploads/";
	protected $data= array();

// ------------------------------- upload et enregistrement des medias -------------------

/*

@functionName : doSaveUpload
@params : array $_FILES (infos fichier) et l'auteur du fichier
@return : string

*/
	public function doSaveUpload($file,$mediaAuteur){
		// liste des extensions autorisées
		$extAllow= array('mp4','avi','wav');
		// extension du fichier 
		$extfile=explode('.', $_FILES["userfile"]["name"]);
		// au cas ou le media existe déjà
		if($this->readMedia($_FILES["userfile"]["name"])===true)
		{
			return $data["erreur"]="Un media portant ce nom existe deja.";
		}
		else
		{
			// au cas ou l'extension est valide 
			if(in_array($extfile[1], $extAllow))
			{
				// début de l'upload et Enregistrement des informations en bd 
				if(move_uploaded_file($_FILES["userfile"]["tmp_name"],$this->n=self::path."".$_FILES["userfile"]["name"]))
				{	
					include("database.php");
					$this->createMedia($_FILES["userfile"]["name"], $mediaAuteur);
				}
				// en cas d'échec de l'upload 
				else
				{
					return $data["erreur"]="Un media portant ce nom existe deja.";
				}			
			}
			else
			{
				// au cas ou l'extension n'est pas valide renvoi un message d'erreur
				$data["erreur"]="échec de l'upload";
				return $data["erreur"];
			}		
		}
	}
// ----------------------------------- enregistrement des medias ---------------------------

/*

@functionName : createMedia
@params string : nom du media et son auteur
@return : boolean

*/
	public function createMedia($mediaName,$mediaAuteur){

		include("database.php");
		$insert=$bd->prepare("INSERT INTO medias(dateupload,media_name,media_auteur) VALUES (NOW(),?,?)")OR die("Erreur");
		$insert->execute(array($mediaName,$mediaAuteur));
	
	}
// ------------------------------------- lecture des medias ---------------------------
/*

@functionName : readMedia
@params string and boolean : clause where et
@return : any

*/
	public function readMedia($where='',$isquery=false, $item="media_auteur"){
		include("database.php");
		// au cas ou l'on veut recupérer les médias
		if($isquery==true)
		{
			$req=$bd->prepare("SELECT * FROM medias WHERE ".$item."=?");	
			$req->execute(array($where));

			$data=array();
			// compteur 
			$i=0;					
			while ($d=$req->fetch())
			{
				// enregistrement des variables dans un array
				 $data[$i]=$d["media_name"];
				 $i++;
			}
			return $data;
		}
		else
		{
			return $this->mediaExist($where);
		}
	}

// ------------------------------------- le medias existe déjà? ---------------------------
/*

@functionName : mediaExist
@params string : clause where
@return : boolean

*/

	public function mediaExist($where){

		include("database.php");
		$req=$bd->prepare("SELECT media_name FROM medias WHERE media_name=?");
		$req->execute(array($where));

		// on parcour la db à la recherche d'une valeur correspondante
		while ($data=$req->fetch())
		{
			// au cas ou il y'a un correspondant $bool=true
			if(!empty($data["media_name"]))
			{
				$bool= true;
				break;
			}
		}
		// si $bool existe alors début des vérrifications sinon retourner false
		if(isset($bool))
		{
			// retourne true s'il y'a une correspondance
			if($bool)
			{
				return $bool;
			}
		}
		else
		{
			return false;
		}		
	}
// ------------------------------------mise à jour des médias -------------------------------

	public function updateMedia($where,$item){
		
		include("database.php");
		$req=$bd->prepare("UPDATE medias WHERE media_auteur=?");
		$req->execute(array($where));
	}

// ------------------------------------suppression des médias -------------------------------

	public function deleteMedia($where,$item){
		
		include("database.php");
		$req=$bd->prepare("DELETE medias WHERE media_auteur=?");
		$req->execute(array($where));

	} 
}

$media= new Media();

if(isset($_FILES['userfile']) && isset($_POST["auteur"])){
	// echo $media->doSaveUpload($_FILES,$_POST["auteur"]);
	print_r($media->readMedia("cedric",true));
}
