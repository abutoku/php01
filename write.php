<?php

//var_dump($_POST);
//exit();

// データの受け取り
$color = $_POST["cat_color"];
$place = $_POST["place"];

// var_dump($color);
//var_dump($place);
//exit();

// データ1件を1行にまとめる（最後に改行を入れる）
$write_data = "{$color},{$place}\n";

//var_dump($write_data);
//exit();

// ファイルを開く．引数が`a`である部分に注目！
//aは、追加書き込みのみで開く → ファイルがなければ作成
//macはディレクトリに対して読み書きできるように設定が必要!!!

$file = fopen('data/cat.csv', 'a');

// ファイルをロックする
flock($file, LOCK_EX);

// 指定したファイルに指定したデータを書き込む
fwrite($file, $write_data);

// ファイルのロックを解除する
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);

// データ入力画面に移動する
header("Location:index.php");

