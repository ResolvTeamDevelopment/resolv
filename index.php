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
			</p>
			<p class="left_30"><span style="font-weight:bold">ジャンル</span>
				<span id="genre"></span>
			</p>
			<p class="left_30"><span style="font-weight:bold">詳細</span>
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
			<div class="form-horizontal mypro_edit">
				<div class="form-group">
					<label class="control-label col-xs-4 text-right">画像</label>
					<div class="col-xs-6 text-left">
						<img src="https://pbs.twimg.com/profile_images/686486647270080512/_ACbdMxU.png" alt="プロフが〜" style="height:100px; width:auto">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-4 text-right">Name</label>
					<div class="col-xs-6">
						<input type="text" name="uname" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-4 text-right">email</label>
					<div class="col-xs-6">
						<input type="text" name="emailad_edit" class="form-control">
					</div>
				</div>
<!--
				<div class="form-group">
					<label class="control-label col-xs-2">パスワード</label>
					<div class="col-xs-5">
						<input type="text" name="password" class="form-control">
					</div>
				</div>
-->
				<div class="form-group">
					<label class="control-label col-xs-4 text-right">勤務地</label>
					<div class="col-xs-6">
						<select class="form-control" name="workad_edit" id="workad_edit"></select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-4 text-right">居住地</label>
					<div class="col-xs-6">
						<select class="form-control" name="homead_edit" id="homead_edit"></select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-4 text-right">解決課題</label>
					<div class="col-xs-6 text-left">
							<label>
								<input type="checkbox" name="nayami" value="0"> 運動不足 
								<input type="checkbox" name="nayami" value="1"> 友達欲しい 
								<input type="checkbox" name="nayami" value="2"> 学びたい 
							</label>
						
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-default henkou_btn">変更する</button>
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
	<script src="http://d3js.org/d3.v3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/d3.js"></script>
	<script type="text/javascript" src="js/func.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>