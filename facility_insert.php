
<?php

//データの受け取り
$name = $_POST["name"];
$address = $_POST["address"];
$tel = $_POST["tel"];
$description = $_POST["description"];
$plc_id = $_POST["plc_id"];
$doors = $_POST["doors"];
$pricing = $_POST["pricing"];
$genre = $_POST["genre"];

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
$sql =
    "INSERT INTO fac_info(
        fac_id, name, address, tel, description, plc_id, doors, pricing, genre
    ) VALUES (
        NULL, :name, :address, :tel, :description, :plc_id, :doors, :pricing, :genre
    )";

//作成したmysqlテーブルにbindValueの変数をDBに入れる
$statement = $pdo->prepare($sql);

//取得したデータをbindValueの変数に代入、↑に行く、リンクする
$statement->bindValue(':name', $name, PDO::PARAM_STR);
$statement->bindValue(':address', $address, PDO::PARAM_STR);
$statement->bindValue(':tel', $tel, PDO::PARAM_STR);
$statement->bindValue(':description', $description, PDO::PARAM_STR);
$statement->bindValue(':plc_id', $plc_id, PDO::PARAM_INT);
$statement->bindValue(':doors', $doors, PDO::PARAM_INT);
$statement->bindValue(':pricing', $pricing, PDO::PARAM_INT);
$statement->bindValue(':genre', $genre, PDO::PARAM_INT);

//DB登録、実行
$status = $statement->execute();

//DB登録後の処理
if($status==false) {
    $error = $statement->errorInfo();
    exit("QueryError:". error[2]);
} else {
    header("Location: facility.php");
    exit;
}





?>
