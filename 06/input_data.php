<html>

<head>
    <meta charset="utf-8">
    <title>アンケート</title>
    <link rel="stylesheet" href="css/style.css">
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdn.mlkcca.com/v0.6.0/milkcocoa.js"></script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</head>

<body>
    <div class="cnt-form">
    <form action="output_data.php" method="post">
       
       
       
       
        お名前:
        <input type="text" name="name">
        <br>
        カナ:
        <input type="text" name="kana">
        <br>
        EMAIL:
        <input type="text" name="mail">
        <br>
        <!-- ▼郵便番号入力フィールド(7桁) -->
        郵便番号:
        <input type="text" name="zip01" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','pref01','addr01');">
        <br>
        <!-- ▼住所入力フィールド(都道府県) -->
        住所（都道府県）:
        <input type="text" name="pref01" size="20">
        <br>
        <!-- ▼住所入力フィールド(都道府県以降の住所) -->
        住所（市区町村以降）:
        <input type="text" name="addr01" size="60">
        <br>
        
        <input type="submit" value="送信">
    </form>
    </div>


<!--
    <div class="cnt-form">
        <form method="post" action="output_data.php" class="sousin">
            <dl> <dt>名前</dt>
                <dd>
                    <input type="text" value="" name="名前" maxlength="60" class="form-area"> </dd> <dt>カナ</dt>
                <dd>
                    <input type="text" value="" name="カナ" maxlength="60" class="form-area"> </dd> <dt>メールアドレス</dt>
                <dd>
                    <input type="text" value="" name="メール" maxlength="256" class="form-area"> </dd> <dt>チーズアカデミーを<br>知ったきっかけ</dt>
                <dd>
                    <select name="きっかけ" id="" class="form-area">
                        <option value="google">google検索</option>
                        <option value="sns">SNS</option>
                        <option value="shokai">紹介</option>
                        <option value="tamatama">たまたま通りかかった</option>
                        <option value="other">その他</option>
                    </select>
                </dd> <dt>志望動機</dt>
                <dd>
                    <ul>
                        <li>
                            <input type="checkbox" value="起業" name="trigger" class="checkbox">起業をしたい </li>
                        <li>
                            <input type="checkbox" value="転職" name="trigger" class="checkbox">チーズ系企業に就職・転職したい</li>
                        <li>
                            <input type="checkbox" value="仕事" name="trigger" class="checkbox">チーズと関わる仕事をしており、仕事に生かしたい</li>
                        <li>
                            <input type="checkbox" value="教養" name="trigger" class="checkbox">チーズの教養を身につけたい</li>
                    </ul>
                </dd> <dt>詳細</dt>
                <dd>
                    <textarea id="shosai" name="詳細" cols="20" rows="4" maxlength="1000" wrap="soft" class="form-shosai"></textarea>
                </dd>
            </dl>
            <input type="submit" value="送信" class="form-btn"> </form>
    </div>
-->



</body>

</html>