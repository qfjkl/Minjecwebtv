<?php

include_once("Media.php");

class Categorie extends Media
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function createCategorie($catName, $catDescription){

		include("database.php");
		$insert=$bd->prepare("INSERT INTO cats(cat_name,cat_description) VALUES (?,?)");
		$a=$insert->execute(array($catName,$catDescription));

		// $a=$insert;
		return $a;

	}

	public function readCategorie($where='', $item=''){

		include("database.php");
		$data=array();
		// compteur 
		$i=0;
		if(!empty($where) && !empty($item))
		{		
			$req=$bd->prepare("SELECT * FROM cats WHERE ".$item."=?");	
			$req->execute(array($where));
					
			while ($d=$req->fetch())
			{
				// enregistrement des variables dans un array
				 $data[$i]["name"]=$d["media_name"];
				 $i++;
			}
			return $data;
		}
		else{
			$req=$bd->query("SELECT * FROM cats");	

			while ($d=$req->fetch())
			{
				// enregistrement des variables dans un array
				 $data[$i]["name"]=$d["cat_name"];
				 $data[$i]["description"]=$d["cat_description"];

				 $i++;
			}
			return $data;
		}

	}

	public function updateCategorie($where,$item,$val){

		include("database.php");
		$req=$bd->prepare("UPDATE cats SET ".$item."=? WHERE media_auteur=?");
		$req->execute(array($val,$where));
	}

	public function deleteCategorie($where){
		
		include("database.php");
		$req=$bd->prepare("DELETE cats WHERE cat_name=?");
		$req->execute(array($where));

	}
}
// $cate= new Categorie();
// $post = file_get_contents('php://input');
// $post = json_decode($post, true);
// $cat= $post["cat"];
// $description=$cat["description"];

// $r=$cate->createCategorie($cat["name"],$cat["description"]);
// echo json_encode($r);