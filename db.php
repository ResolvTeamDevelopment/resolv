<?php
function db_con(){
	//DB接続情報定義
	$dbinfo = array(
	//ローカルDB
	"host"=>'mysql:dbname=_resolv;charset=utf8;host=localhost', "id" => 'root',"pw" => ''

	//本番DB
//	"host"=>'mysql:dbname=_resolv;charset=utf8;host=mysql506.heteml.jp',"id" => '_resolv',"pw" => 'paramore123'

	);

	//DB接続
	try {
		$pdo = new PDO($dbinfo["host"],$dbinfo["id"],$dbinfo["pw"]);
	} catch (PDOException $e) {
		exit('データベースに接続できませんでした。:'.$e->getMessage());
	}
	return $pdo;
}

//SQL処理エラー
function qerror($stmt){
	$error = $stmt->errorInfo();
	exit("ErrorQuery:".$error[2]);
}

/**
* XSS
* @Param:  $str(string) 表示する文字列
* @Return: (string)     サニタイジングした文字列
*/
function h($str){
	return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}
	
?>
