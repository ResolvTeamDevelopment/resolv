
<?php

include 'db.php'; //DB接続情報読み込み
$pdo = db_con();
//const DSN = "mysql:dbname=resolv;charset=utf8;host=localhost";
//const USER = "root";
//const PASS = "";
//try {
//    $pdo = new PDO(DSN, USER, PASS);
//} catch(PDOException $e) {
//    exit('DbConnectError:'. $e->getMessage());
//}

//仮に1、GETで受け取る
$event_id = 1;
//ajaxのとこで使う
//$user_id = $_SESSION["user_id"];
//23区の場所のとこで使う、tbl_placeと連携させる
//$plc_id = $_SESSION["plc_id"];

//mysqlテーブル指定
$sql = "SELECT * FROM event_info WHERE event_id = '$event_id'";
//作成したmysqlテーブル(にbindValueの変数)をDBに入れる
$stmt = $pdo->prepare($sql);
//DB登録、実行
$status = $stmt->execute();


//【placeテーブル】の関連
if ($status==false) {
    qerror($stmt); //SQL処理エラー
} else {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}

//mysqlテーブル指定、、、、、【placeテーブル】
$sql = "SELECT * FROM place WHERE plc_id = '".$result["plc_id"]."'";
//作成したmysqlテーブル(にbindValueの変数)をDBに入れる
$stmt2 = $pdo->prepare($sql);
//DB登録、実行
$status = $stmt2->execute();

$view_place_name = "";
//【placeテーブル】の関連
if ($status==false) {
    qerror($stmt2); //SQL処理エラー
} else {
    $result_place_name = $stmt2->fetch(PDO::FETCH_ASSOC);
    $view_place_name = $result_place_name["name"];
}


//配列から取った値を入れる変数の定義
$view_1 = "";
$view_2 = "";
$view_3 = "";
$view_4 = "";
$view_5 = "";
$view_6 = "";
$view_7 = "";
$view_8 = "";
$view_9 = "";


$view_1 .= "<p>". $result["name"]. "</p>";
$view_2 .= "<p>". $result["description"]. "</p>";

//引っ張ってくる
$view_3 .= "<p>". $view_place_name. "</p>";


$active = $result["active"];
$pricing = $result["pricing"];
if ($active == 0) {
    $view_4 .= "<p>". $result["active"]. "：非アクティブ". "</p>";
} elseif ($active == 1) {
    $view_4 .= "<p>". $result["active"]. "：アクティブ". "</p>";
}
if ($pricing == 0) {
    $view_5 .= "<p>". $result["pricing"]. "：無料". "</p>";
} elseif ($pricing == 1) {
    $view_5 .= "<p>". $result["pricing"]. "：有料". "</p>";
}


$genre_id_0 = $result["genre_id_0"];
$genre_id_1 = $result["genre_id_1"];
$genre_id_2 = $result["genre_id_2"];
$genre_id_3 = $result["genre_id_3"];
if ($genre_id_0 == 1) {
    $view_6 .= "<p>". $result["genre_id_0"]. "：スポーツ". "</p>";
}
if ($genre_id_1 == 1) {
    $view_7 .= "<p>". $result["genre_id_1"]. "：レジャー". "</p>";
}
if ($genre_id_2 == 1) {
    $view_8 .= "<p>". $result["genre_id_2"]. "：セミナー". "</p>";
}
if ($genre_id_3 == 1) {
    $view_9 .= "<p>". $result["genre_id_3"]. "：フェス". "</p>";
}

?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
<!--        <link rel="stylesheet" href="reset.css">-->
        <link href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.css'>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>
<!--        <script src="js/jquery-2.1.3.min.js"></script>-->
<!--        <script src="js/func.js"></script>-->
        <title>施設情報 - resolv</title>
    </head>
    <body>
       
        <!-- header[Start] -->
        <header>
        </header>
        <!-- header[End] -->
        
        <div>
            <p><a href="gotou/index.php">Back</a></p>
        </div>
        
        <div class="facility_content">
            <h1 class="facility_item">「施設の名前」</h1>
            <img src="images/sample.jpg" alt="">
        </div>
        
        <!-- 施設情報の表示[Start] -->
        <div>
            <div><?= $view_1; ?></div>
            <div><?= $view_2; ?></div>
            <div><?= $view_3; ?></div>
            <div><?= $view_4; ?></div>
            <div><?= $view_5; ?></div>
            <div><?= $view_6; ?></div>
            <div><?= $view_7; ?></div>
            <div><?= $view_8; ?></div>
            <div><?= $view_9; ?></div>
        </div>
        <!-- 施設情報の表示[End] -->
        
        <!-- データ送信(LIKE,NOPE)[Start] -->
        <form action="save_count.php" method="post">
            <button type="button" id="like_btn" name="user_id"><p>LIKE</p></button>
            <button type="button" id="s_like_btn" name="user_id"><p>SUPER LIKE</p></button>
            <button type="button" id="nope_btn" name="user_id"><p>NPOE</p></button>
        </form>
        <!-- データ送信(LIKE,NOPE)[End] -->
        
        
        <!-- データ送信(予約)[Start] -->
        <form action="" method="post">
            <button type="button" id="" name=""><p>スケジュールに入れる</p></button>
        </form>
        <!-- データ送信(予約)[End] -->
        
        
        <!-- footer[Start] -->
        <footer>
        </footer>
        <!-- footer[End] -->
        
        
        <script>

            //LIKEにした時のアクション
            $("#like_btn").on("click", function(){
                //valの取得は検討中
                //    let user_id = $("#user_id").val;
                //    let fac_id = $("#fac_id").val;
                //    let doors = $("#doors").val;
                //    let genre_id = $("#genre_id").val;

                //仮の変数
                let repw = 0;
                let newpw = 0;
                let user_id = 1;
                let event_id = 1;
                if (newpw != repw) {
                    alert("新パスワードの入力が再入力パスワードと一致しません");
                } else {
                    $.ajax({
                        url: "save_count.php",
                        cache: false,
                        type: "POST",
                        data: {
                            user_id: user_id,
                            event_id: event_id,
                            type:0
                        }
                    }).success(function () {
                        // 通信成功時の処理
//                        window.location.href="facility.php"; //topに移動
                        console.log("ajaxOK");
                    }).error(function () {
                        // 通信失敗時の処理
                        console.log("error");
                    }).complete(function () {
                        // 通信完了時の処理
                        console.log("fin");
                    });
                }
            });
            
            //SuperLIKEにした時のアクション
            $("#s_like_btn").on("click", function(){
                //valの取得は検討中
                //    let user_id = $("#user_id").val;
                //    let fac_id = $("#fac_id").val;
                //    let doors = $("#doors").val;
                //    let genre_id = $("#genre_id").val;

                //仮の変数
                let repw = 0;
                let newpw = 0;
                let user_id = 1;
                let event_id = 1;
                if (newpw != repw) {
                    alert("新パスワードの入力が再入力パスワードと一致しません");
                } else {
                    $.ajax({
                        url: "save_count.php",
                        cache: false,
                        type: "POST",
                        data: {
                            user_id: user_id,
                            event_id: event_id,
                            type:1
                        }
                    }).success(function () {
                        // 通信成功時の処理
//                        window.location.href="facility.php"; //topに移動
                        console.log("ajaxOK");
                    }).error(function () {
                        // 通信失敗時の処理
                        console.log("error");
                    }).complete(function () {
                        // 通信完了時の処理
                        console.log("fin");
                    });
                }
            });
            
            //NOPEにした時のアクション
            $("#nope_btn").on("click", function(){
                //valの取得は検討中
                //    let user_id = $("#user_id").val;
                //    let fac_id = $("#fac_id").val;
                //    let doors = $("#doors").val;
                //    let genre_id = $("#genre_id").val;

                //仮の変数
                let repw = 0;
                let newpw = 0;
                let user_id = 1;
                if (newpw != repw) {
                    alert("新パスワードの入力が再入力パスワードと一致しません");
                } else {
                    $.ajax({
                        url: "save_count.php",
                        cache: false,
                        type: "POST",
                        data: {
                            user_id: user_id,
                            type:2
                        }
                    }).success(function () {
                        // 通信成功時の処理
//                        window.location.href="facility.php"; //topに移動
                        console.log("ajaxOK");
                    }).error(function () {
                        // 通信失敗時の処理
                        console.log("error");
                    }).complete(function () {
                        // 通信完了時の処理
                        console.log("fin");
                    });
                }
            });

        </script>
    </body>
</html>