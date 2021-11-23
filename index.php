<?php

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CAT COUNTER</title>

  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <div id="wrapper">
    <h1>CAT COUNTER</h1>

    <form action="result.php" method="post">

      <h2>猫の毛色を選択</h2>
      <div id="color_select">
        <label><input type="radio" id="kiji" value="kiji" name="cat_color">キジトラ</label>
        <label><input type="radio" id="saba" value="saba" name="cat_color">サバトラ</label>
        <label><input type="radio" id="chatora" value="chatora" name="cat_color">茶トラ</label>
        <label><input type="radio" id="siro" value="siro" name="cat_color">白</label>
        <label><input type="radio" id="kuro" value="kuro" name="cat_color">黒</label>
        <label><input type="radio" id="gray" value="gray" name="cat_color">灰色</label>
        <label><input type="radio" id="sirokuro" value="sirokuro" name="cat_color">白黒</label>
        <label><input type="radio" id="kijisiro" value="kijisiro" name="cat_color">キジ白</label>
        <label><input type="radio" id="chasiro" value="chasiro" name="cat_color">茶白</label>
        <label><input type="radio" id="mike" value="mike" name="cat_color">三毛</label>
        <label><input type="radio" id="sabi" value="sabi" name="cat_color">サビ</label>
        <label><input type="radio" id="other" value="other" name="cat_color">その他</label>
      </div>

      <h2>出現場所</h2>
      <select name="place" id="plece_select">
        <option disabled selected value>場所を選択</option>
        <option value="east">東区</option>
        <option value="center">中央区</option>
        <option value="hakata">博多区</option>
        <option value="west">西区</option>
        <option value="south">南区</option>
        <option value="sawara">早良区</option>
        <option value="jyou">城南区</option>
      </select>
      
      <button id="send_btn">登録</button>
    </form>

  </div>
  <!--wrapperここまで -->

  <!-- jquery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script></script>
</body>

</html>