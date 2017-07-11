<?php
    session_start();
    include("funcs.php");

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
      $needs_total_score = $needs_score_result["genre_id_1"]+$needs_score_result["genre_id_2"]+$needs_score_result["genre_id_3"]+$needs_score_result["genre_id_4"];
      $needs_1 = $needs_score_result["genre_id_1"]/$needs_total_score*100;
      $needs_2 = ($needs_score_result["genre_id_2"]/$needs_total_score*100)+$needs_1;
      $needs_3 = ($needs_score_result["genre_id_3"]/$needs_total_score*100)+$needs_2;
      $needs_4 = ($needs_score_result["genre_id_4"]/$needs_total_score*100)+$needs_3;
      // var_dump($needs_2);
    }

  /*
  ******************
  fanc_infoテーブル
  ******************
  */
  // 条件を満たしているファシリティを取得。各パーセンテージに基づいて表示

    //条件
    //=>悩みが該当するファシリティ

    //表示パーセンテージ
    //  ニーズスコアが10件以下のジャンル => 全体の20%=>　　！！！後で実装！！！

    //  各ジャンルのニーズスコア÷全ジャンルのニーズスコア合計 => 各ジャンルのパーセンテージ


    $profile_result=""; // ここにwhere文の内容
    for ($i=0; $i<$profile_array_count ; $i++) {
      $profile_result = $profile_result+$profile_array[$i]==1+"&&";
    }
    if ($training==1 && $friend==1 && $learning==1) {
      $fanc_info = $pdo->prepare("SELECT * FROM fanc_info");
      $fanc_info_status = $fanc_info->execute();
    }

    if($needs_score_status==false){
      //execute（SQL実行時にエラーがある場合）
      $error = $needs_score->errorInfo();
      exit("ErrorQuery:".$error[2]);

    }else{
      $fanc_info_result = $fanc_info->fetch(PDO::FETCH_ASSOC);
      // // 100分の20の確率でニーズ10以下表示
      // $rand_first = rand(0,100);
      // if($rand_first<20){
      //   $rand_second = rand($needs_count<10);
      //
      // }else{
      //   $rand_second = rand($needs_count);
      // }

      $rand = rand(0,100);
      if($rand<$needs_1){
        var_dump("サッカー");
      }elseif($rand<$needs_2){
        var_dump("野球");
      }elseif($rand<$needs_3){
        var_dump("テニス");
      }else{
        var_dump("読書");
      }
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="reset.css">
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
<style>
html, body{
  height: 100%;
  width: 100%;
}
.wrap{
  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
}
.header{
  height: 10%;
  width: 100%;
  background-color: rgba(255, 0, 0, 0.1);
}
.mypage{
  text-align: left;
}
.mypage img{
  height: 40px;
  padding: 10px;
}
.main{
  height: 65%;
  /*width: 100%;*/
  display: flex;
  justify-content: center;
  align-items: center;
}

.card_wrap{
  width: 250px;
  height: 250px;
  position: relative;
}
.card{
  /*background-image: url(http://www.spot.town/wordpress/wp-content/uploads/2016/01/b4948185e580db86e06feac0295a11ee_m.jpg);*/
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  width: 250px;
  height: 250px;
  margin: 0 auto;
}
.card_shousai{
  width: 100%;
  text-align: right;
  margin-right: 10px;
  margin-top: 10px;
}
.card_shousai a{
  color: #fff;
}
.card_title{
  font-size: 25px;
  color: #fff;
}

.select{
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 25%;
  width: 100%;
  background-color: rgba(255, 0, 0, 0.1);
}
.select img{
  width: 100px;
  /*margin: 20px 30px;*/
  margin: 0 10px;
}
</style>
<title></title>
</head>
<body>
  <div class="wrap">
    <div class="header">
      <div class="mypage">
        <a href="">
        <img src="http://sozaikoujou.com/wp/wp-content/uploads/2016/06/th_app_icon_account.jpg" alt="">
        </a>
      </div>
    </div>
    <div class="main">
      <div class="card_wrap">
        <div class="card" style="background-image:url(http://www.machikonnet.com/images/top/title.jpg)">
          <div class="card_shousai">
            <a href=""><span>詳細</span></a>
          </div>
          <span class="card_title">新宿街コン</span>
        </div>
        <div class="card" style="background-image:url(http://tsukubaplacelab.com/wp-content/uploads/2017/02/%E3%82%82%E3%81%8F%E3%82%82%E3%81%8F%E4%BC%9A-1024x681.jpg)">
          <div class="card_shousai">
            <a href=""><span>詳細</span></a>
          </div>
          <span class="card_title">六本木もくもく会</span>
        </div>
        <div class="card" style="background-image:url(http://www.spot.town/wordpress/wp-content/uploads/2016/01/b4948185e580db86e06feac0295a11ee_m.jpg)">
          <div class="card_shousai">
            <a href=""><span>詳細</span></a>
          </div>
          <span class="card_title">渋谷フットサル</span>
        </div>
      </div>
    </div>
    <div class="select">
      <div class="select_batsu">
        <img src="http://wedding.keitaigong.jp/blog/wp-content/uploads/2012/05/batsu2.jpg" alt="">
      </div>
      <div class="select_super">
        <img src="http://www.seaviewstickers.co.uk/shop/media/catalog/product/cache/1/thumbnail/600x600/9df78eab33525d08d6e5fb8d27136e95/b/l/blue_2.jpg" alt="">
      </div>
      <div class="select_maru">
        <img src="http://wedding.keitaigong.jp/blog/wp-content/uploads/2012/05/maru.jpg" alt="">
      </div>
    </div>
  </div>

</body>
</html>
