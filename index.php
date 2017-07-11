<?php
    session_start();
    include("db.php");

    $pdo = db_con();

  //セッションでuserID取得
    $user_id = 0;
    // $user_id = $_SESSION["user_id"];

  /*
  ******************
  user_profireテーブル
  （ユーザーが選択している悩みを取得）
  ******************
  */
    $profile = $pdo->prepare("SELECT * FROM user_profile WHERE user_id ='$user_id'");
    $profile_status = $profile->execute();

    if($profile_status==false){
      //execute（SQL実行時にエラーがある場合）
      $error = $profile->errorInfo();
      exit("ErrorQuery:".$error[2]);

    }else{
      $profile_result = $profile->fetch(PDO::FETCH_ASSOC);
      $training = $profile_result["training"];
      $friend = $profile_result["friend"];
      $learning = $profile_result["learning"];
    }
    $profile_array = [];
    if($training == 1) {
      array_push($profile_array, "training");
    }
    if ($friend == 1) {
      array_push($profile_array, "friend");
    }
    if ($learning == 1) {
      array_push($profile_array, "learning");
    }
    $profile_array_count = count($profile_array);
    $profile_where;
    for ($i=0; $i<$profile_array_count ; $i++) {
      if ($i==0) {
        $profile_where = $profile_array[$i]."=1 OR ";
      }else {
        $profile_where = $profile_where.$profile_array[$i]."=1 OR ";
      }
    }
    $profile_where = rtrim($profile_where, " OR ");

  /*
  ******************
  user_needs_scoreテーブル
  （ユーザーのニーズスコアを取得）
  ******************
  */
    $needs_score = $pdo->prepare("SELECT * FROM user_needs_score WHERE user_id ='$user_id'");
    $needs_score_status = $needs_score->execute();

    if($needs_score_status==false){
      //execute（SQL実行時にエラーがある場合）
      $error = $needs_score->errorInfo();
      exit("ErrorQuery:".$error[2]);

    }else{
      $needs_score_result = $needs_score->fetch(PDO::FETCH_ASSOC);
      //全ジャンルのニーズスコア合計
      $needs_total_score = $needs_score_result["genre_id_0"]+$needs_score_result["genre_id_1"]+$needs_score_result["genre_id_2"]+$needs_score_result["genre_id_3"];
		
		$needs = [];
		for ($i=0;$i<4;$i++){
			$needs[$i] = $needs_score_result["genre_id_".$i]/$needs_total_score*100;
			if($i>0) {
				$needs[$i] += $needs[$i-1];
			}
			
		}
    }

  /*
  ******************
  fanc_infoテーブル
  ******************
  */
  // 条件を満たしているファシリティを取得。各パーセンテージに基づいて表示


    $event_info = $pdo->prepare("SELECT * FROM event_info WHERE $profile_where");
    $event_info_status = $event_info->execute();

    if($event_info_status==false){
      //execute（SQL実行時にエラーがある場合）
      $error = $event_info->errorInfo();
      exit("ErrorQuery:".$error[2]);

    }else{
      $event_info_result = $event_info->fetch(PDO::FETCH_ASSOC);
      // // 100分の20の確率でニーズ10以下表示
      // $rand_first = rand(0,100);
      // if($rand_first<20){
      //   $rand_second = rand($needs_count<10);
      //
      // }else{
      //   $rand_second = rand($needs_count);
      // }

      $rand = rand(0,100);
      if($rand<$needs[0]){
        var_dump("サッカー");
      }elseif($rand<$needs[1]){
        var_dump("野球");
      }elseif($rand<$needs[2]){
        var_dump("テニス");
      }else{
        var_dump("読書");
      }
    }
?>


<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>resolv - リゾルブ</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js'></script>
	<link href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.css'>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>
	<script>
	$(function(){
  $(".card").draggable({
    // var stop;
    stop : function (event , ui){
      var offset = $(this).offset();
      // alert(offset.left);
      if (offset.left <= -50){
        alert("batsu");
        $(this).css("display","none");
      }else if (offset.left >= 180) {
        alert("maru");
        // $(".submit").click();
        $(this).css("display","none");
      }else{
        $(this).css({top:0,right:0,left:0,bottom:0});
      }
    }
  });

  $(".select_maru").on("click", function(){

  });
})
</script>
</head>

<body>
	<div class="container">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="navbar-header">
<!--
				<button class="navbar-toggle" data-toggle="collapse" data-target=".target">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
-->
				<a class="navbar-brand navbar-brand-center" href="">Resolv</a>
			</div>
			<div>
				<ul class="nav navbar-nav">
					<li class="acinfo"><a href="#"><i class="glyphicon glyphicon-user"></i></a></li>
				</ul>
<!--
				<ul class="nav navbar-nav navbar-right">
					<li><a href="">Link3</a></li>
				</ul>
-->
			</div>
		</nav>
		<div class="card">
			<div class="desc">
				<h1>渋谷フットサルクラブ</h1>
				<p>@渋谷区道玄坂, フットサル</p>
			</div>
		</div>

		<div class="select row">
			<div class="col-xs-4 s_button"><img src="images/ng.png" alt="NG"></div>
			<div class="col-xs-4 s_button"><img src="images/star.png" alt="お気に入り"></div>
			<div class="col-xs-4 s_button"><img src="images/good.png" alt="OK"></div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>
