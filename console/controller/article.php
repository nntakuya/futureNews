<?php 
session_start();
require("../../model/article.php");

// 初期値
$title = "";
$content = 
$youtube = "";


// ==========================
//	　　 記事の投稿
// ==========================
if (isset($_POST)) {
	//ユーザーの ログイン or 新規登録
	if ($_POST["manage"] == "upload") 
	{
		error_log(print_r("upload",true),"3","../../../../../logs/error_log");
		loginUser();

	}elseif ($_POST["SignUpOrSignIn"] == "SignUp") 
	{
		error_log(print_r("SignUp",true),"3","../../../../../logs/error_log");
		createUser();
	}
}




//ユーザーの新規登録
function createAritcle(){
	$article = new Model_Article ;
	$title = htmlspecialchars($_POST["title"]);
	$content = htmlspecialchars($_POST["content"]);
	$youtubeLink = htmlspecialchars($_POST["youtube"]);

	$result = $article->create($title,$content,$youtubeLink);


	error_log(print_r($result,true),"3","../../../../../logs/error_log");
	//(課題）errorの数が0じゃない場合にするか？
	//TODO:下記のErrorの場合の処理は、詰める
	if ($result == "error") {
		//new.phpへリダイレクト
		//フォームの初期値を入力状態へ
		$_SESSION["result"] = "投稿できませんでした。";
		header('Location: ../view/management.php');
		exit;
	}else{
		//TODO:投稿完了のお知らせをsessionでする
		$_SESSION["result"] = "投稿しました。";
		header('Location: ../view/management.php');
		exit;
	}
	//そのままtop.phpへリダイレクト
}
	
//ユーザーのログイン
function showAllArticle(){
	
	//2.全件取得し、Sessionに保存
	//3.viewで全件表示


	//1.Articleモデルをインスタンス化
	$article = new Model_Article ; //Articleモデルインスタンスを作成
	$_SESSION["article"] = $article->showAllArticle(); //2.全件取得し、Sessionに保存
	 
	
	//以下の処理は微妙
	if ($result['login'] == 'NG') {
		//ログイン画面に、入力された値を保持したままリダイレクト
		header('Location: ../view/index.php');
		error_log(print_r($result['login'],true),"3","../../../../../logs/error_log");
	}else{
		//取得したユーザー情報をSessionに保存する
		//TODO:余力があれば、トークンを発行して、別通信でもコンフリクトを起こさないようにする。
		$_SESSION["loginUser"] = $result;
		error_log(print_r("me",true),"3","../../../../../logs/error_log");
		header('Location: ../view/top.php');
	}
}



