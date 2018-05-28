<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ログイン</title>
</head>

<body>
	<form action="../controller/user.php" method="get">
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

		<input type="submit" value="ログイン">
	</form>

	<a href="new.php">新規登録</a>
</body>
</html>