<?php
if(!isset($_SESSION)){
session_start();
}

if(
    !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] == ""
  ){
    header("Location: error.php");
    exit();
}

//1.POSTでParamを取得
$id           = $_POST["id"];
$book_title   = $_POST["book_title"];
$book_writer   = $_POST["book_writer"];
$book_url     = $_POST["book_url"];
$book_comment = $_POST["book_comment"];


//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_bm_table SET book_title=:book_title, book_writer=:book_writer, book_url=:book_url, book_comment=:book_comment WHERE id=:id");
$stmt->bindValue(':book_title', $book_title, PDO::PARAM_STR);
$stmt->bindValue(':book_writer', $book_writer, PDO::PARAM_STR);
$stmt->bindValue(':book_url', $book_url, PDO::PARAM_STR);
$stmt->bindValue(':book_comment', $book_comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．select.phpへリダイレクト
  header("Location: select.php");
  exit;
}



?>
