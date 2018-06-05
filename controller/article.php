<?php 
session_start();
require("../model/article.php");

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
//	　　 Route設定
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

function show($id){
	$article = new Model_Article ; //Articleモデルインスタンスを作成
	$result = $article->find_by($id);
	error_log(print_r("test",true),"3","../../../../../logs/error_log");
	error_log(print_r($result,true),"3","../../../../../logs/error_log");
	return $result; 
}



function delete($id){
	$article = new Model_Article ; //Articleモデルインスタンスを作成
	// error_log(print_r($id,true),"3","../../../../../logs/error_log");
	$article->delete($id);
	


}

