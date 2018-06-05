<?php 
session_start();
require("../../model/user.php");

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
		error_log(print_r("ConsoleSignIn",true),"3","../../../../../logs/error_log");
		loginUser();

	}elseif ($_POST["SignUpOrSignIn"] == "SignUp") 
	{
		error_log(print_r("ConsoleSignUp",true),"3","../../../../../logs/error_log");
		createUser();
	}
}




// =========================
	// ユーザー新規登録
// =========================
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
		$_SESSION["loginUser"] = $result;
		header('Location: ../view/management.php');
	}
}
	




// =========================
	// ユーザーログイン
// =========================
function loginUser(){
	$user = new Model_User; //ユーザーモデルインスタンスを作成

	//フォームの値をそれぞれセット
	$email = htmlspecialchars($_POST["email"]);
	$password = htmlspecialchars($_POST["password"]);


	error_log(print_r("¥¥¥¥¥¥¥¥¥¥¥¥¥¥¥¥¥",true),"3","../../../../../logs/error_log");
	$result = $user->find_by($email,$password);//email,passwordからログインユーザーを認証

	error_log(print_r(is_array($result),true),"3","../../../../../logs/error_log");
	error_log(print_r("conLoginUser===".$testSample,true),"3","../../../../../logs/error_log");



	//以下の処理は微妙
	//『データベースにユーザーデータが存在しない』OR『 オーナー権がない』場合はlogin.phpへリダイレクト
	if ($result['login'] == 'NG' || $result["owner"] != 1) {
		//ログイン画面に、入力された値を保持したままリダイレクト
		header('Location: ../view/login.php');
		error_log(print_r("testFail",true),"3","../../../../../logs/error_log");
		exit;
	}

	//取得したユーザー情報をSessionに保存する
	$_SESSION["loginUser"] = $result;
	header('Location: ../view/management.php');
	exit;
}



