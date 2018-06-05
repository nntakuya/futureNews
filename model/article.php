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
		$inputContent = $this->setContent($content);
		$inputYoutubeLink = $this->setYoutubeLink($youtubeLink);

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
		require("dbconnect.php");//datebaseへ接続

		//余力があれば、下記のやり方を試す
		// $SQLqueries = [
		// 	"delete" => 'DELETE FROM `articles` WHERE `id`=?',
		// 	"delete" => 'DELETE FROM `article_comment` WHERE `article_id`=?',
		// 	"select" => 'SELECT * FROM `article_comment` WHERE `article_id`= ?;',
		// 	"delete" => 'DELETE FROM `user_comment` WHERE `comment_id`=?',
		// 	"delete" => 'DELETE FROM `comments` WHERE `id`=?'
		// ]

		// foreach ($SQLqueries as $DeleteTarget => $SQLquery) 
		// {
		// 	if ($DeleteTarget == "delete") {
		// 		$data = [$id];
		// 		$stmt = $dbh->prepare($SQLquery);
		// 		$stmt->execute($data);


		// 	}elseif($DeleteTarget == "select"){


		// 		$data = [$id];
		//         $stmt = $dbh->prepare($SQLquery);
		//         $stmt->execute($data);
		        
		//         while(true){
		// 			$record = $stmt->fetch(PDO::FETCH_ASSOC);
		// 			if(!$record){
		// 				break;
		// 			}
		// 			$comments[] = $record;
		// 		}


		// 		//指定の記事に結びついているcommentテーブルとその中間テーブルの列をそれぞれ削除
		// 		foreach ($comments as $comment) {

		// 			//中間テーブルにあるcomment_idを削除
		// 			$sql = 'DELETE FROM `user_comment` WHERE `comment_id`=?';
		// 			$commentID = [$comment["comment_id"]];
		// 			$stmt = $dbh->prepare($sql);
		// 			$stmt->execute($commentID);

		// 			//commentテーブルにあるcomment内容の列を削除
		// 			$sql = 'DELETE FROM `comments` WHERE `id`=?';
		// 			$stmt = $dbh->prepare($sql);
		// 			$stmt->execute($commentID);
		// 		}

		// 	}

		// }




		//指定された記事を削除


		$sql = 'DELETE FROM `articles` WHERE `id`=?';
		$articleID = [$id];
		$stmt = $dbh->prepare($sql);
		$stmt->execute($articleID);




		// article_commentテーブル内の列を取得する前に、データを取得
		$sql = 'SELECT * FROM `article_comment` WHERE `article_id`= ?;';
 		$articleID = [$id];
        $stmt = $dbh->prepare($sql);
        $stmt->execute($articleID);
        
        while(true){
			$record = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!$record){
				break;
			}
			$comments[] = $record;
		}
	
		$sql = 'DELETE FROM `article_comment` WHERE `article_id`=?';	
		$stmt = $dbh->prepare($sql);
		$res = $stmt->execute($articleID);
		
	

		//指定の記事に結びついているcommentテーブルとその中間テーブルの列をそれぞれ削除
		foreach ($comments as $comment) {
			error_log(print_r($comment,true),"3","../../../../../logs/error_log");//デバッグ

			//中間テーブルにあるcomment_idを削除
			$sql = 'DELETE FROM `user_comment` WHERE `comment_id`=?';
			$commentID = [$comment["comment_id"]];
			$stmt = $dbh->prepare($sql);
			$stmt->execute($commentID);
			// error_log(print_r($comment["comment_id"],true),"3","../../../../../logs/error_log");//デバッグ

			//commentテーブルにあるcomment内容の列を削除
			$sql = 'DELETE FROM `comments` WHERE `id`=?';
			$stmt = $dbh->prepare($sql);
			error_log(print_r($comment["comment_id"],true),"3","../../../../../logs/error_log");//デバッグ
			$stmt->execute($commentID);
		}

	}



	// ログイン機能
	function find_by($id){
		require("dbconnect.php");//datebaseへ接続

		$sql = 'SELECT * FROM `articles` WHERE `id` = ?';

        $data = [$id];
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        // セレクト文を実行した結果を取得する。
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        

        // error_log(print_r($article,true),"3","../../../../../logs/error_log");//デバッグ
        return $article;
	}



	//youtubeの埋め込みコード取得
	function embTag($src){
		$emb1 = strstr($src, "v=");//youtubeのurl「v=」以降を取得

		$ampersand = strpos($emb1, "&");//$emb1の中に"&"の存在チェック

		if($ampersand){
			//"&"が存在する場合は、それ以降の文字列を除く
			$emb2 = mb_substr($emb1, 0, $ampersand);
		}else{
			//"&"が存在しない場合は、"v="以降の文字列をそのまま使用
			$emb2 = $emb1;
		}

		$emb = mb_substr($emb2, 2);//"v="の文字列を削除

		error_log(print_r("emb:".$emb,true),"3","../../../../../logs/error_log");//デバッグ

		return $emb;
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

		$embURL = $this->embTag($youtubeLink); //youtubeの埋め込みコード取得

		return $embURL;
	}

	function getYoutubeLink(){

	}


	
}
