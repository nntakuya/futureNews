<?php 
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


	//(課題）errorの数が0じゃない場合にするか？
	// if ($result == "error") {
	// 	//new.phpへリダイレクト
	// 		//フォームの初期値を入力状態へ
	// }
	//そのままtop.phpへリダイレクト
}
	
//ユーザーのログイン
function loginUser(){
	$user = new Model_User; //ユーザーモデルインスタンスを作成
	$email = htmlspecialchars($_POST["email"]);
	$password = htmlspecialchars($_POST["password"]);

	$loginUser = $user->find_by($email,$password);//email,passwordからログインユーザーを認証
	// error_log(print_r($loginUser,true),"3","../../../../../logs/error_log");


}



