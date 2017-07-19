<?php
session_start();

$user_id = 1;
//$user_id = $_SESSION["user_id"];

include("db.php");
$pdo = db_con();

$array = $_POST["request"];

$query = "";
if($array[0]=="users"){
	$id = "id";
	if ($array[1]!="" && isset($array[2])){
		$query = "name='".$array[1]."',email='".$array[2]."'";
	}else{
		if(isset($array[2])){
			$query = "email='".$array[2]."' ";
		}else{
			$query = "name='".$array[1]."' ";
		}
	}
}else{
	$id = "user_id";
	if ($array[1]!="" && isset($array[2])){
		$query = "home_adr_id='".$array[1]."',work_adr_id='".$array[2]."'";
	}else{
		if(isset($array[2])){
			$query = "work_adr_id='".$array[2]."' ";
		}else{
			$query = "home_adr_id='".$array[1]."' ";
		}
	}
}

$sql = "UPDATE ".$array[0]." SET ".$query." WHERE ".$id." = ".$user_id;
$stmt = $pdo->prepare($sql);
//$stmt->bindValue(':xxx', $xxx, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
	$error = $stmt->errorInfo();
	exit("QueryError:".$error[2]);
}
?>