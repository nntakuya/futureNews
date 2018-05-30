<?php 
session_start();
require("../../model/article.php");

// 初期値
$title = "";
$content = 
$youtube = "";

//Model_Articleの呼び出しに失敗した場合に、エラーを下記の変数に格納する
$result = [
	'articlesData'=>"",
	"result"=>""
];
$errors=[
		"inputData"=>"notFind"
];


// ==========================
//	　　 記事の投稿
// ==========================
if (!empty($_POST)) {
	//ユーザーの ログイン or 新規登録
	if ($_POST["manage"] == "upload") 
	{
		create();

	}elseif ($_POST["manage"] == "delete") 
	{
		error_log(print_r($_POST,true),"3","../../../../../logs/error_log");
		delete($_POST["articleId"]);
	}
}




//記事の投稿
function create(){
	$article = new Model_Article ;
	$title = htmlspecialchars($_POST["title"]);
	$content = htmlspecialchars($_POST["content"]);
	$youtubeLink = htmlspecialchars($_POST["youtube"]);

	$result = $article->create($title,$content,$youtubeLink);

	//(課題）errorの数が0じゃない場合にするか？
	//TODO:下記のErrorの場合の処理は、詰める
	// if ($result == "error") {
	// 	//new.phpへリダイレクト
	// 	//フォームの初期値を入力状態へ
	// 	$_SESSION["result"] = "投稿できませんでした。";
	// 	header('Location: ../view/management.php');
	// 	exit;
	// }else{
	// 	//TODO:投稿完了のお知らせをsessionでする
	// 	$_SESSION["result"] = "投稿しました。";
	// 	header('Location: ../view/management.php');
	// 	exit;
	// }
	//そのままtop.phpへリダイレクト
	header('Location: ../view/management.php');
	exit;
}
	
//記事全件取得
function showAll(){
	

	//1.Articleモデルをインスタンス化
	$article = new Model_Article ; //Articleモデルインスタンスを作成
	$result = $article->find_all();

	return $result; 
}


function delete($id){
	$article = new Model_Article ; //Articleモデルインスタンスを作成
	error_log(print_r($id,true),"3","../../../../../logs/error_log");
	$article->delete($id);
	


}

