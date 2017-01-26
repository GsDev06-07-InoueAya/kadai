<?php
include("funcs.php");

$name = $_POST["name"];
$kana = $_POST["kana"];
$mail = $_POST["mail"];
$zip01 = $_POST["zip01"];
$pref01 = $_POST["pref01"];
$addr01 = $_POST["addr01"];



?>

<html>
<head>
<meta charset="utf-8">
<title>アンケート確認</title>
</head>
<body>
<?php
    
$str = date("Y-m-d H:i:s").",".$name.",".$kana.",".$mail.",".$zip01.",".$pref01.",".$addr01;

$file = fopen("data/data.csv","a");	// ファイル読み込み
flock($file, LOCK_EX);			// ファイルロック
fwrite($file, $str."\n");  //ドットで文字をつなげる
flock($file, LOCK_UN);			// ファイルロック解除
fclose($file);
?>


お名前：<?php echo h($name); ?>
<br>
カナ：<?php echo h($kana); ?>
<br>
Mail：<?php echo h($mail); ?>
<br>
郵便番号：<?php echo h($zip01); ?>
<br>
住所：<?php echo h($pref01." ".$addr01); ?>
<br>



</body>
</html>