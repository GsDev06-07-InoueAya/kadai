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


$id = $_GET["id"];

//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //SQL実行

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
