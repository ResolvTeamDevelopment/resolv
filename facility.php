
<?php

include (db.php);
//
////DB定義
//const DSN = "mysql:dbname=resolv;charset=utf8;host=localhost";
//const USER = "root";
//const PASS = "";
//
////DB接続
//try {
//    $pdo = new PDO(DSN, USER, PASS);
//} catch(PDOException $e) {
//    exit('DbConnectError:'. $e->getMessage());
//}
//
////mysqlテーブル指定
//$sql = "SELECT * FROM fac_info";
//
////作成したmysqlテーブルにbindValueの変数をDBに入れる
//$statement = $pdo->prepare($sql);
//
////DB登録、実行
//$status = $statement->execute();
//
////配列から取った値を入れる変数の定義
//$view = "";
//
////データ表示処理
//if($status==false) {
//    $error = $statement->errorInfo();
//    exit("QueryError:". $error[2]);
//} else {
//    while( $result = $statement->fetch(PDO::FETCH_ASSOC)){
//        $view .= "<p>";
//        //$view .= '<a href="qa_update_view.php?id='. $result["id"]. '">';
//        $view .= "</p>";
//    }
//}
$view = "施設の情報". "　　";




?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="reset.css">
        <link href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.css'>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>
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
            <div><?= $view; ?>(施設名)</div><!-- 施設名 -->
            <div><?= $view; ?>(住所)</div><!-- 住所 -->
            <div><?= $view; ?>(電話番号)</div><!-- 電話番号 -->
            <div><?= $view; ?>(23区の場所、tbl_placeと連携)</div><!-- tbl_placeと連携 -->
            <div><?= $view; ?>(施設詳細)</div><!-- 施設詳細 -->
        </div>
        <!-- 施設情報の表示[End] -->
        
        <!-- データ送信[Start] -->
        <form action="save.php" method="post">
            <input type="text" name="name" value="name">
            <input type="text" name="address" value="name">
            <input type="text" name="tel" value="name">
            <input type="text" name="description" value="name">
            <input type="text" name="plc_id" value="1">
            <input type="text" name="doors" value="1">
            <input type="text" name="pricing" value="1">
            <input type="text" name="genre" value="1">
            <input type="submit" value="Yes">
        </form>
        <form action="" method="post">
            <input type="submit" value="スケジュールに入れる">
        </form>
        <!-- データ送信[End] -->
        
        
        <!-- footer[Start] -->
        <footer>
        </footer>
        <!-- footer[End] -->
        
    </body>
</html>