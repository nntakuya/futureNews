<?php 


/**
 * 
 */
class ClassName extends AnotherClass
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
	
	function __construct(argument)
	{
		
	}



	//ログインする際に必要な情報
	//1.email 2.password

	//新規登録する際に必要な情報
	// name email password image owner 

	//エラーが出た場合、その都度、セッターのファンクションで、$error配列にエラー項目を追加していく
	function create($name,$email,$password,$image,$owner){

		$this->setName($name);

		$this->setEmail();

		$this->setPassword();

		$this->setImagePath();

		$this->setOwner();

		//各項目において、エラーがない場合、データベースに反映させる
		if (condition) {
			# code...
		}

	}


	//バリデーション

	// ==========================
	//　　　　 ユーザー名
	// ==========================
	function setName($name){


	}

	function getName(){

	}

	// ==========================
	//　　　　 メールアドレス
	// ==========================
	function setEmail($email){

	}

	function getEmail(){

	}


	// ==========================
	//　　　　 パスワード
	// ==========================
	function setPassword($password){

	}

	function getPassword(){

	}


	// ==========================
	//　　　　 	画像
	// ==========================
	function setImagePath($image){

	}

	function getImagePath(){

	}


	// ==========================
	//　　　　 オーナー権
	// ==========================
	function setOwner($owner){

	}

	function getOwner(){

	}


}
