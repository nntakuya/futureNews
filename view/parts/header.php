<?php 
	error_log(print_r("test",true),"3","../../../../../logs/error_log");
	error_log(print_r($_SESSION,true),"3","../../../../../logs/error_log");
	if (empty($_SESSION["loginUser"])) {
		header('Location: index.php');
		exit;
	}

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
		<a href="top.php"><p id="headTitle">Future News</p></a>
		<ul id="nav-link">
			<li class="link" id="logout"><a href="index.php">ログアウト</a></li>
		</ul>
	</div>

