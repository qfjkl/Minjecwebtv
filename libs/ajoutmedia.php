<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header("Content-type:application/x-www-form-urlencoded");

include_once("Media.php");

$cate= new Media();
$post = file_get_contents('php://input');
$post = json_decode($post, true);
$post = $post['media']; 


// $cat= $post[""];
// $description=$cat[""];

echo json_encode($post);
