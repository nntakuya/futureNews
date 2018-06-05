<?php 
	require("../controller/article.php"); 
	require("parts/header.php");//ヘッダーの読込 & セッションが切れた場合,index.phpへリダイレクト
?>

<div class="contnets">
	<!-- my product -->
	<div id="contents_one">
		<p class="contentTitle">TOPICS</p>
		<div id="productImages">

			<!-- 記事データを全件取得 -->
			<?php $articles = showAll(); ?>
			<div id="list">
				<?php foreach ($articles as $article) { ?>
					<a href="detail.php?id=<?php echo $article["id"] ?>" ">
						<div class="productImage article" id=" <?php echo $aritcle["id"] ?> ">
							<div class="title">
								タイトル： <?php echo $article["title"]; ?>
							</div>
							<div class="youtube">
								<img  src="http://i.ytimg.com/vi/<?php echo $article["youtube_url"]; ?>/1.jpg" alt="">
							</div>
						</div>
					</a> 
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php require("parts/footer.php");//フッターの読み込み ?>