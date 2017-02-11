<?php
if(!isset($_SESSION)){
session_start();
}

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
$link="";
$comment="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}elseif(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] == ""){ //管理者以外は編集削除を出さない
      //Selectデータの数だけ自動でループしてくれる
    $view .= '    <ul class="first">
    <li>id</li>
    <li>書籍名</li>
    <li>作家名</li>
    <li>URL</li>
    <li>コメント</li>
    <li>登録日時</li>
    </ul>';
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
      if($res["book_url"] == ""){
          $link = '<li>ー</li>';
      }else{
          $link = '<li><a href="'.$res["book_url"].'" target="_blank">URL</a></li>';
      }
      
      if($res["book_comment"] == ""){
          $comment = '<li>ー</li>';
      }else{
          $comment = '<li>'.$res["book_comment"].'</li>';
      }
      
      $view .= "<ul>";
      $view .= "<li>".$res["id"]."</li>";
      $view .= "<li>".$res["book_title"]."</li>";
      $view .= "<li>".$res["book_writer"]."</li>";
      $view .= $link;
      $view .= $comment;
      $view .= "<li>".$res["created_at"]."</li>";
      $view .= "</ul>";
    
}
}elseif($_SESSION["kanri_flg"] == 1 || $_SESSION["kanri_flg"] == 0){//管理者は編集削除を出す
    
    $view .= '    <ul class="first">
    <li>id</li>
    <li>書籍名</li>
    <li>作家名</li>
    <li>URL</li>
    <li>コメント</li>
    <li>登録日時</li>
    <li>編集/削除</li>
    </ul>';
  //Selectデータの数だけ自動でループしてくれる
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
      
          if($res["book_url"] == ""){ //URLが空欄だったらハイフン
          $link = '<li>ー</li>';
      }else{
          $link = '<li><a href="'.$res["book_url"].'" target="_blank">URL</a></li>';
      }
      
      if($res["book_comment"] == ""){//コメントが空欄だったらハイフン
          $comment = '<li>ー</li>';
      }else{
          $comment = '<li>'.$res["book_comment"].'</li>';
      }
      
    $view .= "<ul>";
    $view .= "<li>".$res["id"]."</li>";
    $view .= "<li>".$res["book_title"]."</li>";
    $view .= "<li>".$res["book_writer"]."</li>";
    $view .= $link;
    $view .= $comment;
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
<?php include ('global_menu.php'); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
    <?=$view?>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>
