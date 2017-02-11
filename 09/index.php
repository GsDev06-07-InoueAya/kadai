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

?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
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


<form method="post" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>書籍登録</legend>
     <label>書籍名：<input type="text" name="book_title"></label><br>
     <label>著者：<input type="text" name="book_writer"></label><br>
     <label>書籍URL：<input type="text" name="book_url"></label><br>
     <label>書籍コメント<textArea name="book_comment" rows="4" cols="40"></textArea></label><br>
     <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
