<?php
session_start();
include("db.php");
$pdo = db_con();

//iniファイル読み込み&変数格納
$set = parse_ini_file("setting.ini");
$g_num = $_SESSION["genre_num"] = $set["genre_num"];
$plc_num = $_SESSION["plc_num"] = $set["plc_num"];
$n_gnr_per = $set["new_genre_per"];

//先頭に表示している施設の順番
$num = 0; //先頭は0、めくられる度に+1

//セッションでuserID取得
$user_id = 1;
// $user_id = $_SESSION["user_id"];

/*******************
ユーザー情報取得：テーブル（user/user_profire/place）
*******************/
$sql = "SELECT ";
$sql .= "U.id,";
$sql .= "U.name,";
$sql .= "U.email,";
$sql .= "UP.training,";
$sql .= "UP.friend,";
$sql .= "UP.learning,";
$sql .= "UP.home_adr_id,";
$sql .= "PH.name AS home_adr_name,";
$sql .= "UP.work_adr_id,";
$sql .= "PW.name AS work_adr_name ";
$sql .= "FROM users U ,user_profile UP ";
$sql .= "JOIN place PH ON UP.home_adr_id = PH.plc_id ";
$sql .= "JOIN place PW ON UP.work_adr_id = PW.plc_id ";
$sql .= "WHERE U.id = UP.user_id AND UP.user_id ='$user_id'";

$prfl = $pdo->prepare($sql);
$prfl_stts = $prfl->execute();

if($prfl_stts==false){
	$error = $prfl->errorInfo();
	exit("ErrorQuery:".$error[2]);

}else{
	$prfl_re = $prfl->fetch(PDO::FETCH_ASSOC);
	$_SESSION["user_name"] = $prfl_re["name"];
	$tr     = $_SESSION["training"] = $prfl_re["training"];
	$fr     = $_SESSION["friend"] = $prfl_re["friend"];
	$lrng   = $_SESSION["learning"] = $prfl_re["learning"];
	$hm_adr = $_SESSION["home_adr_id"] = $prfl_re["home_adr_id"];
	$wk_adr = $_SESSION["work_adr_id"] = $prfl_re["work_adr_id"];
}
$prfl_arr = [];
if($tr == 1) {
	array_push($prfl_arr, "training");
}
if ($fr == 1) {
	array_push($prfl_arr, "friend");
}
if ($lrng == 1) {
	array_push($prfl_arr, "learning");
}
$prfl_arr_count = count($prfl_arr);
$prfl_where;
for ($i=0; $i<$prfl_arr_count ; $i++) {
	if ($i==0) {
		$prfl_where = $prfl_arr[$i]."=1 OR ";
	}else {
		$prfl_where = $prfl_where.$prfl_arr[$i]."=1 OR ";
	}
}
$prfl_where = rtrim($prfl_where, " OR ");

/*******************
user_needs_scoreテーブル
（ユーザーのニーズスコアを取得）
*******************/
//ポジティブテーブルのSelrct項目指定
$tbl_name = "user_needs_score";
$sql  = "SELECT ";
$sql .= $tbl_name.".user_id AS p_user_id,";
$sql .= $tbl_name.".free AS p_free,";
$sql .= $tbl_name.".priced AS p_priced,";
$sql .= $tbl_name.".active AS p_active,";
$sql .= $tbl_name.".nonactive AS p_nonactive,";

for ($i=0;$i<$plc_num;$i++){
	$sql .= $tbl_name.".plc_id_".$i." AS p_plc_id_".$i.",";
}
for ($i=0;$i<$g_num;$i++){
	$sql .= $tbl_name.".genre_id_".$i." AS p_gnr_id_".$i.",";
}

//ネガティブテーブルのSelect項目指定
$tbl_name_n = "user_needs_score_n";
$sql .= $tbl_name_n.".user_id AS n_user_id,";
$sql .= $tbl_name_n.".free AS n_free,";
$sql .= $tbl_name_n.".priced AS n_priced,";
$sql .= $tbl_name_n.".active AS n_active,";
$sql .= $tbl_name_n.".nonactive AS n_nonactive,";

for ($i=0;$i<$plc_num;$i++){
	$sql .= $tbl_name_n.".plc_id_".$i." AS n_plc_id_".$i.",";
}
for ($i=0;$i<$g_num;$i++){
	$sql .= $tbl_name_n.".genre_id_".$i." AS n_gnr_id_".$i.",";
}

$sql = rtrim($sql,",");

//From以下
$sql .= " FROM ".$tbl_name." JOIN ".$tbl_name_n." WHERE ".$tbl_name.".user_id ='".$user_id."';";

$ns = $pdo->prepare($sql);
$ns_stts = $ns->execute();

if($ns_stts==false){
	$error = $ns->errorInfo();
	exit("ErrorQuery:".$error[2]);

}else{
	$ns_re = $ns->fetch(PDO::FETCH_ASSOC);
	//回答規定数を超えたジャンルの出現確率
	$h_gnr_per = 100 - $n_gnr_per;
	
	//全ジャンルのニーズスコア合計
	for ($i=0;$i<$g_num;$i++){ //ジャンルの種類の数だけループ
		//ポジティブとネガティブの合計
		$s[$i] = $ns_re["p_gnr_id_".$i] + $ns_re["n_gnr_id_".$i];
		
		//Yesと回答した確率を、各ジャンルで計算
		$ttl_gnr_per[$i] = $ns_re["p_gnr_id_".$i]/$s[$i] *$h_gnr_per;
	}
	
	//Yesと回答した確率を、全ジャンルで合計
	$n_ttl_sco = array_sum($ttl_gnr_per);
	
	//各ジャンルの出現確率を算出
	for ($i=0;$i<$g_num;$i++){
		$gnr_per[$i] = round($ttl_gnr_per[$i]/$n_ttl_sco*$h_gnr_per);
	}
}

/*******************
event_infoテーブル
*******************/
// 条件を満たすイベントを取得し、各ジャンルの配列に格納。各表示確率に基づいて表示
$sql="";
for ($i=0;$i<$g_num;$i++){ //ジャンルの種類の数だけループ
	if($i!=0){
		$sql .=" UNION ";
	}
	$sql .= "(SELECT ";
	$sql .= "event_info.event_id AS e_event_id,";
	$sql .= "event_info.name AS e_evname,";
	$sql .= "event_info.description AS e_description,";
	$sql .= "place.name AS p_name,";
	$sql .= "place.pref AS p_pref,";
	$sql .= "place.area AS p_area,";
	$sql .= "fac_info.name AS f_facname,";
	$sql .= "fac_info.address AS f_address,";
	$sql .= "fac_info.tel AS f_tel,";
	$sql .= "fac_info.description AS f_description,";
//	$sql .= "event_info.fac_id AS e_fac_id,";
	$sql .= "event_info.plc_id AS e_plc_id,";
	$sql .= "event_info.active AS e_active,";
	$sql .= "event_info.pricing AS e_pricing,";
	for ($k=0;$k<$g_num;$k++){ //ジャンルの種類の数だけループ
		$sql .= "event_info.genre_id_".$k." AS e_"."genre_id_".$k.",";
	}
	$sql .= "event_info.training AS e_training,";
	$sql .= "event_info.friend AS e_friend,";
	$sql .= "event_info.learning AS e_learning ";
	$sql .= "FROM event_info ";
	$sql .= "INNER JOIN fac_info ";
	$sql .= "ON event_info.fac_id = fac_info.fac_id ";
	$sql .= "INNER JOIN place ";
	$sql .= "ON event_info.plc_id = place.plc_id ";
	$sql .= "WHERE (".$prfl_where.") AND genre_id_".$i." = 1 AND (event_info.plc_id=".$hm_adr." OR event_info.plc_id = ".$wk_adr.") ";
	$sql .="limit ".round($gnr_per[$i]).")";
}
$sql .= " order by rand()";

//echo($sql);
//exit();

$event_info = $pdo->prepare($sql);
$ev_info_stts = $event_info->execute();

if($ev_info_stts==false){
	$error = $event_info->errorInfo();
	exit("ErrorQuery:".$error[2]);

}else{
	//イベント情報を多次元配列で各ジャンルごとに格納
	$view = "";
	$i=0;
	while($ev_info_re = $event_info->fetch(PDO::FETCH_ASSOC)){
		//施設情報を表示順にして配列に格納
		$ev_info[$i]["e_id"]       = $ev_info_re["e_event_id"];
		$ev_info[$i]["ev_name"]    = $ev_info_re["e_evname"];
		$ev_info[$i]["active"]     = $ev_info_re["e_active"];
		$ev_info[$i]["pricing"]    = $ev_info_re["e_pricing"];
		$ev_info[$i]["plc_id"]     = $ev_info_re["e_plc_id"];
		$ev_info[$i]["genre_id_0"] = $ev_info_re["e_genre_id_0"];
		$ev_info[$i]["genre_id_1"] = $ev_info_re["e_genre_id_1"];
		$ev_info[$i]["genre_id_2"] = $ev_info_re["e_genre_id_2"];
		$ev_info[$i]["genre_id_3"] = $ev_info_re["e_genre_id_3"];
		$ev_info[$i]["fac_name"]   = $ev_info_re["f_facname"];
		$ev_info[$i]["fac_adr"]    = $ev_info_re["f_address"];
		$ev_info[$i]["fac_tel"]    = $ev_info_re["f_tel"];
		$ev_info[$i]["fac_desc"]   = $ev_info_re["f_description"];
		$ev_info[$i]["plc_name"]   = $ev_info_re["p_name"];
		$ev_info[$i]["plc_pref"]   = $ev_info_re["p_pref"];
		$ev_info[$i]["plc_area"]   = $ev_info_re["p_area"];

		$i++;
	}
}

/*******************
ジャンルテーブル取得
*******************/
$sql="SELECT * from genre";
$genre_info = $pdo->prepare($sql);
$gnr_info_stts = $genre_info->execute();
$gnr_info=[];

if($ev_info_stts==false){
	$error = $genre_info->errorInfo();
	exit("ErrorQuery:".$error[2]);

}else{
	$i=0;
	while($gnr_info_re = $genre_info->fetch(PDO::FETCH_ASSOC)){
		$gnr_info[$i]["genre_id"] = $gnr_info_re["genre_id"];
		$gnr_info[$i]["name"] = $gnr_info_re["name"];
		$i++;
	}
}

/*******************
地域情報テーブル取得（place）
*******************/
$sql="SELECT * from place";
$place_info = $pdo->prepare($sql);
$plc_info_stts = $place_info->execute();
$plc_info=[];

if($plc_info_stts==false){
	$error = $place_info->errorInfo();
	exit("ErrorQuery:".$error[2]);
}else{
	$i=0;
	while($plc_info_re = $place_info->fetch(PDO::FETCH_ASSOC)){
		$plc_info[$i]["plc_id"] = $plc_info_re["plc_id"];
		$plc_info[$i]["name"] = $plc_info_re["name"];
		$plc_info[$i]["pref"] = $plc_info_re["pref"];
		$plc_info[$i]["area"] = $plc_info_re["area"];
		$i++;
	}
}

$info = array($set,$ev_info,$gnr_info,$prfl_re,$plc_info);
$json = json_encode($info);
echo($json);

?>