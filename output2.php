<?php

$result = array();

$file = fopen('data/cat02.csv', 'r');

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

  <title>CAT ANALYSE</title>

  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">

</head>

<body>
  <div id="wrapper">
    <div class="link">
      <h1 id="analyse_h1">CAT ANALYSE</h1>
      <a href="analyse.php">TOP</a>
    </div>

    <div id="canvas_area_02">

      <div id="area01">
        <div class="canvas" style="width:50%;height:200">
          <canvas id="chart01"></canvas>
        </div>
        <div class="canvas" style="width:50%;height:200">
          <canvas id="chart02"></canvas>
        </div>
      </div>


      <div id="area02">
        <div class="canvas" style="width:50%;height:200">
          <canvas id="chart03"></canvas>
        </div>
        <div class="canvas" style="width:50%;height:200">
          <canvas id="chart04"></canvas>
        </div>
      </div>

      <div id="area03">
        <div class="canvas" style="width:50%;height:200">
          <canvas id="chart05"></canvas>
        </div>
        <div class="canvas" style="width:50%;height:200">
          <canvas id="chart06"></canvas>
        </div>
      </div>

    </div>


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
        chara1: x[1], //キーplace
        chara2: x[2], //キーplace
        chara3: x[3], //キーplace
        chara4: x[4], //キーplace
        chara5: x[5], //キーplace
      });
    });

    console.log(catArray);

    const kijiArray = {
      cha1: 0,
      cha2: 0,
      cha3: 0,
      cha4: 0,
      cha5: 0,
    };

    const kuroArray = {
      cha1: 0,
      cha2: 0,
      cha3: 0,
      cha4: 0,
      cha5: 0,
    };

    const siroArray = {
      cha1: 0,
      cha2: 0,
      cha3: 0,
      cha4: 0,
      cha5: 0,
    };

    const chatArray = {
      cha1: 0,
      cha2: 0,
      cha3: 0,
      cha4: 0,
      cha5: 0,
    };

    const mikeArray = {
      cha1: 0,
      cha2: 0,
      cha3: 0,
      cha4: 0,
      cha5: 0,
    };

    const sabiArray = {
      cha1: 0,
      cha2: 0,
      cha3: 0,
      cha4: 0,
      cha5: 0,
    };

    catArray.forEach((x) => {
      switch (x.color) {
        case 'kiji':
          kijiArray.cha1 += Number(x.chara1);
          kijiArray.cha2 += Number(x.chara2);
          kijiArray.cha3 += Number(x.chara3);
          kijiArray.cha4 += Number(x.chara4);
          kijiArray.cha5 += Number(x.chara5);
          break;
        case 'kuro':
          kuroArray.cha1 += Number(x.chara1);
          kuroArray.cha2 += Number(x.chara2);
          kuroArray.cha3 += Number(x.chara3);
          kuroArray.cha4 += Number(x.chara4);
          kuroArray.cha5 += Number(x.chara5);
          break;
        case 'siro':
          siroArray.cha1 += Number(x.chara1);
          siroArray.cha2 += Number(x.chara2);
          siroArray.cha3 += Number(x.chara3);
          siroArray.cha4 += Number(x.chara4);
          siroArray.cha5 += Number(x.chara5);
          break;
        case 'chat':
          chatArray.cha1 += Number(x.chara1);
          chatArray.cha2 += Number(x.chara2);
          chatArray.cha3 += Number(x.chara3);
          chatArray.cha4 += Number(x.chara4);
          chatArray.cha5 += Number(x.chara5);
          break;
        case 'mike':
          mikeArray.cha1 += Number(x.chara1);
          mikeArray.cha2 += Number(x.chara2);
          mikeArray.cha3 += Number(x.chara3);
          mikeArray.cha4 += Number(x.chara4);
          mikeArray.cha5 += Number(x.chara5);
          break;
        case 'sabi':
          sabiArray.cha1 += Number(x.chara1);
          sabiArray.cha2 += Number(x.chara2);
          sabiArray.cha3 += Number(x.chara3);
          sabiArray.cha4 += Number(x.chara4);
          sabiArray.cha5 += Number(x.chara5);
          break;
      }
    });

    console.log(kijiArray.cha1);
    console.log(sabiArray);


    var type_1 = 'radar';
    var type_2 = 'radar';
    var type_3 = 'radar';
    var type_4 = 'radar';
    var type_5 = 'radar';
    var type_6 = 'radar';

    var data_1 = {
      labels: [
        '賢い',
        '大人しい',
        '攻撃的',
        '臆病',
        '人懐こい',
      ],
      datasets: [{
        data: [
          kijiArray.cha1,
          kijiArray.cha2,
          kijiArray.cha3,
          kijiArray.cha4,
          kijiArray.cha5,
        ],
        backgroundColor: [
          'rgba(0,0,128,0.4)',
        ],
      }]

    };

    var data_2 = {
      labels: [
        '賢い',
        '大人しい',
        '攻撃的',
        '臆病',
        '人懐こい',
      ],
      datasets: [{
        data: [
          kuroArray.cha1,
          kuroArray.cha2,
          kuroArray.cha3,
          kuroArray.cha4,
          kuroArray.cha5,
        ],
        backgroundColor: [
          'rgba(0,0,128,0.4)',
        ],
      }]

    };
    var data_3 = {
      labels: [
        '賢い',
        '大人しい',
        '攻撃的',
        '臆病',
        '人懐こい',
      ],
      datasets: [{
        data: [
          siroArray.cha1,
          siroArray.cha2,
          siroArray.cha3,
          siroArray.cha4,
          siroArray.cha5,
        ],
        backgroundColor: [
          'rgba(0,0,128,0.4)',
        ],
      }]

    };
    var data_4 = {
      labels: [
        '賢い',
        '大人しい',
        '攻撃的',
        '臆病',
        '人懐こい',
      ],
      datasets: [{
        data: [
          chatArray.cha1,
          chatArray.cha2,
          chatArray.cha3,
          chatArray.cha4,
          chatArray.cha5,
        ],
        backgroundColor: [
          'rgba(0,0,128,0.4)',
        ],
      }]

    };
    var data_5 = {
      labels: [
        '賢い',
        '大人しい',
        '攻撃的',
        '臆病',
        '人懐こい',
      ],
      datasets: [{
        data: [
          mikeArray.cha1,
          mikeArray.cha2,
          mikeArray.cha3,
          mikeArray.cha4,
          mikeArray.cha5,
        ],
        backgroundColor: [
          'rgba(0,0,128,0.4)',
        ],
      }]

    };

    var data_6 = {
      labels: [
        '賢い',
        '大人しい',
        '攻撃的',
        '臆病',
        '人懐こい',
      ],
      datasets: [{
        data: [
          sabiArray.cha1,
          sabiArray.cha2,
          sabiArray.cha3,
          sabiArray.cha4,
          sabiArray.cha5,
        ],
        backgroundColor: [
          'rgba(0,0,128,0.4)',
        ],
      }]
    };


    var options_1 = {
      plugins: {
        legend: {
          display: false,
          position: 'right',
        },
        title: {
          display: true,
          position: 'top',
          text: 'キジトラ',
          font: {
            size: 32
          }
        }, //titleここまで
      },

    };

    var options_2 = {
      plugins: {
        legend: {
          display: false,
          position: 'right',
        },
        title: {
          display: true,
          position: 'top',
          text: '黒',
          font: {
            size: 32
          }
        }, //titleここまで
      },
    };

    var options_3 = {
      plugins: {
        legend: {
          display: false,
          position: 'right',
        },
        title: {
          display: true,
          position: 'top',
          text: '白',
          font: {
            size: 32
          }
        }, //titleここまで
      },

    };
    var options_4 = {
      plugins: {
        legend: {
          display: false,
          position: 'right',
        },
        title: {
          display: true,
          position: 'top',
          text: '茶トラ',
          font: {
            size: 32
          }
        }, //titleここまで
      },

    };
    var options_5 = {
      plugins: {
        legend: {
          display: false,
          position: 'right',
        },
        title: {
          display: true,
          position: 'top',
          text: '三毛',
          font: {
            size: 32
          }
        }, //titleここまで
      },

    };
    var options_6 = {
      plugins: {
        legend: {
          display: false,
          position: 'right',
        },
        title: {
          display: true,
          position: 'top',
          text: 'サビ',
          font: {
            size: 32
          }
        }, //titleここまで
      },
    };


    var ctx_1 = document.getElementById('chart01').getContext('2d');
    var ctx_2 = document.getElementById('chart02').getContext('2d');
    var ctx_3 = document.getElementById('chart03').getContext('2d');
    var ctx_4 = document.getElementById('chart04').getContext('2d');
    var ctx_5 = document.getElementById('chart05').getContext('2d');
    var ctx_6 = document.getElementById('chart06').getContext('2d');

    var myChart_1 = new Chart(ctx_1, {
      type: type_1,
      data: data_1,
      options: options_1,
    });

    var myChart_2 = new Chart(ctx_2, {
      type: type_2,
      data: data_2,
      options: options_2,
    });

    var myChart_3 = new Chart(ctx_3, {
      type: type_3,
      data: data_3,
      options: options_3,
    });

    var myChart_4 = new Chart(ctx_4, {
      type: type_4,
      data: data_4,
      options: options_4,
    });

    var myChart_5 = new Chart(ctx_5, {
      type: type_5,
      data: data_5,
      options: options_5,
    });

    var myChart_6 = new Chart(ctx_6, {
      type: type_6,
      data: data_6,
      options: options_6,
    });
  </script>


</body>

</html>