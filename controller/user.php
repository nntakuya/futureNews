<?php 
session_start();
require("../model/user.php");

// 初期値のセット
$name = "";
$email = "";
$password = "";
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
		// error_log(print_r($_FILES,true),"3","../../../../../logs/error_log");
		createUser();
	}
}




//ユーザーの新規登録
function createUser(){
	$user = new Model_User;
	$name = htmlspecialchars($_POST["name"]);
	$email = htmlspecialchars($_POST["email"]);
	$password = htmlspecialchars($_POST["password"]);
	$owner = htmlspecialchars($_POST["owner"]);

	$result = $user->create($name,$email,$password,$owner);


	error_log(print_r($result,true),"3","../../../../../logs/error_log");
	//(課題）errorの数が0じゃない場合にするか？
	//TODO:下記のErrorの場合の処理は、詰める
	if ($result == "error") {
		//new.phpへリダイレクト
		//フォームの初期値を入力状態へ
		header('Location: ../view/new.php');
	}else{
		$_SESSION["loginUser"] = $result["loginUser"];
		header('Location: ../view/top.php');
	}
}
	


//ユーザーのログイン
function loginUser(){
	$result = [
		"login"=>"",
	];


	$user = new Model_User; //ユーザーモデルインスタンスを作成
	$email = htmlspecialchars($_POST["email"]);
	$password = htmlspecialchars($_POST["password"]);

	$status = $user->find_by($email,$password);//email,passwordからログインユーザーを認証
	// error_log(print_r($loginUser,true),"3","../../../../../logs/error_log");


	if ($status['error'] == 'notFind') {
		//ログイン画面に、入力された値を保持したままリダイレクト
		header('Location: ../view/index.php');
		exit;
	}
	
	//取得したユーザー情報をSessionに保存する
	//TODO:余力があれば、トークンを発行して、別通信でもコンフリクトを起こさないようにする。
	$_SESSION["loginUser"] = $status["loginUser"];
	error_log(print_r("loginuser-------",true),"3","../../../../../logs/error_log");
	error_log(print_r($_SESSION["loginUser"],true),"3","../../../../../logs/error_log");
	header('Location: ../view/top.php');
	exit;
	
}



