<?php 
require("../model/user.php");

// 初期値のセット
$name = "";
$email = 
$password = "";
//imageは保留
$image = "sampleImage";
$owner = 0;

//userインスタントの作成



//ここで条件分岐
//new.phpとlogin.phpのいずれかで処理を変える


createUser();




function createUser(){
	$user = new Model_User;
	$name = htmlspecialchars($_POST["name"]);
	$email = htmlspecialchars($_POST["email"]);
	$password = htmlspecialchars($_POST["password"]);

	$image = htmlspecialchars($_POST["image"]);
	$owner = 0;//debug
	// $owner = htmlspecialchars($_POST["owner"]);

	// error_log(print_r($image,true),"3","../../../../../logs/error_log");

	$result = $user->create($name,$email,$password,$image,$owner);




	//(課題）errorの数が0じゃない場合にするか？
	// if ($result == "error") {
	// 	//new.phpへリダイレクト
	// 		//フォームの初期値を入力状態へ
	// }
	//そのままtop.phpへリダイレクト

}
	






// if (condition) {
// 	// フォームからの値を取得
// 	$name = htmlspecialchars($_POST["username"]);
// 	$email = htmlspecialchars($_POST["email"]);
// 	$password = htmlspecialchars($_POST["password"]);
// 	$image = "sampleImage";//imageは保留
// 	$owner = htmlspecialchars($_POST["owner"]);

// 	$user->createUser();

	

// }elseif(){
// 	$user->loginUser();
// }




