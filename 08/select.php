<?php
//1.  DB接続します

try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root',''); //  rootの後ろはパスワード
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<ul>";
    $view .= "<li>".$res["id"]."</li>";
    $view .= "<li>".$res["book_title"]."</li>";
    $view .= "<li>".$res["book_writer"]."</li>";
    $view .= "<li><a href='".$res["book_url"]."'>URL</a></li>";
    $view .= "<li>".$res["book_comment"]."</li>";
    $view .= "<li>".$res["created_at"]."</li>";
    $view .= '<li>';
    $view .= '<a href="detail.php?id='.$res["id"].'">';
    $view .= "編集";
    $view .= "</a>";
    $view .= ' ';
    $view .= '<a href="delete.php?id='.$res["id"].'">';
    $view .= "削除";
    $view .= "</a>";
    $view .= '</li>';
    $view .= "</ul>";
      
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク</title>
<link rel="stylesheet" href="css/select.css">
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
          <a class="navbar-brand" href="index.php">データ登録</a>
    <a class="navbar-brand" href="select.php">データ一覧</a>
    <a class="navbar-brand" href="user_submit.php">ユーザー登録</a>
    <a class="navbar-brand" href="user_list.php">ユーザー一覧</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
    <ul class="first"><li>id</li><li>書籍名</li><li>作家名</li><li>URL</li><li>コメント</li><li>登録日時</li><li>編集/削除</li></ul>
    <?=$view?>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>
