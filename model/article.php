<?php 

class Model_Article 
{
	private $title = "";
	private $content = "";
	private $youtubeLink = "";
	private $articles = [];


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
	function find_all(){
		require("dbconnect.php");
		//初期化
		$articles = [];

		//SQLクエリを発行
		$sql = 'SELECT * FROM `articles`';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        
        //記事データを取得
        while(true){
			$record = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!$record){
				break;
			}
			$articles[] = $record;
		}
		return $articles;
	}

	function delete($id){
		//datebaseへ接続する
		require("dbconnect.php");
		//デリートクエリを実行
		$sql = 'DELETE FROM `articles` WHERE `id`=?';
		$data = [$id];
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);
	}







	// ログイン機能
	function find_by($id){
		require("dbconnect.php");

		$sql = 'SELECT * FROM `articles` WHERE `id` = ?';

        $data = [$id];
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        // セレクト文を実行した結果を取得する。
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        

        error_log(print_r($article,true),"3","../../../../../logs/error_log");//デバッグ
        return $article;
	}



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
