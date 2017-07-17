<?php
session_start();
include 'db.php'; //DB接続情報読み込み
$pdo = db_con();

//user_idをGETで取ってくる（仮に1）
//または、施設ページからのmaruの場合はfac_idをGETで取ってくる（仮に1）
$user_id = $_POST["user_id"];
$type = $_POST["type"];
$active_flg = $_POST["active_flg"];
$pricing_flg = $_POST["pricing_flg"];
$plc_id = $_POST["plc_id"];

$genre_id_0 = $_POST["genre_id_0"];
$genre_id_1 = $_POST["genre_id_1"];
$genre_id_2 = $_POST["genre_id_2"];
$genre_id_3 = $_POST["genre_id_3"];
//genre_idを配列に格納
$genre_array = [
    $genre_id_0,
    $genre_id_1,
    $genre_id_2,
    $genre_id_3
];

//mysqlテーブル指定
$sql = "SELECT * FROM user_needs_score WHERE user_id=:user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

//DB登録、実行
$status = $stmt->execute();

//type分け
if ($type == 0) {
    //＋１するカウント[Start]
    if ($active_flg == 0) {
        $sql = "UPDATE user_needs_score
        SET nonactive = nonactive + 1,";
    } elseif ($active_flg == 1) {
        $sql = "UPDATE user_needs_score
        SET active = active + 1,";
    }
    if ($pricing_flg == 0) {
        $sql .= "free = free + 1,";
    } elseif ($pricing_flg == 1) {
        $sql .= "priced = priced + 1,";
    }

    $sql .= "plc_id_". "$plc_id".  "= plc_id_". "$plc_id".  " + 1,";

    // $genre_arrayが該当するまでループ
    for ($g = 0; $g <= 3; $g++) {
        if ($genre_array[$g] == 1) {
            $sql .= "genre_id_". "$g".  "= genre_id_". "$g".  " + 1,";
        }
    }
    $sql = rtrim($sql, ",");
    $sql .= " WHERE user_id = :user_id;";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    //DB登録、実行
    $status = $stmt->execute();
    //＋１するカウント[End]
    
    //イベントを＋１するカウント[Start]
    //event_idをPOSTで取ってくる（仮に1）
    $event_id = $_POST["event_id"];

    $sql = "UPDATE event_info
        SET event_like = event_like + 1
        WHERE event_id = :event_id;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT);
    //DB登録、実行
    $status = $stmt->execute();
    //イベントを＋１するカウント[End]
} elseif ($type == 1) {
    //＋２するカウント[Start]
    if ($active_flg == 0) {
        $sql = "UPDATE user_needs_score
        SET nonactive = nonactive + 2,";
    } elseif ($active_flg == 1) {
        $sql = "UPDATE user_needs_score
        SET active = active + 2,";
    }
    if ($pricing_flg == 0) {
        $sql .= "free = free + 2,";
    } elseif ($pricing_flg == 1) {
        $sql .= "priced = priced + 2,";
    }

    $sql .= "plc_id_". "$plc_id".  "= plc_id_". "$plc_id".  " + 2,";
    
    // $genre_arrayが該当するまでループ
    for ($g = 0; $g <= 3; $g++) {
        if ($genre_array[$g] == 1) {
            $sql .= "genre_id_". "$g".  "= genre_id_". "$g".  " + 2,";
        }
    }
    $sql = rtrim($sql, ",");
    $sql .= " WHERE user_id = :user_id;";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    //DB登録、実行
    $status = $stmt->execute();
    //＋２するカウント[End]
    
    //イベントを＋２するカウント[Start]
    //event_idをPOSTで取ってくる（仮に1）
    $event_id = $_POST["event_id"];

    $sql = "UPDATE event_info
        SET event_like = event_like + 2
        WHERE event_id = :event_id;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT);
    //DB登録、実行
    $status = $stmt->execute();
    //イベントを＋２するカウント[End]
} elseif ($type == 2) {
    //NOPEを＋１するカウント[Start]
    if ($active_flg == 0) {
        $sql = "UPDATE user_needs_score_n
        SET nonactive = nonactive + 1,";
    } elseif ($active_flg == 1) {
        $sql = "UPDATE user_needs_score_n
        SET active = active + 1,";
    }
    if ($pricing_flg == 0) {
        $sql .= "free = free + 1,";
    } elseif ($pricing_flg == 1) {
        $sql .= "priced = priced + 1,";
    }

    $sql .= "plc_id_". "$plc_id".  "= plc_id_". "$plc_id".  " + 1,";

    // $genre_arrayが該当するまでループ
    for ($g = 0; $g <= 3; $g++) {
        if ($genre_array[$g] == 1) {
            $sql .= "genre_id_". "$g".  "= genre_id_". "$g".  " + 1,";
        }
    }
    $sql = rtrim($sql, ",");
    $sql .= " WHERE user_id = :user_id;";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    //DB登録、実行
    $status = $stmt->execute();
    //NOPEを＋１するカウント[End]
}

?>