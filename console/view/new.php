<!-- オーナー権を確認するために、ユーザーテーブルにオーナーカラムを作成	 -->


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ログイン</title>
</head>
<body>
	<form action="../controller/user.php" method="post">
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

		<div class="inputForm">  
			画像：		
			<input id="imgFile" type="file" name="image">
		</div>				

		<!-- 余力があれば、パスワード確認欄を作成 -->
		
		<!-- オーナー権をアリにする -->
		<input type="hidden" name="owner" value="1">

		<!-- Sign Up -->
		<input type="hidden" name="SignUpOrSignIn" value="SignUp">

		<input type="submit" value="新規登録">
	</form>
	<a href="login.php">戻る</a>
</body>
</html>