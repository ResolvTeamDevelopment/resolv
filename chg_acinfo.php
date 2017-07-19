<?php
session_start();

$user_id = 1;
//$user_id = $_SESSION["user_id"];

include("db.php");
$pdo = db_con();

$tbl_name = $_POST["tbl"];
$column = $_POST["column"];

if($tbl_name=="user_profile"){
	$id = "user_id";
}else{
	$id = "id";
}

$sql = "UPDATE ".$tbl_name." SET ".$column." WHERE ".$id." = ".$user_id;

$stmt = $pdo->prepare($sql);
//$stmt->bindValue(':xxx', $xxx, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
	$error = $stmt->errorInfo();
	exit("QueryError:".$error[2]);
}





?>