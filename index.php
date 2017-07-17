<?php
session_start();
?>

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
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/i18n/jquery-ui-i18n.min.js"></script>
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css">
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>
	<!-- <script src="js/clickspark.js"></script> -->
	<style>
		html,
		body {
			overflow: hidden;
		}
		
		.head_hide {
			display: none;
		}
		
		svg {
			width: 100%;
		}
		
		.card {
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			margin: 50px auto 0 auto;
			height: 90%;
			width: 90%;
		}
		
		.chart_wrap {
			max-width: 60%;
			margin-right: auto;
			margin-left: auto;
			padding: 1em;
		}
		
		#chart {
			width: 100%;
		}
		
		.my_info {
			width: 100%;
		}
		
		.my_info_img {
			border-radius: 100%;
		}
		
		.mypro_edit {
			position: fixed;
			top: -130%;
			width: 100%;
			height: 100%;
			z-index: 10000;
			background-color: white;
			padding-top: 10%;
			color: #999;
		}
		
		.henkou_btn {
			padding: 10px;
			display: flex;
			justify-content: center;
			align-items: center;
			margin: 40px auto 50px auto;
			background: #F19483;
			border-radius: 10px;
			transition: all 300ms 0s ease;
			width: 90%;
			color: #000;
		}
		
		.like_event {
			margin: 2px 5px;
		}
		
		.ln_label {
			position: relative;
			font-size: 30px;
			text-align: center;
		}
		
		.nope_label {
			opacity: 0;
			width: 120px;
			position: absolute;
			top: 30px;
			right: 10px;
			transform: rotate(25deg);
			-moz-transform: rotate(25deg);
			-webkit-transform: rotate(25deg);
			/*border: 1px solid #000;*/
			border-radius: 10px;
			padding: 5px 10px;
			background-color: blue;
			color: white;
		}
		
		.like_label {
			opacity: 0;
			width: 120px;
			position: absolute;
			top: 30px;
			left: 10px;
			transform: rotate(-25deg);
			-moz-transform: rotate(-25deg);
			-webkit-transform: rotate(-25deg);
			/*border: 1px solid #000;*/
			border-radius: 10px;
			padding: 5px 10px;
			background-color: red;
			color: white;
		}
		
		.top_filter {
			padding-top: 15px;
		}
		
		.top_filter i {
			position: absolute;
			right: 23px;
			top: 18px;
			z-index: 10;
		}
		
		.filter {
			position: absolute;
			/*left:130%;*/
			left: 0;
			top: 0;
			display: flex;
			width: 100%;
			margin-top: 50px;
		}
		
		.filter_select {
			background-color: rgba(255, 255, 255, 0.8);
			width: 100%;
			padding: 10px;
			display: flex;
			flex-direction: column;
			z-index: 100;
		}
		
		.filter_content {
			text-align: center;
			border-top: 1px solid #d3d3d3;
			padding: 10px;
			width: 80%;
			margin: 0 auto;
		}
		
		.filter_search {
			margin-top: 20px;
			background-color: #F19483;
			border-radius: 10px;
			margin-bottom: 30px;
			border-radius: 10px;
		}
		
		.filter_genre select,
		.filter_area select {
			background-color: #fff;
			/*border: 1px solid #F19483;*/
			border-radius: 5px;
			padding: 3px 0 5px 5px;
			margin-left: 10px;
		}
		
		.filter_keyword input {
			border-radius: 5px;
			background-color: white;
			border: none;
			padding: 5px 0 5px 10px;
			border: 1px solid;
			border-color: rgb(166, 166, 166);
		}
		/*カレンダー*/
		
		.ui-widget-content,
		.ui-state-default,
		.ui-widget-content .ui-state-default,
		.ui-widget-header .ui-state-default,
		.ui-widget-header {
			background-image: none;
			color: #555;
		}
		
		.ui-state-default,
		.ui-state-default,
		.ui-state-default {
			background-color: #fff;
		}
		
		.ui-widget-header {
			background-color: #d3d3d3;
			border: 1px solid #d3d3d3;
			color: #000;
		}
		
		div.ui-datepicker {
			font-size: 125%;
		}
		
		.calendar_wrap {
			display: flex;
			justify-content: center;
			align-items: center;
		}
		
		.ui-datepicker select.ui-datepicker-month,
		.ui-datepicker select.ui-datepicker-year {
			width: auto;
		}
		/*.sunday .ui-state-default {
			color: red;
		}

		.saturday .ui-state-default {
			color: blue;
		}

		.holiday .ui-state-default {
			color: red;
		}*/
		
		.today_color {
			color: #fed22f;
		}
		
		.like_color {
			color: #CCFFFF;
		}
		
		.yoyaku_color {
			color: #F19483;
		}
		
		.ui-state-default {
			color: #000;
		}
	</style>
	<script>
		var num = 0;
		var ev_data;
		var u_data;
		var genre_view = [];
		$(function() {
			$.ajax({
				url: "getdata.php",
				cache: false,
				type: "POST"
			}).success(function(data) {
				// 通信成功時の処理
				console.log("ajaxOK");
				info = JSON.parse(data);
				var view = "";
				for (var i = 0; i < info[1].length; i++) {
					view = `<div class='card' style='background-image:url(images/ev/4.jpg)'>
							<i class="back_icon glyphicon glyphicon-arrow-down" style="display:none"></i>
							<div class="ln_label">
								<span class="nope_label">NOPE</span>
								<span class="like_label">LIKE</span>
							</div>
							<div class='desc'>
								<h1>${info[1][i]['ev_name']}</h1>
								<p>${info[1][i]['fac_adr']}</p>
							</div>
						</div>`;
					$("#fac").prepend(view);
				}

				//施設情報の埋め込み
				$("#pricing").html(info[1][num]['pricing']);
				$("#fac_name").html(info[1][num]['fac_name']);
				$("#fac_tel").html(info[1][num]['fac_tel']);
				$("#fac_adr").html(info[1][num]['fac_adr']);
				$("#plc_name").html(info[1][num]['plc_name']);
				$("#plc_pref").html(info[1][num]['plc_pref']);
				$("#plc_area").html(info[1][num]['plc_area']);

				for (var i = 0; i < info[1].length; i++) {
					genre_view[i] = ""
					for (var j = 0; j < info[0]["genre_num"]; j++) {
						if (info[1][i]['genre_id_' + j] == 1) {
							genre_view[i] += info[2][j]['name'] + "<br>";
						}
					}
				}
				$("#genre").html(genre_view[num]);

				$(function() {
					$(".card").draggable({

						drag: function(event, ui) {
							var offset = $(this).offset();
							if (offset.left < 0) {
								if (offset.left < -80) {
									$(this).find(".nope_label").css("opacity", "0.8");
								} else if (offset.left < -70) {
									$(this).find(".nope_label").css("opacity", "0.7");
								} else if (offset.left < -60) {
									$(this).find(".nope_label").css("opacity", "0.6");
								} else if (offset.left < -50) {
									$(this).find(".nope_label").css("opacity", "0.5");
								} else if (offset.left < -40) {
									$(this).find(".nope_label").css("opacity", "0.4");
								} else if (offset.left < -30) {
									$(this).find(".nope_label").css("opacity", "0.3");
								} else if (offset.left < -20) {
									$(this).find(".nope_label").css("opacity", "0.2");
								} else if (offset.left < -10) {
									$(this).find(".nope_label").css("opacity", "0");
								}
							} else if (offset.left > 0) {
								if (offset.left > 80) {
									$(this).find(".like_label").css("opacity", "0.8");
								} else if (offset.left > 70) {
									$(this).find(".like_label").css("opacity", "0.7");
								} else if (offset.left > 60) {
									$(this).find(".like_label").css("opacity", "0.6");
								} else if (offset.left > 50) {
									$(this).find(".like_label").css("opacity", "0.5");
								} else if (offset.left > 40) {
									$(this).find(".like_label").css("opacity", "0.4");
								} else if (offset.left > 30) {
									$(this).find(".like_label").css("opacity", "0.3");
								} else if (offset.left > 20) {
									$(this).find(".like_label").css("opacity", "0.2");
								} else if (offset.left > 10) {
									$(this).find(".like_label").css("opacity", "0");
								}
							}
						}
					}, {
						stop: function(event, ui) {
							offset = $(this).offset();
							if (offset.left <= -80) {
								alert("batsu");
								$(this).remove();
							} else if (offset.left >= 80) {
								alert("maru");
								$(this).remove();
							} else {
								$(this).css({
									top: 0,
									right: 0,
									left: 0,
									bottom: 0
								});
								$(".like_label").css("opacity", "0");
								$(".nope_label").css("opacity", "0");
							}
						}
					});

					var container_css_facinfo = {
						"padding": "0",
						"height": "150px"
					}
					var card_css = {
						"width": "100%",
						"border-radius": "0px",
						"margin": "0"
					}
					$(".card").on("click", function() {
						if ($("nav").hasClass("head_hide")) {
							$(".fac_info").hide();
							$(".card").draggable("enable");
							$("nav").removeClass("head_hide");
							$(".container").removeAttr('style');
							$(".back_icon").hide();
							// $(".card").removeAttr('style');
							$(".card").css("width", "");
							$(".card").css("border-radius", "");
							$(".card").css("margin", "");
							$(".desc").css("border-radius", "10px");
							$("body").css("overflow", "hidden");
						} else {
							$("nav").addClass("head_hide");
							$(".card").draggable("disable");
							$(".container").css(container_css_facinfo);
							$("body").css("overflow-y", "auto");
							$(".fac_info").slideDown("fast");
							$(".back_icon").show();
							$(".card").css(card_css);
							$(".desc").css("border-radius", "0px");
						}
					});

					$(".mypage_link").on("click", function() {
						$(this).hide();
						$(".top_filter").hide();
						$(".card").draggable("disable");
						$(".select").hide();
						$("body").css("overflow-y", "auto");
						$(".mypage_back").show();
						$(".card").addClass("show_mypage");
						$(".card").animate({
							"left": "+=130%"
						}, "fast");
						$(".my_info").show();
						$(".my_info").animate({
							"left": "+=130%"
						}, "fast");
					})

					$(".mypage_back").on("click", function() {
						$(this).hide();
						$(".card").draggable("enable");
						$(".select").slideDown("fast");
						$("body").css("overflow-y", "hidden");
						$(".mypage_link").show();
						$(".top_filter").show();
						$(".card").removeClass("show_mypage");
						$(".card").animate({
							"left": "-=130%"
						}, "fast");
						$(".my_info").hide();
						$(".my_info").animate({
							"left": "-=130%"
						}, "fast");
					});

					$(".top_filter").on("click", function() {
						$(".filter").slideToggle("fast");
					});

					// $(".yoyaku_btn").clickSpark({
					// 	particleImagePath: 'https://raw.githubusercontent.com/ymc-thzi/clickspark.js/master/demo/particle-2.png',
					// 	particleCount: 10,
					// 	particleSpeed: 8,
					// 	particleSize: 15,
					// 	particleDuration: 0,
					// 	particleRotationSpeed: 20
					// });

					$(".like_btn").on("click", function() {
						$(".container").find(".card").filter(":last").find(".like_label").css("opacity", "1");
						$(".container").find(".card").filter(":last").animate({
							"left": "+=130%"
						}, "fast");
						var set = setTimeout(function() {
							$(".container").find(".card").filter(":last").remove();
						}, 300);
					});
					$(".nope_btn").on("click", function() {
						$(".container").find(".card").filter(":last").find(".nope_label").css("opacity", "1");
						$(".container").find(".card").filter(":last").animate({
							"left": "-=200%"
						}, "fast");
						var set = setTimeout(function() {
							$(".container").find(".card").filter(":last").remove();
						}, 300);
					});

					$(".yoyaku_btn").on("click", function() {
						setTimeout(function() {
							$("body").css("overflow", "auto");
						}, 500)
					});

					$(".henshu_btn").on("click", function() {
						$(".mypro_edit").animate({
							"top": "+=130%"
						}, "fast");
						$("body").css("overflow", "hidden");
					});

					$(".henkou_btn").on("click", function() {
						$(".mypro_edit").animate({
							"top": "-=130%"
						}, "fast");
						$("body").css("overflow-y", "auto");
					});
				})

				//マイページの基本情報埋め込み
				$(".uname").html(info[3]['name']);
				$(".hadr").html(info[3]['home_adr_name']);
				$(".wadr").html(info[3]['work_adr_name']);

				$(':text[name=workad_edit]').val(info[3]['work_adr_name']);
				$(':text[name=homead_edit]').val(info[3]['home_adr_name']);

			}).error(function() {
				// 通信失敗時の処理
				console.log("error");
			}).complete(function() {
				// 通信完了時の処理
				console.log("fin");
			});

			//カレンダー
			$.datepicker.setDefaults($.datepicker.regional["ja"]);
			$('#calendar').datepicker({
				maxDate: '+5y', //5年後までが選択可能範囲
				changeYear: true, //表示年の指定が可能
				changeMonth: true, //表示月の指定が可能
				dateFormat: 'yy-mm-dd(D)', //年-月-日(曜日)
				altField: $(".calendar_input"),
				beforeShowDay: function(date) {
					if (date.getDay() == 0) {
						return [true, 'sunday'];
					}
					// 土曜日
					if (date.getDay() == 6) {
						return [true, 'saturday'];
					}
					// 平日
					return [true, ''];

				}
			});

			$("#calendar").on("click", function() {
				var like = "";
				$("a").each(function() {
					if ($(this).text() == "21") {
						$(this).css("background-color", "#F19483");
					}
				});
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
				<div class="navbar-brand navbar-brand-center"><span>Resolv</span></div>
				<div class="mypage_link">
					<i class="glyphicon glyphicon-user"></i>
				</div>
				<div class="top_filter">
					<i class="glyphicon glyphicon-filter"></i>
				</div>
			</div>
		</nav>
		<!-- 絞り込み -->
		<div class="filter" style="display:none">
			<div class="filter_select">
				<div class="filter_area filter_content">
					場所　　
					<select class="a" name="aaa">
						<option value="n">選択してください</option>
						<option value="a">渋谷</option>
						<option value="b">池袋</option>
					</select>
				</div>
				<div class="filter_genre filter_content">
					ジャンル
					<select class="a" name="aaa">
						<option value="n">選択してください</option>
						<option value="a">ジャンル１</option>
						<option value="b">ジャンル２</option>
						<option value="c">ジャンル３</option>
						<option value="d">ジャンル４</option>
					</select>
				</div>
				<div class="filter_genre filter_content">
					<input type="radio" name="active" value="アクティブ">アクティブ　
					<input type="radio" name="active" value="非アクティブ">非アクティブ
				</div>
				<div class="filter_genre filter_content">
					<input type="radio" name="pricing" value="無料">無料　　　　
					<input type="radio" name="pricing" value="有料">有料　　　　
				</div>
				<div class="filter_keyword filter_content">
					キーワード
					<input type="text" name="" value="">
				</div>
				<div class="filter_search filter_content">
					<span>絞り込む</span>
				</div>
			</div>
		</div>
		<div id="fac"></div>
		<!-- 施設詳細画面 -->
		<div class="fac_info" style="display:none">
			<p class="left_30" style="padding-top:150px"><span style="font-weight:bold">日付</span>　　　2017/10/02</p>
			<p class="left_30"><span style="font-weight:bold">時間</span>　　　19:00〜21:00</p>
			<p class="left_30"><span style="font-weight:bold">料金</span>　　　1000円<br><span id="pricing"></span></p>
			<p class="left_30"><span style="font-weight:bold">エリア</span>
				<span id="plc_name"></span><br>
				<span id="plc_pref"></span><br>
				<span id="plc_area"></span>
			</p>
			<p class="left_30"><span style="font-weight:bold">タイプ</span>
				<?= $view_4; ?>
			</p>
			<p class="left_30"><span style="font-weight:bold">ジャンル</span>
				<span id="genre"></span>
			</p>
			<p class="left_30"><span style="font-weight:bold">詳細</span>
				<?= $view_2; ?>
			</p>
			<p class="left_30"><span style="font-weight:bold">予約状況</span>　　32人 / 50人</p>
			<div class="yoyaku_btn">
				カレンダー予約
			</div>
			<p class="left_30" style="border-top:none"><span style="font-size:18px">施設情報</span></p>
			<p class="left_30"><span style="font-weight:bold">施設名</span>
				<span id="fac_name"></span><br>　　　　　<span style="color:blue">この施設で検索する</span></p>
			<p class="left_30"><span style="font-weight:bold">時間</span>　　　9:00~23:00</p>
			<p class="left_30"><span style="font-weight:bold">料金</span>　　　大人500円　小人250円</p>
			<p class="left_30"><span style="font-weight:bold">定休日</span>　　毎週火曜日</p>
			<p class="left_30"><span style="font-weight:bold">電話番号</span>
				<span id="fac_tel"></span>
			</p>
			<p class="left_30"><span style="font-weight:bold">場所</span>　　　〒123-1123<br>
				<span id="fac_adr"></span>
			</p>
			<p class="left_30"><span style="font-weight:bold">施設詳細</span>
				<span id="fac_desc"></span>
			</p>
			<p style="height:150px">　</p>
			<!-- kosegawaが編集[End] -->
		</div>

		<!-- マイページ画面 -->
		<div class="my_info" style="display:none">
			<!-- プロフィール詳細 -->
			<img class="my_info_img" src="https://pbs.twimg.com/profile_images/686486647270080512/_ACbdMxU.png" alt="プロフが〜" style="height:150px; width:auto">
			<p class="left_30" style="border-top:none"><span style="font-weight:bold">NAME</span>　　　<span class="uname"></span></p>
			<p class="left_30"><span style="font-weight:bold">勤務地</span>　　　<span class="wadr"></span></p>
			<p class="left_30"><span style="font-weight:bold">居住地</span>　　　<span class="hadr"></span></p>
			<div class="henshu_btn">
				編集する
			</div>

			<!-- プロフィール編集画面 -->
			<div class="mypro_edit">
				<img src="https://pbs.twimg.com/profile_images/686486647270080512/_ACbdMxU.png" alt="プロフが〜" style="height:100px; width:auto">
				<p class="left_30" style="border-top:none"><span style="font-weight:bold">NAME</span>　　　<span class="uname"></span></p>
				<p class="left_30"><span style="font-weight:bold">PW</span>　　　<input type="text" name="pw_edit" value="goootooou"></p>
				<p class="left_30"><span style="font-weight:bold">勤務地</span>　　　<input type="text" name="workad_edit"></p>
				<p class="left_30"><span style="font-weight:bold">居住地</span>　　　<input type="text" name="homead_edit"></p>
				<p class="left_30"><span style="font-weight:bold">email</span>　　　<input type="text" name="homead_edit" value="goto@gmail"></p>
				<p class="left_30"><span style="font-weight:bold">悩み</span>
					<input type="checkbox" name="nayami" value="0">運動不足
					<input type="checkbox" name="nayami" value="1">友達欲しい
					<input type="checkbox" name="nayami" value="2">学びたい
				</p>
				<div class="henkou_btn">
					変更する
				</div>
			</div>

			<!-- likeイベント一覧 -->
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

			<!-- カレンダー -->
				<p style="font-size:18px; border-top:3px solid #d8d8d8; padding-top:20px">イベント確認</p>
				<input class="calendar_input" type="text" style="margin-left:50px; display:none">
			  <div class="calendar_wrap">
					<div id="calendar"></div>
				</div>
				<p style="margin-bottom:50px">
					<i class="today_color glyphicon glyphicon-stop"></i>今日　
					<i class="like_color glyphicon glyphicon-stop"></i>LIKEしたイベントがある日<br>
					<i class="yoyaku_color glyphicon glyphicon-stop"></i>予約したイベントがある日<br>
				</p>
				<!-- <div class="henkou_btn">
						イベントを確認
				</div> -->

			<!-- like傾向円グラフ -->
			<!-- メモ：配列で%の大きい順に格納して、◯個目以降は「その他」表示が良い？ -->
			<p style="font-size:18px; border-top:3px solid #d8d8d8; padding-top:20px">goootooouさんのlike傾向</p>
			<div class="chart_wrap">
				<svg id="chart"></svg>
				<p>
					<i class="d3_color_0 glyphicon glyphicon-stop"></i>ジャンル1<br>
					<i class="d3_color_1 glyphicon glyphicon-stop"></i>ジャンル2<br>
					<i class="d3_color_2 glyphicon glyphicon-stop"></i>ジャンル3<br>
					<i class="d3_color_3 glyphicon glyphicon-stop"></i>ジャンル4
				</p>
			</div>
		</div>
		<div class="select row">
			<div class="col-xs-4 s_button nope_btn"><img src="images/ng.png" alt="NG"></div>
			<div class="col-xs-4 s_button star_btn"><img src="images/star.png" alt="お気に入り"></div>
			<div class="col-xs-4 s_button like_btn"><img src="images/good.png" alt="OK"></div>
		</div>
	</div>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
	<script src="http://d3js.org/d3.v3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/d3.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
	<!-- <script src="http://d3js.org/d3.v3.min.js"></script> -->
	<script src="js/bootstrap.min.js"></script>
	<!-- <script src="js/d3.js"></script> -->
	<!-- kosegawaが編集[Start] -->
	<script>
		//下3つをクリックした時のアクション
		$(".like_btn,.s_like_btn,.nope_btn").on("click", function() {
			let type = $(this).children("img").attr("alt");
			updateTrend(type);
		});

		function updateTrend(type) {
			let user_id = 1;
			let event_id = info[1][num]["e_id"];
			let active_flg = info[1][num]["active"];
			let pricing_flg = info[1][num]["pricing"];
			let plc_id = info[1][num]["plc_id"];
			let genre_id_0 = info[1][num]["genre_id_0"];
			let genre_id_1 = info[1][num]["genre_id_1"];
			let genre_id_2 = info[1][num]["genre_id_2"];
			let genre_id_3 = info[1][num]["genre_id_3"];
			$.ajax({
				url: "save_count.php",
				cache: false,
				type: "POST",
				data: {
					user_id: user_id,
					event_id: event_id,
					active_flg: active_flg,
					pricing_flg: pricing_flg,
					plc_id: plc_id,
					genre_id_0: genre_id_0,
					genre_id_1: genre_id_1,
					genre_id_2: genre_id_2,
					genre_id_3: genre_id_3,
					type: type
				}
			}).success(function() {
				// 通信成功時の処理
				console.log("ajaxOK");
			}).error(function() {
				// 通信失敗時の処理
				console.log("error");
			}).complete(function() {
				// 通信完了時の処理
				console.log("fin");
			});

			num++;
			$("#pricing").html(info[1][num]['pricing']);
			$("#fac_name").html(info[1][num]['fac_name']);
			$("#fac_tel").html(info[1][num]['fac_tel']);
			$("#fac_adr").html(info[1][num]['fac_adr']);
			$("#plc_name").html(info[1][num]['plc_name']);
			$("#plc_pref").html(info[1][num]['plc_pref']);
			$("#plc_area").html(info[1][num]['plc_area']);
			$("#genre").html(genre_view[num]);

		}
	</script>
	<!-- kosegawaが編集[End] -->
</body>

</html>