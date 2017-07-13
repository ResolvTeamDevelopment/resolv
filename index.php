<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>resolv - リゾルブ</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js'></script>
	<link href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.css'>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>
	<!-- <script src="js/clickspark.js"></script> -->
	<style>
		html,body{
			overflow: hidden;
		}

		.head_hide{
			display: none;
		}
	</style>
	<script>
	$(function(){
  $(".card").draggable({
    // var stop;
    stop : function (event , ui){
      var offset = $(this).offset();
      // alert(offset.left);
      if (offset.left <= -80){
        alert("batsu");
        $(this).css("display","none");
      }else if (offset.left >= 80) {
        alert("maru");
        // $(".submit").click();
        $(this).css("display","none");
      }else{
        $(this).css({top:0,right:0,left:0,bottom:0});
      }
    }
  });

	var container_css_facinfo = {
		"padding" : "0",
		"height" : "150px"
	}
  $(".card").on("click", function(){
		if ($("nav").hasClass("head_hide")) {
			$(".fac_info").hide();
			$(".card").draggable("enable");
			$("nav").removeClass("head_hide");
			$(".container").removeAttr('style');
			$(".back_icon").hide();
			$(".card").css("border-radius", "10px");
			$(".desc").css("border-radius", "10px");
			$("body").css("overflow", "hidden");
		}else{
	    $("nav").addClass("head_hide");
			$(".card").draggable("disable");
			$(".container").css(container_css_facinfo);
			$("body").css("overflow-y", "auto");
			$(".fac_info").slideDown("fast");
			$(".back_icon").show();
			$(".card").css("border-radius", "0px");
			$(".desc").css("border-radius", "0px");
		}
  });

  $(".mypage_link").on("click", function(){
			$(this).hide();
			$(".card").draggable("disable");
			$(".select").hide();
			$("body").css("overflow-y", "auto");
			$(".mypage_back").show();
			$(".card").addClass("show_mypage");
			$(".card").animate({"left": "+=130%"}, "fast");
			$(".my_info").show();
			$(".my_info").animate({"left": "+=130%"}, "fast");
  })

	$(".mypage_back").on("click", function(){
		$(this).hide();
		$(".card").draggable("enable");
		$(".select").slideDown("fast");
		$("body").css("overflow-y", "hidden");
		$(".mypage_link").show();
		$(".card").removeClass("show_mypage");
		$(".card").animate({"left": "-=130%"}, "fast");
		$(".my_info").hide();
		$(".my_info").animate({"left": "-=130%"}, "fast");
	});

	// $(".yoyaku_btn").clickSpark({
	// 	particleImagePath: 'https://raw.githubusercontent.com/ymc-thzi/clickspark.js/master/demo/particle-2.png',
	// 	particleCount: 10,
	// 	particleSpeed: 8,
	// 	particleSize: 15,
	// 	particleDuration: 0,
	// 	particleRotationSpeed: 20
	// });

	$(".yoyaku_btn").on("click", function(){
		setTimeout(function(){
			$("body").css("overflow", "auto");
		},500)
	});

})
</script>
</head>

<body>
	<div class="container">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="navbar-header">
				<div class="mypage_back" style="display:none">
					<i class="glyphicon glyphicon-arrow-right"></i>
				</div>
<!--
				<button class="navbar-toggle" data-toggle="collapse" data-target=".target">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
-->
				<div class="navbar-brand navbar-brand-center"><span>Resolv</span></div>
				<div class="mypage_link">
					<i class="glyphicon glyphicon-user"></i>
				</div>
			</div>
			<div>
<!--
				<ul class="nav navbar-nav navbar-right">
					<li><a href="">Link3</a></li>
				</ul>
-->
			</div>
		</nav>
		<div class="card">
			<i class="back_icon glyphicon glyphicon-arrow-down" style="display:none"></i>
			<div class="desc">
				<h1>渋谷フットサル大会</h1>
				<p>@渋谷区道玄坂, フットサル</p>
			</div>
		</div>
	<!-- 施設詳細画面 -->
		<div class="fac_info" style="display:none">
				<p class="left_30" style="padding-top:30px"><span style="font-weight:bold">日付</span>　　　2017/10/02</p>
				<p class="left_30"><span style="font-weight:bold">時間</span>　　　19:00〜21:00</p>
				<p class="left_30"><span style="font-weight:bold">料金</span>　　　1000円</p>
				<p class="left_30"><span style="font-weight:bold">場所</span>　　　渋谷区道玄坂1-2-3<br>　　　　　渋谷フットサルクラブ</p>
				<p class="left_30"><span style="font-weight:bold">詳細</span>　　　みんなでワイワイやりましょう！<br>　　　　　チーム参加も個人参加もOKです！　</p>
				<p class="left_30"><span style="font-weight:bold">予約状況</span>　　32人 / 50人</p>
				<div class="yoyaku_btn">
						カレンダー予約
				</div>
				<p class="left_30" style="border-top:none"><span style="font-size:18px">施設情報</span></p>
				<p class="left_30"><span style="font-weight:bold">施設名</span>　　渋谷フットサルクラブ<br>　　　　　<span style="color:blue">この施設で検索する</span></p>
				<p class="left_30"><span style="font-weight:bold">時間</span>　　　9:00~23:00</p>
				<p class="left_30"><span style="font-weight:bold">料金</span>　　　大人500円　小人250円</p>
				<p class="left_30"><span style="font-weight:bold">定休日</span>　　毎週火曜日</p>
				<p class="left_30"><span style="font-weight:bold">場所</span>　　　〒123-1123<br>　　　　　渋谷区道玄坂1-2-3</p>
				<p style="height:150px">　</p>
		</div>

	<!-- マイページ画面 -->
		<div class="my_info" style="display:none">
				<img src="https://pbs.twimg.com/profile_images/686486647270080512/_ACbdMxU.png" alt="プロフが〜" style="height:150px; width:auto">
				<p class="left_30" style="border-top:none"><span style="font-weight:bold">ID</span>　　　goootooou</p>
				<p class="left_30"><span style="font-weight:bold">PW</span>　　　goootooou</p>
				<p class="left_30"><span style="font-weight:bold">勤務地</span>　　　渋谷区</p>
				<p class="left_30"><span style="font-weight:bold">居住地</span>　　　鎌倉市</p>
				<a date-toggle="modal" href="#myproEdit" class="btn btn-primary henkou_btn">
						編集する
				</a>
				<!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myproEdit">MODAL</button><br> -->
				<p style="font-size:18px; border-top:3px solid #d8d8d8; padding-top:20px">Likeしたイベント</p>
				<div class="mylike_check">
					<div class="like_event" style="background-image:url(https://e-venz.com/wp/wp-content/uploads/2016/07/2-40.jpg)">
						<span class="like_title">表参道卓球</span>
					</div>
					<div class="like_event" style="background-image:url(http://www.sakaitennis.com/pic_c047.jpg)">
						<span class="like_title">六本木テニス</span>
					</div>
					<div class="like_event" style="background-image:url(http://tsukubaplacelab.com/wp-content/uploads/2017/02/%E3%82%82%E3%81%8F%E3%82%82%E3%81%8F%E4%BC%9A-1024x681.jpg)">
						<span class="like_title">品川もくもく会</span>
					</div>
					<div class="like_event" style="background-image:url(http://rafftel.up.n.seesaa.net/rafftel/image/120611EChouseparty.jpg?d=a1)">
						<span class="like_title">新宿パーティー</span>
					</div>
					<div class="like_event" style="background-image:url(https://e-venz.com/wp/wp-content/uploads/2016/07/2-40.jpg)">
						<span class="like_title">表参道卓球</span>
					</div>
					<div class="like_event" style="background-image:url(http://www.sakaitennis.com/pic_c047.jpg)">
						<span class="like_title">六本木テニス</span>
					</div>
					<div class="like_event" style="background-image:url(http://tsukubaplacelab.com/wp-content/uploads/2017/02/%E3%82%82%E3%81%8F%E3%82%82%E3%81%8F%E4%BC%9A-1024x681.jpg)">
						<span class="like_title">品川もくもく会</span>
					</div>
					<div class="like_event" style="background-image:url(http://rafftel.up.n.seesaa.net/rafftel/image/120611EChouseparty.jpg?d=a1)">
						<span class="like_title">新宿パーティー</span>
					</div>
					<div class="like_event" style="background-image:url(https://e-venz.com/wp/wp-content/uploads/2016/07/2-40.jpg)">
						<span class="like_title">表参道卓球</span>
					</div>
					<div class="like_event" style="background-image:url(http://www.sakaitennis.com/pic_c047.jpg)">
						<span class="like_title">六本木テニス</span>
					</div>
					<div class="like_event" style="background-image:url(http://tsukubaplacelab.com/wp-content/uploads/2017/02/%E3%82%82%E3%81%8F%E3%82%82%E3%81%8F%E4%BC%9A-1024x681.jpg)">
						<span class="like_title">品川もくもく会</span>
					</div>
					<div class="like_event" style="background-image:url(http://rafftel.up.n.seesaa.net/rafftel/image/120611EChouseparty.jpg?d=a1)">
						<span class="like_title">新宿パーティー</span>
					</div>
				</div>
				<div class="like_itiran_btn">
						一覧を見る
				</div>
				<p style="font-size:18px; border-top:3px solid #d8d8d8; padding-top:20px">カレンダー</p>
				<div class="calendar"></div>
				<div class="henkou_btn">
						イベントを確認
				</div>
		</div>
		<div class="modal fade" id="myproEdit">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">My Modal</h4>
					</div>
					<div class="modal-body">
						こんにちは！
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary">OK!</button>
					</div>
				</div>
			</div>
		</div>
		<div class="select row">
			<div class="col-xs-4 s_button"><img src="images/ng.png" alt="NG"></div>
			<div class="col-xs-4 s_button"><img src="images/star.png" alt="お気に入り"></div>
			<div class="col-xs-4 s_button"><img src="images/good.png" alt="OK"></div>
		</div>
	</div>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
	<script src="js/bootstrap.min.js"></script>
</body>

</html>
