<?php
$name = $_GET["name"];

//1.  DB接続します

try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root',''); //  rootの後ろはパスワード
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//重複チェック
$stmt = $pdo->prepare("SELECT COUNT(*) AS num FROM gs_user_table WHERE name=:name");
$stmt->bindValue(":name",$name,PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
    $res = $stmt->fetch();//1レコード分取得出来る
    echo $res["num"];
    
}



//$stmt = $pdo -> query("SELECT * FROM gs_user_table");
//while($item = $stmt->fetch()) {
//if($item['name'] == $name){
//  $error = '<p class="error">ご希望のメールアドレスは既に使用されています。</p>';
// }else{
// $name = $name;
// }
//}

?>