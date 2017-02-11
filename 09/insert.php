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

//1. POSTデータ取得

$user_id   = $_POST["user_id"];
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


//入力値チェック
$sbook_title = strlen($book_title);
$sbook_writer = strlen($book_writer);

//書籍名
if($book_title == ""){//空欄チェック
    $_SESSION['err_check'] .= '<p class="error">書籍名を入力してください。</p>';
}

//著者
if($book_writer == ""){//空欄チェック
    $_SESSION['err_check'] .= '<p class="error">著者を入力してください。</p>';
}


//書籍・著者重複チェック
$stmt = $pdo->prepare("SELECT COUNT(*) AS num FROM gs_bm_table WHERE book_title=:book_title AND book_writer=:book_writer");
$stmt->bindValue(":book_title",$book_title,PDO::PARAM_STR);
$stmt->bindValue(":book_writer",$book_writer,PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
    $res = $stmt->fetch();//1レコード分取得出来る
//    echo $res["num"];
    
}
if($res["num"] >= 1){
  $_SESSION['err_check'] .= '<p class="error">書籍はすでに登録されています。</p>';
 }


//３．データ登録SQL作成

if($_SESSION['err_check'] == ""){ 
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
    }else{
    //５．登録画面へリダイレクト
  header("Location: index.php"); //location:の後には必ず半角スペース
  exit;  //headerを使ったら必ず終了を書く
}
?>
