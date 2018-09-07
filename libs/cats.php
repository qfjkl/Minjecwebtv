<?php

class cats{

  
  public function __construct(){

  }

/* 
@function  Name: createCats
@params string: nom de la catégorie et la description de la catégorie 
@return boolean 
*/  
  public function createCats($catName,$catDescription){
    
    include("database.php");

    $bool=$insert=$bd->prepare("INSERT INTO cats(cat_name,cat_description) VALUES (?,?)");
    $insert->execute(array($catName,$catDescription));
    if($bool){
      
      return true;
    }
    else{
      
      return false;
    }
    
  }
  
  public function readCats(){
    
    include("database.php");
  
    $bool=$req=$bd->query("SELECT * FROM medias");  
    $data=array();
      // compteur 
    $i=0;          
    while ($d=$req->fetch())
    {
      // enregistrement des variables dans un array
      $data[$i]=$d["cat_name"];
      $i++;
    }
    return $data;
  
    if($bool){
      
      return true;
    }
    else{
      
      return false;
    }
    
  }
  public function updateCats($where){
    
    include("database.php");
    $bool=$req=$bd->prepare("UPDATE medias WHERE media_auteur=?");
    $req->execute(array($where));

    if($bool){
      
      return true;
    }
    else{
      
      return false;
    }  
  
  }
  public function deleteCats($where){
    
    include("database.php");
    $bool=$req=$bd->prepare("DELETE medias WHERE media_auteur=?");
    $req->execute(array($where));  
    
    if($bool){
      
      return true;
    }
    else{
      
      return false;
    }      
  }
}  

