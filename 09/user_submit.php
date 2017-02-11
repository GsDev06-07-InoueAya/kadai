<?php
  if(!isset($_SESSION)){
session_start();
}

if(
    !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] == "" || $_SESSION["kanri_flg"] == 0
  ){
    header("Location: error.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
<?php include ('global_menu.php'); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<?php
  if(isset($_SESSION['err_check'])) {
    print($_SESSION['err_check']);
  } else {
//    print("\$_SESSION['err_check']はセットされていません。<br>");
  }
    $_SESSION['err_check'] = "";
 ?>

<form method="post" action="user_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
     <label>ユーザー名：<input type="text" name="name"></label><br>
     <label>ログインID：<input type="text" name="lid"></label><br>
     <label>ログインパスワード：<input type="password" name="lpw"></label><br>
     <label>ユーザー種別：<input type="radio" name="kanri_flg" value="0" checked="checked"> 一般者
<input type="radio" name="kanri_flg" value="1"> 管理者</label><br>
     <input type="hidden" name="life_flg" value="0">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
