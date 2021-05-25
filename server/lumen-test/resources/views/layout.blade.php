<?php
 //データーの更新
// データーベース接続繰り返し使い回し
function serverConect(){
  $dsn = 'mysql:host=db;dbname=test_database;charaset=UTF8';
  $user = 'root';
  $pass = 'root';
  try {
    $dbh = new PDO($dsn,$user,$pass,[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//エラーを出力するPDOException
      ]);
      
    } catch (PDOException $e) {
      echo '接続失敗' . $e->getMessage();
      exit;
    }
    return $dbh;
  }
$update = <<< _UPDATE_
SET @i := 0;
UPDATE posts SET id = (@i := @i+1);
_UPDATE_;

$dbh = serverConect();
//番号の歯抜け処理
$dbh->query($update);


?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ブログ</title>

    <script src="https://unpkg.com/react@17/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script> 
    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- Don't use this in production: -->
    <style>
      .div_item {
        background: red;
        display: inline-block;
        width: 30%;
        margin: 10px;
      }
      .formLavel {
        display: block;
      }
    </style>
</head>
<body >

    @yield('content')

  <div id="root"></div>
  <div id="okc"></div>
 
</body>
</html>