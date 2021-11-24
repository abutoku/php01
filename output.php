<?php
// データまとめ用の空配列
$result = array();

// ファイルを開く（読み取り専用）
//rは、読み込みのみで開く
$file = fopen('data/cat.csv', 'r');

// ファイルをロック
flock($file, LOCK_EX);

// fgets()で1行ずつ取得→$lineに格納
if ($file) {
  while ($line = fgetcsv($file)) {
    // 取得したデータを配列`$result`に追加する
    array_push($result, $line);
  }
}
// var_dump($result);
// exit();

// ロックを解除する
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);
// `$result`に全てのデータがまとまる
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
    <div id="canvas_area">
      <div id="canvas_1" style="width:70%;height:400">
        <canvas id="cat_chart_1"></canvas>
      </div>
      <div id="canvas_2" style="width:30%;height:150">
        <canvas id="cat_chart_2"></canvas>
      </div>
    </div>
    <!-- 目撃場所選択部分 -->
    <section id="place_section">
      <h2 id="top_h2">出現場所</h2>
      <select name="place" id="place_select">
        <option disabled selected value>場所を選択</option>
        <option value="east">東区</option>
        <option value="center">中央区</option>
        <option value="hakata">博多区</option>
        <option value="west">西区</option>
        <option value="south">南区</option>
        <option value="sawara">早良区</option>
        <option value="jyou">城南区</option>
      </select>
      <button id="update">更新</button>
    </section>
    <div id="canvas_3" style="width:50%;height:150">
      <canvas id="cat_chart_3"></canvas>
    </div>
  </div>
  <!-- jquery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Chart.js読み込み -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>



  <script type="module">
    'use strict';

    const catArray = []; //猫情報配列を定義
    const inputArray = <?= json_encode($result) ?>; //PHPの$resultをjson_encodeで取得

    inputArray.forEach((x) => { //繰り返し処理でオブジェクト作成
      catArray.push({
        color: x[0],
        place: x[1],
      });
    });
    //毛色と場所で分けた猫情報オブジェクトが完成！
    console.log(catArray);

    let colors = {
      kiji: 0,
      saba: 0,
      chatora: 0,
      siro: 0,
      kuro: 0,
      gray: 0,
      sirokuro: 0,
      kijisiro: 0,
      chasiro: 0,
      mike: 0,
      sabi: 0,
      other: 0,
    }

    let places = {
      east: 0,
      center: 0,
      hakata: 0,
      west: 0,
      south: 0,
      sawara: 0,
      jyou: 0,
    }

    for (let i = 0; i < catArray.length; i++) {
      switch (catArray[i].color) {
        case 'kiji':
          colors.kiji++;
          break;
        case 'saba':
          colors.saba++;
          break;
        case 'chatora':
          colors.chatora++;
          break;
        case 'siro':
          colors.siro++;
          break;
        case 'kuro':
          colors.kuro++;
          break;
        case 'gray':
          colors.gray++;
          break;
        case 'sirokuro':
          colors.sirokuro++;
          break;
        case 'kijisiro':
          colors.kijisiro++;
          break;
        case 'chasiro':
          colors.chasiro++;
          break;
        case 'mike':
          colors.mike++;
          break;
        case 'sabi':
          colors.sabi++;
          break;
        case 'other':
          colors.other++;
          break;
      }
    }

    for (let i = 0; i < catArray.length; i++) {
      switch (catArray[i].place) {
        case 'east':
          places.east++;
          break;
        case 'center':
          places.center++;
          break;
        case 'hakata':
          places.hakata++;
          break;
        case 'west':
          places.west++;
          break;
        case 'south':
          places.south++;
          break;
        case 'sawara':
          places.sawara++;
          break;
        case 'jyou':
          places.jyou++;
          break;
      }
    };

    const eastArray = [];
    const centerArray = [];
    const hakataArray = [];
    const westArray = [];
    const southArray = [];
    const sawaraArray = [];
    const jyouArray = [];

    catArray.forEach((x) => {
      switch (x.place) {
        case 'east':
          eastArray.push(x);
          break;
        case 'center':
          centerArray.push(x);
          break;
        case 'hakata':
          hakataArray.push(x);
          break;
        case 'west':
          westArray.push(x);
          break;
        case 'south':
          southArray.push(x);
          break;
        case 'sawara':
          sawaraArray.push(x);
          break;
        case 'jyou':
          jyouArray.push(x);
          break;
      }
    })

    var type_1 = 'bar';
    var type_2 = 'pie';

    var data_1 = {
      labels: [
        'キジトラ',
        'サバトラ',
        '茶トラ',
        '白',
        '黒',
        'グレー',
        '白黒',
        'キジ白',
        '茶白',
        '三毛',
        'サビ',
        'その他',
      ], //labelsここまで
      datasets: [{
        data: [
          colors.kiji,
          colors.saba,
          colors.chatora,
          colors.siro,
          colors.kuro,
          colors.gray,
          colors.sirokuro,
          colors.kijisiro,
          colors.chasiro,
          colors.mike,
          colors.sabi,
          colors.other,
        ],
        backgroundColor: [
          '#DE6641',
          '#E8AC51',
          '#F2E55C',
          '#AAC863',
          '#39A869',
          '#27ACA9',
          '#00AEE0',
          '#4784BF',
          '#5D5099',
          '#A55B9A',
          '#DC669B',
          '#DD6673'
        ],
      }, ] //datasetsここまで
    }; //data_1ここまで

    var data_2 = {
      labels: [
        '東区',
        '中央区',
        '博多区',
        '西区',
        '南区',
        '早良区',
        '城南区',
      ], //labelsここまで
      datasets: [{
          data: [
            places.east,
            places.center,
            places.hakata,
            places.west,
            places.south,
            places.sawara,
            places.jyou,
          ],
          backgroundColor: [
            '#FF0000',
            '#FFA500',
            '#FFFF00	',
            '#008000',
            '#00FFFF',
            '#0000FF',
            '#800080',
          ],
        },

      ]

    };

    var options_1 = {
      scales: {
        y: {
          suggestedMin: 0, //最小値を調節
          suggestedMax: 30, //最大値を調節
          stepSize: 10, //メモリの幅
        }
      },
      plugins: {
        legend: false,
        title: {
          display: true,
          position: 'top',
          text: '猫の毛色',
          font: {
            size: 24
          }
        }, //titleここまで
      }, //pluginsここまで
    };

    var options_2 = {
      plugins: {
        legend: {
          display: true,
          position: 'bottom',
        },
        title: {
          display: true,
          position: 'top',
          text: '福岡市の猫',
          font: {
            size: 24
          },
        } //titleここまで
      }, //pluginsここまで
    };



    //canvas を描画するための、 ctx を取得
    var ctx_1 = document.getElementById('cat_chart_1').getContext('2d');
    var ctx_2 = document.getElementById('cat_chart_2').getContext('2d');


    //上記をmyChartに渡す
    var myChart = new Chart(ctx_1, {
      type: type_1,
      data: data_1,
      options: options_1,
    });

    var myChart = new Chart(ctx_2, {
      type: type_2,
      data: data_2,
      options: options_2,
    });


    $('#place_select').change(function() {

      let select_place = [];
      let text = '';

      let select = $('#place_select').val();

      switch (select) {
        case 'east':
          select_place = eastArray;
          text = '東区';
          break;
        case 'center':
          select_place = centerArray;
          text = '中央区';
          break;
        case 'hakata':
          select_place = hakataArray;
          text = '博多区';
          break;
        case 'west':
          select_place = westArray;
          text = '西区';
          break;
        case 'south':
          select_place = southArray;
          text = '南区';
          break;
        case 'sawara':
          select_place = sawaraArray;
          text = '早良区';
          break;
        case 'jyou':
          select_place = jyouArray;
          text = '城南区';
          break;
      }

      console.log(select_place);

      let colors_2 = {
        kiji: 0,
        saba: 0,
        chatora: 0,
        siro: 0,
        kuro: 0,
        gray: 0,
        sirokuro: 0,
        kijisiro: 0,
        chasiro: 0,
        mike: 0,
        sabi: 0,
        other: 0,
      }

      for (let i = 0; i < select_place.length; i++) {
        switch (select_place[i].color) {
          case 'kiji':
            colors_2.kiji++;
            break;
          case 'saba':
            colors_2.saba++;
            break;
          case 'chatora':
            colors_2.chatora++;
            break;
          case 'siro':
            colors_2.siro++;
            break;
          case 'kuro':
            colors_2.kuro++;
            break;
          case 'gray':
            colors_2.gray++;
            break;
          case 'sirokuro':
            colors_2.sirokuro++;
            break;
          case 'kijisiro':
            colors_2.kijisiro++;
            break;
          case 'chasiro':
            colors_2.chasiro++;
            break;
          case 'mike':
            colors_2.mike++;
            break;
          case 'sabi':
            colors_2.sabi++;
            break;
          case 'other':
            colors_2.other++;
            break;
        }
      }

      console.log(colors_2);

      var type_3 = 'doughnut';
      var data_3 = {
        labels: [
          'キジトラ',
          'サバトラ',
          '茶トラ',
          '白',
          '黒',
          'グレー',
          '白黒',
          'キジ白',
          '茶白',
          '三毛',
          'サビ',
          'その他',
        ], //labelsここまで
        datasets: [{
          data: [
            colors_2.kiji,
            colors_2.saba,
            colors_2.chatora,
            colors_2.siro,
            colors_2.kuro,
            colors_2.gray,
            colors_2.sirokuro,
            colors_2.kijisiro,
            colors_2.chasiro,
            colors_2.mike,
            colors_2.sabi,
            colors_2.other,
          ],
          backgroundColor: [
            '#DE6641',
            '#E8AC51',
            '#F2E55C',
            '#AAC863',
            '#39A869',
            '#27ACA9',
            '#00AEE0',
            '#4784BF',
            '#5D5099',
            '#A55B9A',
            '#DC669B',
            '#DD6673'
          ],
        }, ] //datasetsここまで
      };

      var options_3 = {
        plugins: {
          legend: {
            display: true,
            position: 'right',
          },
          title: {
            display: true,
            position: 'top',
            text: `${text}`,
            font: {
              size: 32
            }
          }, //titleここまで
        }, //pluginsここまで
      };


      if (myChart) {
        myChart.destroy();
      }

      var ctx_3 = document.getElementById('cat_chart_3').getContext('2d');
      var myChart = new Chart(ctx_3, {
        type: type_3,
        data: data_3,
        options: options_3,
      });


    }); //changeイベントここまで
  </script>


</body>

</html>