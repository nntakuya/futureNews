<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ログイン</title>
</head>
<body>
	<form action="index_submit" method="post">
		<!-- ユーザー名 入力欄	-->
		<div class="inputForm">  
			ユーザー名：
			<input type="text" name="name">
		</div>	
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

		<!-- 余力があれば、パスワード確認欄を作成 -->

		<input type="submit" value="新規登録">
	</form>

	<a href="index	.php">戻る</a>
</body>
</html>