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

$id = $_GET["id"];

//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
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

<?php
$kanri_flg = $res["kanri_flg"];
$kanri_view = "";

    if($kanri_flg == 0){ //0は一般者
        $kanri_view .= '<label>ユーザー種別：<input type="radio" name="kanri_flg" value="0" checked="checked"> 一般者
<input type="radio" name="kanri_flg" value="1"> 管理者</label><br>';
    }else{ //1は管理者
    $kanri_view .= '<label>ユーザー種別：<input type="radio" name="kanri_flg" value="0"> 一般者
<input type="radio" name="kanri_flg" value="1" checked="checked"> 管理者</label><br>';
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
<form method="post" action="user_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー編集</legend>
     <label>ユーザー名：<input type="text" name="name" value="<?=$res["name"]?>"></label><br>
     <label>ログインID：<input type="text" name="lid" value="<?=$res["lid"]?>"></label><br>
     <label>ログインパスワード：<input type="text" name="lpw" value="<?=$res["lpw"]?>"></label><br>
     
     <?=$kanri_view?>
     <!--管理者か一般者か-->
    
     <input type="hidden" name="life_flg" value="0">
     <input type="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="更新">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
