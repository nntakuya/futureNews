<?php 
/**
 * 
 */

class Model_Article 
{
	private $title = "";
	private $content = "";
	private $youtubeLink = "";
	private $error = [];
	


	//ログインする際に必要な情報
	//1.email 2.password

	//新規登録する際に必要な情報
	// name email password image owner 

	
	//記事登録
	//エラーが出た場合、その都度、セッターのファンクションで、$error配列にエラー項目を追加していく
	function create($title,$content,$youtubeLink){
		require("dbconnect.php");

		$inputTitle = $this->setTitle($title);
		$inputContent =$this->setContent($content);
		$inputYoutubeLink =$this->setYoutubeLink($youtubeLink);

		//TODO:ここのエラーの出し方は詰める
		if (isset($errors)) {
			return $errors;
		}

		$sql = 'INSERT INTO `articles` SET `title`=?,
										  `content`=?, 
								          `youtube_url`=?, 
								          `created`=NOW()';

		$data = [$inputTitle,$inputContent,$inputYoutubeLink];
		

		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);	
	}


	//全記事取得
	function find_all($id){
		require("dbconnect.php");

		$sql = 'SELECT * FROM `articles`';

		// error_log(print_r("success",true),"3","../../../../../logs/error_log");//デバッグ
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        // セレクト文を実行した結果を取得する。
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        // 全件取得させる場合はループさせて、配列に入れる
        // セレクトした内容の一番上(エクセルの表の一番上のみ)だけ取得して存在するかどうかチェックすれば、ログイン判定可能

        if ($record) {
        	$articles[] = $record;
        	error_log(print_r($record,true),"3","../../../../../logs/error_log");//デバッグ
        	return $articles;
        }else{
        	$errors['login'] = 'NG';//エラーの場合の対処を考える
        	return $errors;
        }
	}


	//ログイン機能
	// function find_by($email,$password){
	// 	require("dbconnect.php");

	// 	$sql = 'SELECT * FROM `users` WHERE `email` = ? AND `password` = ?';

	// 	// error_log(print_r("success",true),"3","../../../../../logs/error_log");//デバッグ
 //        // ?マークを代入する
 //        $data = array($email,$password);
 //        $stmt = $dbh->prepare($sql);
 //        $stmt->execute($data);

 //        // セレクト文を実行した結果を取得する。
 //        $record = $stmt->fetch(PDO::FETCH_ASSOC);
 //        // 全件取得させる場合はループさせて、配列に入れる
 //        // セレクトした内容の一番上(エクセルの表の一番上のみ)だけ取得して存在するかどうかチェックすれば、ログイン判定可能

 //        if ($record) {
 //        	error_log(print_r($record,true),"3","../../../../../logs/error_log");//デバッグ
 //        	return $record;
 //        }else{
 //        	$errors['login'] = 'NG';//エラーの場合の対処を考える
 //        	return $errors;
 //        }
	// }



	//バリデーション

	// ==========================
	//　　　　 タイトル名
	// ==========================
	function setTitle($title){

		return $title;
	}

	function getTitle(){

	}

	// ==========================
	//　　　　 内容
	// ==========================
	function setContent($content){
		return $content;
	}

	function getContent(){

	}


	// ==========================
	//　　　　 Youtubeリンク
	// ==========================
	function setYoutubeLink($youtubeLink){
		return $youtubeLink;
	}

	function getYoutubeLink(){

	}


	
}
