<?php
session_start();

$row = 0;
$user_id = 1;


?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0">
        <title>Document</title>
        <script src="js/jquery-2.1.3.min.js"></script>
        <script src="js/func.js"></script>
    </head>
    <body>
        
        <p><?= $row["doors"] ?></p>
        
        <form action="save2.php" method="post" id="form_id">
<button type="button" id="btn_id" name="user_id" value="1"><p>a</p></button>
            <input type="hidden" name="user_id" value="1">
            <input type="submit" value="sub">
        </form>
        
        <script>
//            $("#btn_id").on("click", function(){
//                console.log("okClick");
//                $('#form_id').submit();
//            });
            
            //maruボタンを押した時のアクション
            $("#btn_id").on("click", function(){
                //valの取得は検討中
                //    let user_id = $("#user_id").val;
                //    let fac_id = $("#fac_id").val;
                //    let doors = $("#doors").val;
                //    let genre_id = $("#genre_id").val;

                let repw = 0;
                let newpw = 0;
                let user_id = 1;
                if (newpw != repw) {
                    alert("新パスワードの入力が再入力パスワードと一致しません");
                } else {
                    $.ajax({
                        url: "save2.php",
                        cache: false,
                        type: "POST",
                        data: {
                            user_id: user_id
                        }
                    }).success(function () {
                        // 通信成功時の処理
                        //            $("#message>p").fadeIn(300, function () {
                        //                $("#message>p").delay(1500).fadeOut("500");
                        //            });
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