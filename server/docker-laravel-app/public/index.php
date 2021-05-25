<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
|
*/

// $app = require __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

// $app->run();

// root /var/www/docker-laravel-app/public;
// root /var/www/okc-app/public;

// データーベース接続繰り返し使い回し
function serverConect(){
  // $dsn = 'mysql:host=localhost;dbname=keizibann;charset=UTF8';
  // $user = 'blog_user';
  // $pass = '10103129';
  // $dsn = 'mysql:host=localhost;dbname=co_19_246_99sv_coco_com;charaset=UTF8';
  // $user = 'co-19-246.99sv-c';
  // $pass = 'uP8Xs9rx';
  // $dsn = 'mysql:host=db;dbname=test_database;charaset=UTF8';
  // $user = 'docker';
  // $pass = 'docker';
  $dsn = 'mysql:host=db;dbname=test_database;charaset=UTF8';
  $user = 'root';
  $pass = 'root';
  try {
    $dbh = new PDO($dsn,$user,$pass,[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//エラーを出力するPDOException
      ]);
      // echo "接続成功";
      
    } catch (PDOException $e) {
      echo '接続失敗' . $e->getMessage();
      exit;
    }
    return $dbh;
  }

  // 全部表示/////////////////////
// データーベースに保存されている投稿を配列で所得、返り値は、配列。
function getAllBlog() {
  $dbh = serverConect();
  //SQL準備
  $sql = 'SELECT * FROM posts';
  //SQLの実行
  $stmt = $dbh->query($sql);
  //SQL結果受け取り
  $result = $stmt->fetchall(PDO::FETCH_ASSOC);
  // var_dump($result);
  return $result;
  $dbh = null;
  // var_dump($dbh);
}
$blogdata = getAllBlog();

//データーの更新
$update = <<< _UPDATE_
  SET @i := 0;
  UPDATE posts SET id = (@i := @i+1);
_UPDATE_;

$dbh = serverConect();
//番号の歯抜け処理
$dbh->query($update);

foreach ($blogdata as $data) {
  echo $data["id"] ."\n";
  echo $data["name"] ."\n";
  echo $data["contents"] ."\n";
  echo $data["pas_wd"] ."\n";
  echo $data["created_at"] ."}\n";
}

echo (count($blogdata));


// var_dump($blogdata);

?>

<html>
  <head>
    <meta charset="UTF-8" />
    <title>Hello World</title>
    <script src="https://unpkg.com/react@17/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>

    <!-- Don't use this in production: -->
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  </head>
  <body>
    <div id="root"></div>
    <div id="kd"></div>
    <script type="text/babel">

      ReactDOM.render(
        <h1>Hello, world!</h1>,
        document.getElementById('root')
      );
      ReactDOM.render(
        <h1>OKC</h1>,
        document.getElementById('kd')
      );

    </script>
    <!--
      Note: this page is a great way to try React but it's not suitable for production.
      It slowly compiles JSX with Babel in the browser and uses a large development build of React.

      Read this section for a production-ready setup with JSX:
      https://reactjs.org/docs/add-react-to-a-website.html#add-jsx-to-a-project

      In a larger project, you can use an integrated toolchain that includes JSX instead:
      https://reactjs.org/docs/create-a-new-react-app.html

      You can also use React without JSX, in which case you can remove Babel:
      https://reactjs.org/docs/react-without-jsx.html
    -->
  </body>
</html>