<?php

try{
	$bd= new PDO("mysql:host=localhost; dbname=minjecwebtv","root","");
}
catch(Exeption $e){
	die('Erreur '.$e->getMessage());
}
