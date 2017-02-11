<?php
//1. POSTデータ取得

$book_title   = $_POST["book_title"];
$book_writer   = $_POST["book_writer"];
$book_url  = $_POST["book_url"];
$book_comment = $_POST["book_comment"];


//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root',''); //  rootの後ろはパスワード
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, book_title, book_writer, book_url, book_comment,
created_at )VALUES(NULL, :book_title, :book_writer, :book_url, :book_comment, sysdate())");
$stmt->bindValue(':book_title', $book_title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_writer', $book_writer, PDO::PARAM_STR);
$stmt->bindValue(':book_url', $book_url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_comment', $book_comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();  //実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．一覧へリダイレクト
  header("Location: select.php"); //location:の後には必ず半角スペース
  exit;  //headerを使ったら必ず終了を書く

}
?>
