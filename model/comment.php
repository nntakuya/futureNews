<?php 

class Model_Comment 
{
	private $comments = "";

	//コメント登録
	//todo
	//1.commentテーブルへのインサート文を作成
	//2.article_comment中間テーブルへのインサート文を作成
	//3.user_comment中間テーブルへのインサート文を作成
	function create($comment,$articleID,$userID){
		require("dbconnect.php");

		$inputComment = $this->setComment($comment);


	
		//TODO:ここのエラーの出し方は詰める
		if (isset($errors)) {
			return $errors;
		}

		$sql = 'INSERT INTO `comments` SET `comment`=?,
								          `created_at`=NOW()';
		$data = [$inputComment];
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);

		//インサート後、commentsテーブルの一番最後のデータだけを取得
		$comment = $this->find_latest_comment();

		//2.article_comment中間テーブルへのインサート文を作成
		$sql = 'INSERT INTO `article_comment` SET `article_id`=?,
												  `comment_id`=?,
												  `created_at`=NOW(),
								          		  `updated_at`=NOW()'; 

		$data = [$articleID,$comment["id"]];
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);


		//3.user_comment中間テーブルへのインサート文を作成
		$sql = 'INSERT INTO `user_comment` SET `user_id`=?,
												`comment_id`=?,
												`created_at`=NOW(),
								          		`updated_at`=NOW()'; 
		$data = [$userID,$comment["id"]];
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);		
	}




	//全コメント取得
	//取得したいカラム：artcle_id,comment,user_iamge,user_name,created_at(comment)
	//上記カラムを取得し、ソートを昇順にする（古いコメントが一番上にある状態にする）
	//TODO
	//必要なテーブル：commentsテーブル,articleテーブル,userテーブル,
	// 				中間(article_comment)テーブル,中間(user_comment)テーブル
	function find_all(){
		require("dbconnect.php");
		//初期化
		$comments = [];

		//SQLクエリを発行
		$sql = 'SELECT * FROM `comments`';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        
        //記事データを取得
        while(true){
			$record = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!$record){
				break;
			}
			$comments[] = $record;
		}
		return $comments;
	}

	function delete($id){
		//datebaseへ接続する
		require("dbconnect.php");
		//デリートクエリを実行
		$sql = 'DELETE FROM `comments` WHERE `id`=?';
		$data = [$id];
		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);
	}







	
	function find_by($id){
		require("dbconnect.php");
		//初期化
		$comments=[];

		$sql = 'SELECT
					a.id as article_id,
				   ComUser.comment as comment,
				   ComUser.user_name as user_name,
				   ComUser.user_image as user_image,
				   ComUser.created_at as created_at
				FROM
					(
				        articles as a
				     INNER JOIN
				        article_comment as ac
						ON
				        a.id = ac.article_id
				    )
				 INNER JOIN
				    (
				        SELECT
				           u.name as user_name,
				           u.image as user_image,
				            c.id as com_id,
				           c.comment as comment,
				           c.created_at as created_at
				        FROM
				        (
				                users as u
				             INNER JOIN
				                user_comment as uc
				             ON
				                u.id = uc.user_id
				        )
					    INNER JOIN
					        comments as c
				   		 ON
				      		  uc.comment_id = c.id
				     ) as ComUser
				ON
					ac.comment_id = ComUser.com_id
				WHERE
					a.id = ?
				ORDER by created_at;';

        $data = [$id];
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        // セレクト文を実行した結果を取得する。
        while(true){
			$record = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!$record){
				break;
			}
			$comments[] = $record;
		}
        
        

        error_log(print_r($comments,true),"3","../../../../../logs/error_log");//デバッグ
        return $comments;
	}


	//comment内容からcommentデータを取得
	function find_latest_comment(){
		require("dbconnect.php");

		$sql = 'SELECT * FROM `comments` ORDER BY created_at DESC';

        $data = [];
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        // セレクト文を実行した結果を取得する。
        $comment = $stmt->fetch(PDO::FETCH_ASSOC);
        

        error_log(print_r($comment,true),"3","../../../../../logs/error_log");//デバッグ
        return $comment;
	}


	//バリデーション

	// ==========================
	//　　　　 コメント
	// ==========================
	function setComment($comment){

		return $comment;
	}

	function getComment(){

	}

	

	
}
