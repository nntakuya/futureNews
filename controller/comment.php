<?php 
session_start();
require("../model/comment.php");

// 初期値
$comment = "";

//Model_Articleの呼び出しに失敗した場合に、エラーを下記の変数に格納する
$result = [
	'commentsData'=>"",
	"result"=>""
];
$errors=[
		"inputData"=>"notFind"
];



// ==========================
//	　　 Route設定
// ==========================
if (!empty($_POST)) {
	//コメントの投稿
	if ($_POST["manage"] == "postCom") 
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
	$comment = new Model_Comment ;
	$content = htmlspecialchars($_POST["comment"]);
	$articleID = htmlspecialchars($_POST["articleID"]);
	$userID = htmlspecialchars($_POST["userID"]);

	$result = $comment->create($content,$articleID,$userID);

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
	header('Location: ../view/detail.php?id='.$articleID);
	exit;
}
	
//記事全件取得
function showAll(){
	//1.Articleモデルをインスタンス化
	$comment = new Model_Comment ; //commentモデルインスタンスを作成
	$result = $comment->find_all();

	return $result; 
}

function show($id){
	$comment = new Model_Comment ; //commentモデルインスタンスを作成
	$result = $comment->find_by($id);
	error_log(print_r("test",true),"3","../../../../../logs/error_log");
	error_log(print_r($result,true),"3","../../../../../logs/error_log");
	return $result; 
}



function delete($id){
	$comment = new Model_Comment ; //commentモデルインスタンスを作成
	// error_log(print_r($id,true),"3","../../../../../logs/error_log");
	$comment->delete($id);
	


}

