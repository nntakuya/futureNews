<?php 
/**
 * 
 */

//todo
//データベースへ接続など共通で必要なコードをまとめる

class Comment 
{
	//TODO
	//プロパティのセット
	//1.name 2.email 3.password 4.image 5.owner


	private $comment = "";
	
	function __construct(argument)
	{
		
	}



	//ログインする際に必要な情報
	//1.email 2.password

	//新規登録する際に必要な情報
	// name email password image owner 

	
	//ユーザー登録
	//エラーが出た場合、その都度、セッターのファンクションで、$error配列にエラー項目を追加していく
	function create($comment){

		$this->setComment($name);

		
		//各項目において、エラーがない場合、データベースに反映させる
		if (condition) {
			# code...
		}

	}


	//ユーザー検索
	function find($id){
		
	}




	






	//バリデーション

	// ==========================
	//　　　　 comment
	// ==========================
	function setComment($name){


	}

	function getComment(){

	}



}
