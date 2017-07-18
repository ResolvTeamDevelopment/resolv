var num = 0;
var info;
var genre_view = [];

var users = []; //usersテーブル用配列
var user_prof = []; //user_profileテーブル用配列

$(function () {
	$.ajax({
		url: "getdata.php",
		cache: false,
		type: "POST"
	}).success(function (data) {
		// 通信成功時の処理
		console.log("ajaxOK");
		info = JSON.parse(data);
		console.log(info);
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

		$(".card").draggable({

			drag: function (event, ui) {
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
			stop: function (event, ui) {
				var offset = $(this).offset();
				// alert(offset.left);
				if (offset.left <= -80) {
					updateTrend("nope");
					$(this).css("display", "none");
				} else if (offset.left >= 80) {
					updateTrend("like");
					// $(".submit").click();
					$(this).css("display", "none");
				} else {
					$(this).css({
						top: 0,
						right: 0,
						left: 0,
						bottom: 0
					});
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
		$(".card").on("click", function () {
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

		$(".mypage_link").on("click", function () {
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

		$(".mypage_back").on("click", function () {
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

		$(".top_filter").on("click", function () {
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

		$(".like_btn").on("click", function () {
			$(".container").find(".card").filter(":last").find(".like_label").css("opacity", "1");
			$(".container").find(".card").filter(":last").animate({
				"left": "+=130%"
			}, "fast");
			var set = setTimeout(function () {
				$(".container").find(".card").filter(":last").remove();
			}, 300);
		});
		$(".nope_btn").on("click", function () {
			$(".container").find(".card").filter(":last").find(".nope_label").css("opacity", "1");
			$(".container").find(".card").filter(":last").animate({
				"left": "-=200%"
			}, "fast");
			var set = setTimeout(function () {
				$(".container").find(".card").filter(":last").remove();
			}, 300);
		});

		$(".yoyaku_btn").on("click", function () {
			setTimeout(function () {
				$("body").css("overflow", "auto");
			}, 500)
		});

		$(".henshu_btn").on("click", function () {
			$(".mypro_edit").animate({
				"top": "+=130%"
			}, "fast");
			$("body").css("overflow", "hidden");
		});

		$(".henkou_btn").on("click", function () {
			$(".mypro_edit").animate({
				"top": "-=130%"
			}, "fast");
			$("body").css("overflow-y", "auto");


		});


		//マイページの基本情報埋め込み
		$(".uname").html(info[3]['name']);
		$(".hadr").html(info[3]['home_adr_name']);
		$(".wadr").html(info[3]['work_adr_name']);

		$(':text[name=workad_edit]').val(info[3]['work_adr_name']);
		$(':text[name=homead_edit]').val(info[3]['home_adr_name']);

		//プロフィール編集画面
		//name
		$(':text[name=uname]').val(info[3]['name']);

		//地域select
		var plc_slct_hm = "";
		for (var i = 0; i < info[4].length; i++) {
			if (info[3]['home_adr_id'] == info[4][i]["plc_id"]) {
				plc_slct_hm += `<option selected>${info[4][i]["name"]}</option>`;
			}
			plc_slct_hm += `<option>${info[4][i]["name"]}</option>`;
		}
		$("#homead_edit").html(plc_slct_hm);

		var plc_slct_wk = "";
		for (var i = 0; i < info[4].length; i++) {
			if (info[3]['work_adr_id'] == info[4][i]["plc_id"]) {
				plc_slct_wk += `<option selected>${info[4][i]["name"]}</option>`;
			}
			plc_slct_wk += `<option>${info[4][i]["name"]}</option>`;
		}
		$("#workad_edit").html(plc_slct_wk);

		//メアドinput
		$(':text[name=emailad_edit]').val(info[3]['email']);

		//ニーズ（悩み）


	}).error(function () {
		// 通信失敗時の処理
		console.log("error");
	}).complete(function () {
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
		beforeShowDay: function (date) {
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

	$("#calendar").on("click", function () {
		var like = "";
		$("a").each(function () {
			if ($(this).text() == "21") {
				$(this).css("background-color", "#F19483");
			}
		});
	});
}) //End オンロード

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

function updateAcInfo(field, param) {
	console.dir(field);
	console.dir(param);
	
	console.log(isset(field));
	console.log(isset(param));
}