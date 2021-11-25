<?php

// var_dump($_POST);
// exit();

$color = $_POST["color"];
$chara_1 = $_POST["chara_1"];
$chara_2 = $_POST["chara_2"];
$chara_3 = $_POST["chara_3"];
$chara_4 = $_POST["chara_4"];
$chara_5 = $_POST["chara_5"];

// var_dump($color);
// var_dump($chara_1);
// var_dump($chara_2);
// var_dump($chara_3);
// var_dump($chara_4);
// var_dump($chara_5);
// exit();

$write_data = "{$color},{$chara_1},{$chara_2},{$chara_3},{$chara_4},{$chara_5}\n";

$file = fopen('data/cat02.csv', 'a');

// ファイルをロックする
flock($file, LOCK_EX);

// 指定したファイルに指定したデータを書き込む
fwrite($file, $write_data);

// ファイルのロックを解除する
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);

// データ入力画面に移動する
header("Location:analyse.php");