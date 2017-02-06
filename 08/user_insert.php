<?php
session_start();

//1. POSTデータ取得
$name   = $_POST["name"];
$lid  = $_POST["lid"];
$lpw = $_POST["lpw"];
$kanri_flg = $_POST["kanri_flg"];
$life_flg = $_POST["life_flg"];


//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root',''); //  rootの後ろはパスワード
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//入力値チェック
$sname = strlen($name);
$slid = strlen($lid);
$slpw = strlen($lpw);

//ユーザー名
if($name == ""){//空欄チェック
    $_SESSION['err_check'] .= '<p class="error">ユーザー名を入力してください。</p>';
}else if($sname < 2 || 32 < $sname) {//文字数チェック
    $_SESSION['err_check'] .= '<p class="error">ユーザー名は2〜32文字で設定してください。</p>';
}


//ログインID
if($lid == ""){
    $_SESSION['err_check'] .= '<p class="error">ログインIDを入力してください。</p>';
}else{
    if($slid < 2 || 64 < $slid) {
        $_SESSION['err_check'] .= '<p class="error">ログインIDは2〜64文字で設定してください。</p>';
    }
    //プレグマッチ
    if (preg_match("/^[a-zA-Z0-9]+$/", $lid)) {
        $lid = $lid;
    }else{
        $_SESSION['err_check'] .= '<p class="error">ログインIDは半角英数で登録してください。</p>';
    }
}


//ログインパスワード
if($lpw == ""){
    $_SESSION['err_check'] .= '<p class="error">ログインパスワードを入力してください。</p>';
}else{
    
    if($slpw < 2 || 32 < $slpw) {
        $_SESSION['err_check'] .= '<p class="error">ログインパスワードは2〜32文字で設定してください。</p>';
    }
    //プレグマッチ
    if (preg_match("/^[a-zA-Z0-9]+$/", $lpw)) {
        $lpw = $lpw;
    }else{
        $_SESSION['err_check'] .= '<p class="error">ログインパスワードは半角英数で登録してください。</p>';
    }
}


//ログインID重複チェック
$stmt = $pdo->prepare("SELECT COUNT(*) AS num FROM gs_user_table WHERE lid=:lid");
$stmt->bindValue(":lid",$name,PDO::PARAM_STR);
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
  $_SESSION['err_check'] .= '<p class="error">ログインIDはすでに使用されています</p>';
 }


//３．データ登録SQL作成
if($_SESSION['err_check'] == ""){ //エラーがなかった場合
    $stmt = $pdo->prepare("INSERT INTO gs_user_table(id, name, lid, lpw,kanri_flg,life_flg,
created_at )VALUES(NULL, :name, :lid, :lpw, :kanri_flg, :life_flg, sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);
$status = $stmt->execute();  //実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．一覧へリダイレクト
  header("Location: user_list.php"); //location:の後には必ず半角スペース
  exit;  //headerを使ったら必ず終了を書く

}
    
}else{
    //５．登録画面へリダイレクト
  header("Location: user_submit.php"); //location:の後には必ず半角スペース
  exit;  //headerを使ったら必ず終了を書く
}



?>