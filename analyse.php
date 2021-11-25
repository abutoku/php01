<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>CAT ANALYSE</title>

  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <div id="wrapper">

    <div class="link">
      <h1>CAT ANALYSE</h1>
      <a href="index.php">CAT COUNTER</a>
    </div>

    <h2 id="analyse_link"><a href="output2.php">グラフを表示</a></h2>
    <form action="write2.php" method="post">
      <!-- 毛色選択部分 -->
      <section id="select_section">
        <select name="color" id="col_select">
          <option disabled selected value>毛色をを選択</option>
          <option value="kiji">キジトラ</option>
          <option value="kuro">黒</option>
          <option value="siro">白</option>
          <option value="chat">茶トラ</option>
          <option value="mike">三毛</option>
          <option value="sabi">サビ</option>
        </select>
      </section>

      <!-- 性格選択部分 -->
      <section id="character_section">

        <p>数字が大きいほど当てはまる</p>

        <table id="chara_table">
          <thead>
            <th></th>
            <td id="number_text">
              <span>1</span>
              <span>2</span>
              <span>3</span>
              <span>4</span>
              <span>5</span>
            </td>
          </thead>
          <tbody>
            <tr>
              <th>賢い</th>
              <td><input name="chara_1" type="range" min="1" max="5" step="1"></td>
            </tr>
            <tr>
              <th>大人しい</th>
              <td><input name="chara_2" type="range" min="1" max="5" step="1"></td>
            </tr>
            <tr>
              <th>攻撃的</th>
              <td><input name="chara_3" type="range" min="1" max="5" step="1"></td>
            </tr>
            <tr>
              <th>臆病</th>
              <td><input name="chara_4" type="range" min="1" max="5" step="1"></td>
            </tr>
            <tr>
              <th>人懐こい</th>
              <td><input name="chara_5" type="range" min="1" max="5" step="1"></td>
            </tr>
          </tbody>
        </table>

      </section>

      <!-- 登録ボタン部分 -->
      <section id="btn_section_2">
        <button id="send_btn_2">登録</button>
      </section>


    </form>

  </div>

  <!-- jquery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



  <script>
    $('#character_section').hide();
    $('#btn_section_2').hide();

    //毛色が選択されたら
    $('#select_section').change(function() {
      $('#character_section').show(); //場所選択を出す
    });

    //レンジが選択されたら
    $('#character_section').change(function() {
      $('#btn_section_2').show(); //登録ボタンを出す
    });
  </script>

</body>

</html>