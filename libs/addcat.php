<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Content-type:application/x-www-form-urlencoded");

include_once("categorie.php");

$cate= new Categorie();
$post = file_get_contents('php://input');
$post = json_decode($post, true);
$cat= $post["cat"];
$description=$cat["description"];

$r=$cate->createCategorie($cat["name"],$cat["description"]);
echo json_encode($r);