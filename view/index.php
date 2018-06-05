<?php
session_start();//セッションススタート
// セッション変数を解除
$_SESSION = array();

// セッションcookieを削除
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// セッションを破棄
session_destroy();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ログイン</title>
</head>

<body>
	<form action="../controller/user.php" method="post">
		<!-- メールアドレス 入力欄	-->
		<div class="inputForm">  
			メールアドレス：
			<input type="text" name="email">
		</div>	

		<!-- パスワード　入力欄 -->
		<div class="inputForm">  
			パスワード：		
			<input type="password" name="password">
		</div>	
		
		<!-- Sign In -->
		<input type="hidden" name="SignUpOrSignIn" value="SignIn">

		<input type="submit" value="ログイン">
	</form>

	<a href="new.php">新規登録</a>
</body>
</html>