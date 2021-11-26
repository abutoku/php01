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

    <div id="main_2">
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

      <!-- three.js表示場所 -->
      <div id="stage"></div>

    </div>
    <!--mainここまで-->
  </div>
  <!--wrapperここまで -->

  <!-- three.js読み込み -->
  <script src="js/three.min.js"></script>

  <!-- OrbitControls.js読み込み -->
  <script src="js/OrbitControls.js"></script>

  <!-- jquery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



  <script>
    'use strict'

    //最初の画面設定
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

    // ここからthree.jsの記述

    var scene;
    var gridHelper; //helper
    var axisHelper; //helper
    var lightHelper; //helper
    const width = 400;
    const height = 250;

    // scene
    scene = new THREE.Scene(); //3Dを表現する空間

    // mesh

    //奥行きと影があり、光沢感のないマテリアル({ color: 0xから始まる16進数カラー})
    const headMaterial = new THREE.MeshLambertMaterial({
      color: 0x726250
    })
    //3Dを2Dの手書き風にできるマテリアル({ color: 0xから始まる16進数カラー})
    const eyeMaterial = new THREE.MeshToonMaterial({
      color: 0x000000
    });

    //耳
    const ear_1 = new THREE.Mesh(
      new THREE.ConeGeometry(10, 30, 20),
      headMaterial
    );
    ear_1.position.set(20, 40, 10);

    //耳
    const ear_2 = new THREE.Mesh(
      new THREE.ConeGeometry(10, 30, 20),
      headMaterial
    );
    ear_2.position.set(-20, 40, 10);

    //頭
    const head = new THREE.Mesh(
      //球のジオメトリー（半径,緯度分割数,経度分割数）
      new THREE.SphereGeometry(40, 40, 20),
      headMaterial
    );
    head.position.set(0, 0, 0);

    //右目
    const right_eye = new THREE.Mesh(
      new THREE.SphereGeometry(5, 25, 40),
      eyeMaterial
    );
    right_eye.position.set(15, 18, 30);

    //左目
    const left_eye = new THREE.Mesh(
      new THREE.SphereGeometry(5, 10, 40),
      eyeMaterial
    );
    left_eye.position.set(-16, 18, 33);

    //鼻
    const nose = new THREE.Mesh(
      new THREE.SphereGeometry(5, 30, 20),
      new THREE.MeshLambertMaterial({
        color: 0x000000
      })
    );
    nose.position.set(3, 10, 35);

    //髭
    const hige_1 = new THREE.Mesh(
      new THREE.BoxGeometry(50, 3, 1),
      new THREE.MeshLambertMaterial({
        color: 0x000000
      })
    );

    //髭
    hige_1.position.set(10, 10, 35);

    const hige_2 = new THREE.Mesh(
      new THREE.BoxGeometry(50, 3, 1),
      new THREE.MeshLambertMaterial({
        color: 0x000000
      })
    );
    hige_2.position.set(10, 0, 35);

    //髭
    const hige_3 = new THREE.Mesh(
      new THREE.BoxGeometry(50, 3, 1),
      new THREE.MeshLambertMaterial({
        color: 0x000000
      })
    );
    hige_3.position.set(-10, 10, 35);

    //髭
    const hige_4 = new THREE.Mesh(
      new THREE.BoxGeometry(50, 3, 1),
      new THREE.MeshLambertMaterial({
        color: 0x000000
      })
    );
    hige_4.position.set(-10, 0, 35);

    //体
    const body = new THREE.Mesh(
      new THREE.SphereGeometry(50, 50, 50),
      headMaterial
    );
    body.position.set(0, -60, 0);


    const cat = new THREE.Group(); //メッシュをグループ化
    cat.add(ear_1, ear_2, head, right_eye, left_eye, nose, hige_1, hige_2, hige_3, hige_4, body);
    scene.add(cat); //3D空間にcatを配置


    // light
    //平行光源(ディレクショナルライト)：一方向から同じ強さで平行に照らすライト(色, 光の強さ)
    const light = new THREE.DirectionalLight(0xffffff, 0.9);
    light.position.set(0, 50, 30); //ライトの位置(x,y,z)
    scene.add(light); //シーンにディレクショナルライトを追加

    //環境光源(アンビエントライト)：すべてを均等に照らす、影のない、全体を明るくするライト
    const ambient = new THREE.AmbientLight(0xf8f8ff, 0.9);
    scene.add(ambient); //シーンにアンビエントライトを追加

    // camera
    //遠近感のあるカメラ(視野角,上映するスクリーンの縦横比,カメラから手前までの距離,カメラから奥までの距離)
    const camera = new THREE.PerspectiveCamera(90, width / height, 1, 1000);
    camera.position.set(60, 50, 140); //(x,y,z)
    camera.lookAt(scene.position); //カメラの視点（注視点）

    //helper

    //平面にグリッドを設置（大きさとグリッドの数）
    gridHelper = new THREE.GridHelper(400, 8);
    scene.add(gridHelper); //sceneに対してgridHelperを追加

    //x y z 軸を表示してくれるもの(軸のサイズ)
    axisHelper = new THREE.AxisHelper(1000);
    scene.add(axisHelper); //sceneに対してaxisHelperを追加

    //DirectionalLight に関するヘルパー(どのライトか,サイズ)
    lightHelper = new THREE.DirectionalLightHelper(light, 20);
    scene.add(lightHelper); //sceneに対してlightHelperを追加


    // renderer
    const renderer = new THREE.WebGLRenderer({
      antialias: true
    }); //メッシュの輪郭を滑らかに表示
    renderer.setSize(width, height); //幅と高さを設定
    renderer.setClearColor(0xe3e3e3); // 空間の背景色
    renderer.setPixelRatio(window.devicePixelRatio); //高解像度対応
    document.getElementById('stage').appendChild(renderer.domElement); //div要素にcanvasを追加

    function render() {
      requestAnimationFrame(render); //再度render関数を実行
      renderer.render(scene, camera); //シーン, カメラをもとに描画
      cat.rotation.y += 0.01; //反時計周りにcatを回転
    }
    render();

    //カメラをマウスで動かす
    var controls = new THREE.OrbitControls(camera, renderer.domElement);

  </script>

</body>

</html>