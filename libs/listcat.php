<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Content-type:application/x-www-form-urlencoded");

include_once("categorie.php");

$cate= new Categorie();

$r=$cate->readCategorie();
// print_r($r);
echo json_encode($r);