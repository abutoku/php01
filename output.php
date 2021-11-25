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

    <div id="canvas_3" style="width:80%;height:200">
      <canvas id="cat_chart_3"></canvas>
    </div>

  <a class="top_btn" href="index.php">TOP</a>

  </div>


  <!-- jquery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Chart.js読み込み -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>

  <script>
    'use strict';

    const catArray = []; //猫情報配列を定義
    const inputArray = <?= json_encode($result) ?>; //PHPの$resultをjson_encodeで取得

    inputArray.forEach((x) => { //繰り返し処理でオブジェクト作成
      catArray.push({ //catArrayに追加
        color: x[0], //キーcolor
        place: x[1], //キーplace
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

    for (let i = 0; i < catArray.length; i++) { //猫の数をカウント
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

    for (let i = 0; i < catArray.length; i++) { //猫の場所をカウント
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

    const east = {
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
    };

    const center = {
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
    };

    const hakata = {
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
    };

    const west = {
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
    };

    const south = {
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
    };

    const sawara = {
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
    };

    const jyou = {
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
    };

    catArray.forEach((x) => { //場所別の猫を数をカウント
      switch (x.place) {
        case 'east':
          switch (x.color) {
            case 'kiji':
              east.kiji++;
              break;
            case 'saba':
              east.saba++;
              break;
            case 'chatora':
              east.chatora++;
              break;
            case 'siro':
              east.siro++;
              break;
            case 'kuro':
              east.kuro++;
              break;
            case 'gray':
              east.gray++;
              break;
            case 'sirokuro':
              east.sirokuro++;
              break;
            case 'kijisiro':
              east.kijisiro++;
              break;
            case 'chasiro':
              east.chasiro++;
              break;
            case 'mike':
              east.mike++;
              break;
            case 'sabi':
              east.sabi++;
              break;
            case 'other':
              east.other++;
              break;
          }
          break; //case 'east'ここまで

        case 'center':
          switch (x.color) {
            case 'kiji':
              center.kiji++;
              break;
            case 'saba':
              center.saba++;
              break;
            case 'chatora':
              center.chatora++;
              break;
            case 'siro':
              center.siro++;
              break;
            case 'kuro':
              center.kuro++;
              break;
            case 'gray':
              center.gray++;
              break;
            case 'sirokuro':
              center.sirokuro++;
              break;
            case 'kijisiro':
              center.kijisiro++;
              break;
            case 'chasiro':
              center.chasiro++;
              break;
            case 'mike':
              center.mike++;
              break;
            case 'sabi':
              center.sabi++;
              break;
            case 'other':
              center.other++;
              break;
          }
          break; //case 'center'ここまで

        case 'hakata':
          switch (x.color) {
            case 'kiji':
              hakata.kiji++;
              break;
            case 'saba':
              hakata.saba++;
              break;
            case 'chatora':
              hakata.chatora++;
              break;
            case 'siro':
              hakata.siro++;
              break;
            case 'kuro':
              hakata.kuro++;
              break;
            case 'gray':
              hakata.gray++;
              break;
            case 'sirokuro':
              hakata.sirokuro++;
              break;
            case 'kijisiro':
              hakata.kijisiro++;
              break;
            case 'chasiro':
              hakata.chasiro++;
              break;
            case 'mike':
              hakata.mike++;
              break;
            case 'sabi':
              hakata.sabi++;
              break;
            case 'other':
              hakata.other++;
              break;
          }
          break; //case 'hakata'ここまで

        case 'west':
          switch (x.color) {
            case 'kiji':
              west.kiji++;
              break;
            case 'saba':
              west.saba++;
              break;
            case 'chatora':
              west.chatora++;
              break;
            case 'siro':
              west.siro++;
              break;
            case 'kuro':
              west.kuro++;
              break;
            case 'gray':
              west.gray++;
              break;
            case 'sirokuro':
              west.sirokuro++;
              break;
            case 'kijisiro':
              west.kijisiro++;
              break;
            case 'chasiro':
              west.chasiro++;
              break;
            case 'mike':
              west.mike++;
              break;
            case 'sabi':
              west.sabi++;
              break;
            case 'other':
              west.other++;
              break;
          }
          break; //case 'west'ここまで

        case 'south':
          switch (x.color) {
            case 'kiji':
              south.kiji++;
              break;
            case 'saba':
              south.saba++;
              break;
            case 'chatora':
              south.chatora++;
              break;
            case 'siro':
              south.siro++;
              break;
            case 'kuro':
              south.kuro++;
              break;
            case 'gray':
              south.gray++;
              break;
            case 'sirokuro':
              south.sirokuro++;
              break;
            case 'kijisiro':
              south.kijisiro++;
              break;
            case 'chasiro':
              south.chasiro++;
              break;
            case 'mike':
              south.mike++;
              break;
            case 'sabi':
              south.sabi++;
              break;
            case 'other':
              south.other++;
              break;
          }
          break; //case 'south'ここまで

        case 'sawara':
          switch (x.color) {
            case 'kiji':
              sawara.kiji++;
              break;
            case 'saba':
              sawara.saba++;
              break;
            case 'chatora':
              sawara.chatora++;
              break;
            case 'siro':
              sawara.siro++;
              break;
            case 'kuro':
              sawara.kuro++;
              break;
            case 'gray':
              sawara.gray++;
              break;
            case 'sirokuro':
              sawara.sirokuro++;
              break;
            case 'kijisiro':
              sawara.kijisiro++;
              break;
            case 'chasiro':
              sawara.chasiro++;
              break;
            case 'mike':
              sawara.mike++;
              break;
            case 'sabi':
              sawara.sabi++;
              break;
            case 'other':
              sawara.other++;
              break;
          }
          break; //case 'sawara'ここまで

        case 'jyou':
          switch (x.color) {
            case 'kiji':
              jyou.kiji++;
              break;
            case 'saba':
              jyou.saba++;
              break;
            case 'chatora':
              jyou.chatora++;
              break;
            case 'siro':
              jyou.siro++;
              break;
            case 'kuro':
              jyou.kuro++;
              break;
            case 'gray':
              jyou.gray++;
              break;
            case 'sirokuro':
              jyou.sirokuro++;
              break;
            case 'kijisiro':
              jyou.kijisiro++;
              break;
            case 'chasiro':
              jyou.chasiro++;
              break;
            case 'mike':
              jyou.mike++;
              break;
            case 'sabi':
              jyou.sabi++;
              break;
            case 'other':
              jyou.other++;
              break;
          }
          break; //case 'jyou'ここまで
      }
    });

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



    //canvas を描画するための変数
    var ctx_1 = document.getElementById('cat_chart_1').getContext('2d');
    //canvas2 を描画するための変数
    var ctx_2 = document.getElementById('cat_chart_2').getContext('2d');


    //上記をmyChartに渡す
    var myChart = new Chart(ctx_1, {
      type: type_1,
      data: data_1,
      options: options_1,
    });
    
    //上記をmyChartに渡す
    var myChart = new Chart(ctx_2, {
      type: type_2,
      data: data_2,
      options: options_2,
    });

    let select_place = [];
    let text = '';

    var type_3 = 'bar';

    var data_3 = {
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
          label: 'キジトラ',
          data: [
            east.kiji,
            center.kiji,
            hakata.kiji,
            west.kiji,
            south.kiji,
            sawara.kiji,
            jyou.kiji,
          ],
          backgroundColor: '#DE6641',
        },
        {
          label: 'サバトラ',
          data: [
            east.saba,
            center.saba,
            hakata.saba,
            west.saba,
            south.saba,
            sawara.saba,
            jyou.saba,
          ],
          backgroundColor: '#E8AC51',
        },
        {
          label: '茶トラ',
          data: [
            east.chatora,
            center.chatora,
            hakata.chatora,
            west.chatora,
            south.chatora,
            sawara.chatora,
            jyou.chatora,
          ],
          backgroundColor: '#F2E55C',
        },
        {
          label: '白',
          data: [
            east.siro,
            center.siro,
            hakata.siro,
            west.siro,
            south.siro,
            sawara.siro,
            jyou.siro,
          ],
          backgroundColor: '#AAC863',
        },
        {
          label: '黒',
          data: [
            east.kuro,
            center.kuro,
            hakata.kuro,
            west.kuro,
            south.kuro,
            sawara.kuro,
            jyou.kuro,
          ],
          backgroundColor: '#39A869',
        },
        {
          label: '灰色',
          data: [
            east.gray,
            center.gray,
            hakata.gray,
            west.gray,
            south.gray,
            sawara.gray,
            jyou.gray,
          ],
          backgroundColor: '#27ACA9',
        },
        {
          label: '白黒',
          data: [
            east.sirokuro,
            center.sirokuro,
            hakata.sirokuro,
            west.sirokuro,
            south.sirokuro,
            sawara.sirokuro,
            jyou.sirokuro,
          ],
          backgroundColor: '#00AEE0',
        },
        {
          label: 'キジ白',
          data: [
            east.kijisiro,
            center.kijisiro,
            hakata.kijisiro,
            west.kijisiro,
            south.kijisiro,
            sawara.kijisiro,
            jyou.kijisiro,
          ],
          backgroundColor: '#4784BF',
        },
        {
          label: '茶白',
          data: [
            east.chasiro,
            center.chasiro,
            hakata.chasiro,
            west.chasiro,
            south.chasiro,
            sawara.chasiro,
            jyou.chasiro,
          ],
          backgroundColor: '#5D5099',
        },
        {
          label: '三毛',
          data: [
            east.mike,
            center.mike,
            hakata.mike,
            west.mike,
            south.mike,
            sawara.mike,
            jyou.mike,
          ],
          backgroundColor: '#A55B9A',
        },
        {
          label: 'サビ',
          data: [
            east.sabi,
            center.sabi,
            hakata.sabi,
            west.sabi,
            south.sabi,
            sawara.sabi,
            jyou.sabi,
          ],
          backgroundColor: '#DC669B',
        },
        {
          label: 'その他',
          data: [
            east.other,
            center.other,
            hakata.other,
            west.other,
            south.other,
            sawara.other,
            jyou.other,
          ],
          backgroundColor: '#DD6673',
        },
      ] //datasetsここまで

    }; //data_3ここまで

    var options_3 = {
      scales: {
        x: {
          stacked: true
        },
        y: {
          stacked: true,
          suggestedMin: 0, //最小値を調節
          suggestedMax: 30, //最大値を調節
          stepSize: 10, //メモリの幅
        },
      },
      plugins: {
        legend: {
          display: true,
          position: 'right',
        },
        title: {
          display: true,
          position: 'top',
          text: '猫たちの分布',
          font: {
            size: 32
          }
        }, //titleここまで
      }, //pluginsここまで

    }; //options_3ここまで

    var ctx_3 = document.getElementById('cat_chart_3').getContext('2d');

    var myChart_3 = new Chart(ctx_3, {
      type: type_3,
      data: data_3,
      options: options_3,
    });
  </script>

</body>

</html>