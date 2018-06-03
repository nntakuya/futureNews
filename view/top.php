<?php require("../controller/article.php"); ?>


<!DOCTYPE html>
<html>
<head>
	<title>Takuya's site</title>
	<link rel="stylesheet" type="text/css" href="../assets/Custom.css">
	<script type="text/javascript" src="../assets/js/footerFixed.js"></script>
	
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
							<div class="productImage aritcle" id="<?php echo $article["id"] ?>">
								<div class="title">
									タイトル： <?php echo $article["title"]; ?>
								</div>
								<div class="youtube">
									<!-- Youtube： <?php echo $article["youtube_url"]; ?> -->
									<img  src="http://i.ytimg.com/vi/<?php echo $article["youtube_url"]; ?>/1.jpg" alt="">
								</div>
							</div>
						</a> 
						
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<div id="footer">

		<div id="copyright">Copyright (c) Takuya Nakamatsu </div>

		
		
	</div>
</body>
</html>