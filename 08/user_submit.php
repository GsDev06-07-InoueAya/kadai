




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
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header">
          <a class="navbar-brand" href="index.php">データ登録</a>
    <a class="navbar-brand" href="select.php">データ一覧</a>
    <a class="navbar-brand" href="user_submit.php">ユーザー登録</a>
    <a class="navbar-brand" href="user_list.php">ユーザー一覧</a>
    </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
     <label>ユーザー名：<input type="text" name="name"></label><br>
     <label>ログインID：<input type="text" name="lid"></label><br>
     <label>ログインパスワード：<input type="text" name="lpw"></label><br>
     <label>ユーザー種別：<input type="radio" name="kanri_flg" value="0"> 一般者
<input type="radio" name="kanri_flg" value="1"> 管理者</label><br>
     <input type="hidden" name="life_flg" value="0">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
