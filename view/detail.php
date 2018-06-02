<?php 
	// session_start();
	require("../controller/article.php");
	require("../controller/comment.php");
	$loginUser = $_SESSION["loginUser"];
	$articleID = $_GET["id"];
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Takuya's site</title>
	<link rel="stylesheet" type="text/css" href="../assets/Custom.css">
	<script type="text/javascript" src="../assets/js/footerFixed.js"></script>
	<link rel="stylesheet" type="text/css" href="../assets/Custom.css">
</head>
<body>
	<div class="header">
		<p id="headTitle">Future News</p>
		<ul id="nav-link">
			<li class="link" id="rec">ログアウト</li>
		</ul>


	</div>


	<div class="contents">
		<!-- サイドバー（左）：ログインアカウント -->

		<div id="UserDetail">
			<!-- ユーザー情報 -->
			<div class="userInfo">
				<div id="userImg">
					<?php echo $loginUser["image"]; ?>
				</div>
				<div id="userName">
					<?php echo $loginUser["name"]; ?>
				</div>
			</div>

			<!-- コメント投稿フォーム -->
			<div id="comForm">
				<form action="../controller/comment.php" method="post">
					<textarea name="comment"></textarea>
					<input type="hidden" name="manage" value="postCom">

					<input type="hidden" name="userID" value="<?php echo $loginUser["id"]; ?>">
					<input type="hidden" name="articleID" value="<?php echo $articleID; ?>">

					<input type="submit" value="コメント">
				</form>
			</div>
		</div>

		<!-- 投稿詳細画面	 -->
		<div id="detailArticle">
			<!-- 記事詳細データを取得	 -->
			<?php $article = show($articleID); ?>
			
			<!-- タイトル -->
			<div id="title">
				<?php echo $article["title"]; ?>
			</div>
			
			<!-- 動画リンク -->
			<div id="youtube">
				<?php echo $article["youtube_url"]; ?>
			</div>

			<!-- 記事内容 -->
			<div id="artCon">
				<?php echo $article["content"]; ?>
			</div>
			
		</div>
		
		<!-- サイドバー（右）：コメント一覧 -->
		<div id="commentList">
			<?php $comments = showComment($articleID); ?>
			<?php foreach ($comments as $comment) { ?>
				<?php echo $comment["user_image"]; ?>
				<?php echo $comment["user_name"]; ?>
				<?php echo $comment["comment"]; ?>
				=====================================
			<?php } ?>

		</div>

	
	</div>

	<div id="footer">
		<div id="copyright">Copyright (c) Takuya Nakamatsu </div>
	</div>
</body>
</html>