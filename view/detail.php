<?php 
	// session_start();
	require("../controller/article.php");
	$loginUser = $_SESSION["loginUser"];
	$articleID = $_GET["id"];
	error_log(print_r("============================================================================",true),"3","../../../../../logs/error_log");
	error_log(print_r($loginUser,true),"3","../../../../../logs/error_log");
	error_log(print_r("============================================================================",true),"3","../../../../../logs/error_log");


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
			<!-- <li class="link" id="aboutMe">About Me</li> -->
			<li class="link" id="rec">ログアウト</li>
		</ul>
		<!-- <div class="link" id="aboutMe">About Me</div>
		<div class="link" id="rec">Recommendation</div> -->


	</div>
	

	<!-- TODO -->
	<!-- 1.サイドバー(左)作成
		1.ログインユーザー画像
		2.ログインユーザー
		3.textarea(投稿に対するコメントの内容)
		4.コメント登録ボタン
	2.サイドバー(右)作成：投稿に対する全ユーザーコメント欄
		1.ユーザー名
		2.コメント内容
	3.投稿の詳細欄
		1.youtubeの埋め込み動画
		2.記事の内容 -->


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
			
		</div>

	
	</div>

	<div id="footer">
		<div id="copyright">Copyright (c) Takuya Nakamatsu </div>
	</div>
</body>
</html>