<?php
if(!isset($_SESSION)){
session_start();
}

$menu="";
if(
    !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] == ""
  ){
    $print_name = "ゲスト";
    
    $menu .= '
      <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="select.php">データ一覧</a>
    <a class="navbar-brand" href="login.php">ログイン</a>
    ようこそ'.$print_name.'さん
    </div>
    </div>
  </nav>
    ';
}else if($_SESSION["kanri_flg"] == 0){
    $print_name = $_SESSION["name"];
    $menu .= '
    <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="select.php">データ一覧</a>
    <a class="navbar-brand" href="index.php">データ登録</a>
    <a class="navbar-brand" href="logout.php">ログアウト</a>
    ようこそ'.$print_name.'さん
    </div>
    </div>
  </nav>
    ';
    
}else if($_SESSION["kanri_flg"] == 1){
    $print_name = $_SESSION["name"];
        $menu .= '
          <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="select.php">データ一覧</a>
    <a class="navbar-brand" href="index.php">データ登録</a>
    <a class="navbar-brand" href="user_submit.php">ユーザー登録</a>
    <a class="navbar-brand" href="user_list.php">ユーザー一覧</a>
    <a class="navbar-brand" href="logout.php">ログアウト</a>
    ようこそ'.$print_name.'さん
    </div>
    </div>
  </nav>
    ';
}

?>

   <?=$menu?>

<!--
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header">
          <a class="navbar-brand" href="index.php">データ登録</a>
    <a class="navbar-brand" href="select.php">データ一覧</a>
    <a class="navbar-brand" href="user_submit.php">ユーザー登録</a>
    <a class="navbar-brand" href="user_list.php">ユーザー一覧</a>
    <a class="navbar-brand" href="login.php">ログイン</a>
    <a class="navbar-brand" href="logout.php">ログアウト</a>
    </div>
    </div>
  </nav>-->
