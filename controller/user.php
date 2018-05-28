<?php 
session_start();
require("../model/user.php");

// 初期値のセット
$name = "";
$email = 
$password = "";
$image = "sampleImage";
$owner = 0;


// ==========================
//	　　 ログイン or 新規登録
// ==========================
if (isset($_POST)) {
	//ユーザーの ログイン or 新規登録
	if ($_POST["SignUpOrSignIn"] == "SignIn") 
	{
		error_log(print_r("SignIn",true),"3","../../../../../logs/error_log");
		loginUser();

	}elseif ($_POST["SignUpOrSignIn"] == "SignUp") 
	{
		error_log(print_r("SignUp",true),"3","../../../../../logs/error_log");
		createUser();
	}
}




//ユーザーの新規登録
function createUser(){
	$user = new Model_User;
	$name = htmlspecialchars($_POST["name"]);
	$email = htmlspecialchars($_POST["email"]);
	$password = htmlspecialchars($_POST["password"]);
	$image = htmlspecialchars($_POST["image"]);
	$owner = htmlspecialchars($_POST["owner"]);

	$result = $user->create($name,$email,$password,$image,$owner);


	error_log(print_r($result,true),"3","../../../../../logs/error_log");
	//(課題）errorの数が0じゃない場合にするか？
	//TODO:下記のErrorの場合の処理は、詰める
	if ($result == "error") {
		//new.phpへリダイレクト
		//フォームの初期値を入力状態へ
		header('Location: ../view/new.php');
	}else{
		$_SESSION["loginUser"] = $result;
		header('Location: ../view/top.php');
	}
	//そのままtop.phpへリダイレクト
}
	
//ユーザーのログイン
function loginUser(){
	$user = new Model_User; //ユーザーモデルインスタンスを作成
	$email = htmlspecialchars($_POST["email"]);
	$password = htmlspecialchars($_POST["password"]);

	$result = $user->find_by($email,$password);//email,passwordからログインユーザーを認証
	// error_log(print_r($loginUser,true),"3","../../../../../logs/error_log");


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



