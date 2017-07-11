<?php
session_start();

//ifでcountされているかを判定して、
//なければ0、あればgetで受け取りformに送る

//カウント用のフィールド（例えばcount_value）の初期値ゼロにしておきます。
//ボタンをクリックするためのhtmlのフォームで、ボタンにそのユニークIDをつけて
//ボタンにonclickイベントでjavascriptからフォーム送信するように仕込みます。

//ログイン中のユーザのユニークIDを受信しておく、


//user_idをGETで取ってくる（仮に1）
//または、施設ページからのmaruの場合はfac_idをGETで取ってくる（仮に1）
//$user_id = 1;
$user_id = $_POST["user_id"];

//DB定義
const DSN = "mysql:dbname=resolv;charset=utf8;host=localhost";
const USER = "root";
const PASS = "";

//DB接続
try {
    $pdo = new PDO(DSN, USER, PASS);
} catch(PDOException $e) {
    exit('DbConnectError:'. $e->getMessage());
}

//mysqlテーブル指定
$sql = "SELECT * FROM save_data WHERE user_id=:user_id";

//作成したmysqlテーブルにbindValueの変数をDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);

//DB登録、実行
$status = $statement->execute();

//データ表示処理
if($status == false) {
    $error = $statement->errorInfo();
    exit("QueryError:". $error[2]);
} else {
    $row = $statement->fetch();
}

if($doors == 0) {
    $sql = "UPDATE save_data
        SET doors = doors + 1
        WHERE user_id = :user_id;";
} else {
    $sql = "UPDATE save_data
        SET doors = doors + 2
        WHERE user_id = :user_id;";
}
//作成したmysqlテーブルにbindValueの変数をDBに入れる
$statement = $pdo->prepare($sql);
//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
//DB更新、実行
$status = $statement->execute();

//DB登録後の処理
if($status==false) {
    $error = $statement->errorInfo();
    exit("QueryError:". error[2]);
} else {
//    header("Location: save2_post.php");
    $_SESSION["user_id"]=$user_id;
    exit;
}

?>