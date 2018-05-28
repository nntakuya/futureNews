<?php 
// error_log(print_r("model",true),"3","../../../../../logs/error_log");//デバッグ

class Model_User 
{
	

	//TODO
	//プロパティのセット
	//1.name 2.email 3.password 4.image 5.owner



	private $name = "";
	private $email = "";
	private $password = "";
	private $image = "";
	private $owner = 0;
	private $error = [];
	



	//ログインする際に必要な情報
	//1.email 2.password

	//新規登録する際に必要な情報
	// name email password image owner 

	
	//ユーザー登録
	//エラーが出た場合、その都度、セッターのファンクションで、$error配列にエラー項目を追加していく
	function create($name,$email,$password,$image,$owner){
		require("dbconnect.php");

		//todo
		//以下のメソッドを作る

		$inputName = $this->setName($name);

		$inputEmail =$this->setEmail($email);

		$inputPassword =$this->setPassword($password);

		$inputImagePath =$this->setImagePath($image);


		$inputOwener =$this->setOwner($owner);

		//各項目において、エラーがない場合、データベースに反映させる
		// if (condition) {
		// 	# code...
		// }

		$sql = 'INSERT INTO `users` SET `name`=?,
										  `email`=?, 
								          `password`=?, 
								          `image`=?, 
								          `owner`=?, 
								          `created_at`=NOW()';

		$data = [$inputName,$inputEmail,$inputPassword,$inputImagePath,$inputOwener];
		// error_log(print_r($data,true),"3","../../../../../logs/error_log");//デバッグ
		

		$stmt = $dbh->prepare($sql);
		$result = $stmt->execute($data);


	}


	//ユーザー検索
	function find($id){

	}





	//バリデーション

	// ==========================
	//　　　　 ユーザー名
	// ==========================
	function setName($name){

		return $name;
	}

	function getName(){

	}

	// ==========================
	//　　　　 メールアドレス
	// ==========================
	function setEmail($email){
		return $email;
	}

	function getEmail(){

	}


	// ==========================
	//　　　　 パスワード
	// ==========================
	function setPassword($password){
		return $password;
	}

	function getPassword(){

	}


	// ==========================
	//　　　　 	画像
	// ==========================
	function setImagePath($image){
		//画像の拡張子のバリデーションをセットする
		return $image;
	}

	function getImagePath(){

	}


	// ==========================
	//　　　　 オーナー権
	// ==========================
	function setOwner($owner){
		//コンソールログイン画面からユーザーを登録する場合のみ、$owner = 1　にする
		return $owner;
	}

	function getOwner(){

	}


}
