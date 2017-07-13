<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>データ登録</title>
<!--  <link href="css/bootstrap.min.css" rel="stylesheet">-->
  <style>
  html,body{
    height:100%;
    display: block;
  }

  body{
     font-family: 'Comfortaa', cursive;
  }

  h1 {
    text-align: center;
    letter-spacing: 2px;
    font-weight: 700;
    font-size:30px;
    margin-bottom:0px;
  }

  h2{
    text-align: center;
    font-size:15px;
    font-weight: 400;
    margin-top:5px;
  }

  .form-section{
    width: 100%;
    margin: 40px auto 0px auto;
  }

  .check-card {
      list-style: none;
      margin: 40px auto;
      width: 100%;
  }
  .check-card .check-card-item {
      position: relative;
      width: 100%;
      float: left;
      margin: 0 1% 5px;
      font-size: 16px;
      background: #b3b3b3;
      overflow: hidden;
      border-radius: 20px
  }
  .check-card li label {
      display: block;
      position: absolute;
      height: 100px;
      width: 100%;
      z-index: 100;
      cursor: pointer;
  }
  .check-card .check-card-body {
      /*height: 100px;*/
      color: #fff;
      z-index: 2;
      position: relative;
  }
  .check-card .check-card-body-in {
      padding: 0px 50px 0px;

  }
  .check-card .check-card-title {
      color: #000;
      font-size: 20px;
      margin: 0;
  }
  .check-card .check-card-bg,
  .check-card .check-card-toggle {
      position: relative;
      background: #fff;
      width: 24px;
      height: 24px;
      top: 10px;
      left: 10px;
      -webkit-border-radius: 50%;
      border-radius: 50%;
  }
  .check-card .check-card-bg {
      position: absolute;
      background: #3c9895;
      -webkit-transition: all .3s ease-out;
      transition: all .3s ease-out;
      -webkit-transform:scale(1);
      transform:scale(1);
      z-index: 0;
  }
  .check-card .check-card-toggle span {
      position: absolute;
      display: block;
      width: 20px;
      margin-left: -10px;
      height: 1px;
      top: 50%;
      left: 50%;
      background: #000;
      -webkit-transition: all .4s ease-out;
      transition: all .4s ease-out;
      -webkit-transform: rotate(-270deg);
      transform: rotate(-270deg);
  }
  .check-card .check-card-toggle span:first-child {
      -webkit-transform: rotate(180deg);
      transform: rotate(180deg);
  }
  .check-card .check-card-cancel {
      font-size: 18px;
      border-top: solid 1px #fff;
      border-bottom: solid 1px #fff;
      /*padding: 10px 0 7px;*/
      text-align: center;
      position: absolute;
      bottom: -50px;
      left: 50%;
      margin: 0 7%;
      width: 100px;
      -webkit-transition: all .3s cubic-bezier(0.5, -0.8, 0.5, 1.8);
      transition: all .3s cubic-bezier(0.5, -0.8, 0.5, 1.8);
  }
  .check-card input[type=checkbox] {
      display: none;
  }
  .check-card input[type=checkbox]:checked ~ .check-card-body .check-card-toggle span {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
  }
  .check-card input[type=checkbox]:checked ~ .check-card-body .check-card-toggle span:first-child {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
  }
  .check-card input[type=checkbox]:checked ~ .check-card-bg {
      -webkit-transform:scale(25);
      transform:scale(25);
  }
  .check-card input[type=checkbox]:checked ~ .check-card-body .check-card-cancel {
      bottom: 10px;
  }
  ul{
    padding:0;
  }
</style>
</head>
<body>

<!-- Head[Start] -->
<header>


</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<section>
  <h1>お悩み選択</h1>
  <h2>あなたの悩みを入力してください</h2>

  <div class="form-section">
    <form class="form-target">
      <ul class="check-card">
          <li class="check-card-item">
              <input type="checkbox" id="check01" name="check" value="1">
              <label for="check01" class="radio"></label>
              <div class="check-card-bg"></div>
              <div class="check-card-body">
                  <div class="check-card-toggle">
                      <span></span>
                      <span></span>
                  </div>
                  <div class="check-card-body-in">
                      <h3 class="check-card-title">運動不足</h3>
                  </div>
                  <div class="check-card-cancel">CANCEL</div>
              </div>
          </li>
          <li class="check-card-item">
              <input type="checkbox" id="check02" name="check" value="1">
              <label for="check02" class="radio"></label>
              <div class="check-card-bg"></div>
              <div class="check-card-body">
                  <div class="check-card-toggle">
                      <span></span>
                      <span></span>
                  </div>
                  <div class="check-card-body-in">
                      <h3 class="check-card-title">友達が欲しい</h3>
                  </div>
                  <div class="check-card-cancel">CANCEL</div>
              </div>
          </li>
          <li class="check-card-item">
              <input type="checkbox" id="check03" name="check" value="1">
              <label for="check03" class="radio"></label>
              <div class="check-card-bg"></div>
              <div class="check-card-body">
                  <div class="check-card-toggle">
                      <span></span>
                      <span></span>
                  </div>
                  <div class="check-card-body-in">
                      <h3 class="check-card-title">学びたい</h3>
                  </div>
                  <div class="check-card-cancel">CANCEL</div>
              </div>
          </li>
      </ul>
    </form>
 </div>
</section>


    <!-- <legend>お悩み選択</legend>
    <form method="post" action="needs_insert.php">
<p>

    <input id="hoge1" class="check_box" type="checkbox" name="training" value="1" />
    <label class="label" for="hoge1">　　</label>運動不足
    <br><br>
    <input id="hoge2" class="check_box" type="checkbox" name="training" value="1" />
    <label class="label" for="hoge2">　　</label>友達が欲しい
    <br><br>
    <input id="hoge3" class="check_box" type="checkbox" name="training" value="1" />
    <label class="label" for="hoge3">　　</label>学びたい
</p>
<input type="submit" value="送信">
</form> -->
<!-- Main[End] -->


</body>
</html>
