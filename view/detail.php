<?php 
	require("../controller/article.php");//cotroller_articleの読込
	require("../controller/comment.php");//cotroller_commentの読込
	require("parts/header.php");//ヘッダーの読込 & セッションが切れた場合,index.phpへリダイレクト
	
	//記事IDが選択されていない場合,top.phpへリダイレクト
	if (empty($_GET["id"])) {
		header('Location: top.php');
		exit;
	}

	$loginUser = $_SESSION["loginUser"];
	$articleID = $_GET["id"];
 ?>




<div class="contents">
	<!-- サイドバー（左）：ログインアカウント -->
	<div id="UserDetail">
		<!-- ユーザー情報 -->
		<div class="userInfo">
			<div id="userImg">
				<img style="width:100px;" src="../assets/user_image/<?php echo $loginUser["image"];?>">
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
			<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $article["youtube_url"]; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		</div>

		<!-- 記事内容 -->
		<div style="width:560px;" id="artCon">
			<?php echo $article["content"]; ?>
		</div>
		
	</div>
	
	<!-- サイドバー（右）：コメント一覧 -->
	<div id="commentList">
		<?php $comments = showComment($articleID); ?>
		<?php foreach ($comments as $comment) { ?>
			<img style="width:100px;" src="../assets/user_image/<?php echo $comment["user_image"]; ?>">
			<br>
			<?php echo $comment["user_name"]; ?>
			<br>
			<?php echo $comment["comment"]; ?>
			=====================================
		<?php } ?>

	</div>
</div>








<!-- フッターの読込	 -->
<?php require("parts/footer.php"); ?>	