<?php
$id = $_GET["id"];

//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);//PDO::PARAM_INTはセキュリティ強化。STR or INT
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
    $res = $stmt->fetch();//1レコード分取得出来る
    
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ編集</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

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
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>書籍登録</legend>
     <label>書籍名：<input type="text" name="book_title" value="<?=$res["book_title"]?>"></label><br>
     <label>書籍URL：<input type="text" name="book_url" value="<?=$res["book_url"]?>"></label><br>
     <label>書籍コメント<textArea name="book_comment" rows="4" cols="40"><?=$res["book_comment"]?></textArea></label><br>
     <input type="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="更新">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>





