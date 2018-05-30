<?php require("../../console/controller/article.php"); ?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>ログイン</title>
	<script src="../../assets/js/jquery-3.1.1.js" type="text/javascript"></script>
	<script src="../../assets/js/jquery-2.1.4.min.js" type="text/javascript"></script>
	
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

	<!-- 下記に保存された記事一覧画面作成 -->
	<!-- 機能①記事の編集機能
	機能②記事の削除機能 -->

	<!-- 記事データを全件取得 -->
	<?php $articles = showAll(); ?>
	<div id="list">
		<?php foreach ($articles as $article) { ?>
			<div class="aritcle" id="<?php echo $article["id"] ?>">
				<div class="id">
					ID: <?php echo $article["id"] ?>
				</div>
				<div class="title">
					タイトル： <?php echo $article["title"] ?>
				</div>
				<div class="content">
					内容： <?php echo $article["content"] ?>
				</div>
				<div class="youtube">
					Youtube： <?php echo $article["youtube_url"] ?>
				</div>
				<button class="delete" value="<?php echo $article["id"] ?>">削除</button>
			</div>
		<?php } ?>
	</div>

	<!-- なぜ、この場所でのみでしかcustom.jsファイルの関数が実行できないのか分からない -->
	<script src="../../assets/js/custom.js" type="text/javascript"></script>



</body>
</html>