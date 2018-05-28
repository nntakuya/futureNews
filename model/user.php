<?php 
// error_log(print_r("model",true),"3","../../../../../logs/error_log");//デバッグ

class Model_User 
{
	private $name = "";
	private $email = "";
	private $password = "";
	private $image = "";
	private $owner = 0;
	private $error = [];
	

	
	//ユーザー登録
	//エラーが出た場合、その都度、セッターのファンクションで、$error配列にエラー項目を追加していく
	//TODO:アカウント作成時、既に存在するアカウントの場合をエラーにする
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


	//ログイン機能
	function find_by($email,$password){
		require("dbconnect.php");

		$sql = 'SELECT * FROM `users` WHERE `email` = ? AND `password` = ?';

		// error_log(print_r("success",true),"3","../../../../../logs/error_log");//デバッグ
        // ?マークを代入する
        $data = array($email,$password);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        // セレクト文を実行した結果を取得する。
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        // 全件取得させる場合はループさせて、配列に入れる
        // セレクトした内容の一番上(エクセルの表の一番上のみ)だけ取得して存在するかどうかチェックすれば、ログイン判定可能

        if ($record) {
        	error_log(print_r($record,true),"3","../../../../../logs/error_log");//デバッグ
        	return $record;
        }else{
        	$errors['login'] = 'NG';//エラーの場合の対処を考える
        }
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
