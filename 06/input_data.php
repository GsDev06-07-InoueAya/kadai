<html>

<head>
    <meta charset="utf-8">
    <title>アンケート</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/reset.css">
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdn.mlkcca.com/v0.6.0/milkcocoa.js"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</head>

<body>
    <div class="cnt-form">
    <form action="output_data.php" method="post">
       <dl>
        <dt>お名前:</dt>
        <dd>
        <input type="text" name="name" class="form-area">
           </dd>
        <dt>カナ:</dt>
        <dd><input type="text" name="kana" class="form-area"></dd>
        <dt>
        EMAIL:</dt>
        <dd><input type="text" name="mail" class="form-area"></dd>
        <!-- ▼郵便番号入力フィールド(7桁) -->
        <dt>郵便番号:</dt>
           <dd><input type="text" name="zip01" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','pref01','addr01');" class="form-area"></dd>
        <!-- ▼住所入力フィールド(都道府県) -->
        <dt>住所（都道府県）:</dt>
        <dd><input type="text" name="pref01" size="20" class="form-area"></dd>
        <!-- ▼住所入力フィールド(都道府県以降の住所) -->
        <dt>住所（市区町村以降）:</dt>
        <dd><input type="text" name="addr01" size="60" class="form-area"></dd>
        </dl>

        <input type="submit" value="送信" class="form-btn">
    </form>
    </div>




</body>

</html>