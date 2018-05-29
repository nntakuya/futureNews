<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ログイン</title>
</head>
<body>
	<form action="../controller/article.php" method="post">
		<!-- タイトル 入力欄	-->
		<div class="inputForm">  
			タイトル：
			<input type="text" name="title">
		</div>	
		<!-- 内容 入力欄	-->
		<div class="inputForm">  
			内容：
			<textarea name="content"></textarea>
		</div>	

		<!-- youtubeLink　入力欄 -->
		<div class="inputForm">  
			Youtubeリンク：		
			<input type="text" name="youtube">
		</div>

		<input type="hidden" name="manage" value="upload">



		<input type="submit" value="投稿">
	</form>
</body>
</html>