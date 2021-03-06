<?php 

class Model_User 
{
	private $name = "";
	private $email = "";
	private $password = "";
	private $image = "";
	private $owner = 0;
	private $errors = [
		"login"=>"",
	];
	

	
	//ユーザー登録
	//エラーが出た場合、その都度、セッターのファンクションで、$error配列にエラー項目を追加していく
	//TODO:アカウント作成時、既に存在するアカウントの場合をエラーにする
	function create($name,$email,$password,$owner){
		require("dbconnect.php");

		$inputName = $this->setName($name);
		$inputEmail = $this->setEmail($email);
		$inputPassword = $this->setPassword($password);
		$inputImagePath = $this->setImagePath();
		$inputOwener = $this->setOwner($owner);


		//各項目において、エラーがない場合、データベースに反映させる
		//TODO:ここのエラーの出し方は詰める
		if (isset($errors)) {
			return $errors;
		}
		$sql = 'INSERT INTO `users` SET `name`=?,
										  `email`=?, 
								          `password`=?, 
								          `image`=?, 
								          `owner`=?, 
								          `created_at`=NOW()';

		$data = [$inputName,$inputEmail,$inputPassword,$inputImagePath,$inputOwener];
		// error_log(print_r($data,true),"3","../../../../../logs/error_log");//デバッグ
		

		$stmt = $dbh->prepare($sql);
		$stmt->execute($data);

		//下記の処理はもう一度考える
		$result =  $this->find_by($inputEmail,$inputPassword);//インサート後にログイン処理

		return $result;
	}


	//ユーザー検索
	function find($id){

	}


	//ログイン機能
	function find_by($email,$password){
		require("dbconnect.php");
		$status = [
			"loginUser"=>[],
			"error"=>""
		];
	

		//Emailとパスワードに合致するユーザーをデータベースから取得する
		$sql = 'SELECT * FROM `users` WHERE `email` = ? AND `password` = ?';
        $data = array($email,$password);
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        $status["loginUser"] = $stmt->fetch(PDO::FETCH_ASSOC);

        //取得できなかった場合、エラーフラグをセット
        if (!$status["loginUser"]) {
        	$status["error"] = 'notFind';
        }


        error_log(print_r("status",true),"3","../../../../../logs/error_log");//デバッグ
        error_log(print_r($status,true),"3","../../../../../logs/error_log");//デバッグ

        return $status;

	}



	//バリデーション

	// ==========================
	//　　　　 ユーザー名
	// ==========================
	function setName($name){

		//空文字
		//文字数チェック


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
	function setImagePath(){
		//画像の拡張子のバリデーションをセットする
		// ファイル名を取得する（アップロードされなければ空）

        $fileName = $_FILES['image']['name']; 
        error_log(print_r("FILES",true),"3","../../../../../logs/error_log");//デバッグ
        error_log(print_r($_FILES,true),"3","../../../../../logs/error_log");//デバッグ
        

        if(!empty($fileName))
        {
                $ext = substr($fileName,-3); 

                $ext = strtolower($ext); 
                if ($ext != "jpg" && $ext != "png" && $ext != "gif") { 
                    $errors["image"] = "extention"; 
                }

        }
        
		move_uploaded_file($_FILES["image"]["tmp_name"],'../assets/user_image/'.$fileName);

		return $fileName;


            // // ファイル名を取得する（アップロードされなければ空）
            // $fileName = $_FILES['image']['name']; 
            // // フラグを立てる
            // $f_flag=false;
            // if(empty($fileName) && !empty($_SESSION["login_user"]['image'])){
            //     $f_flag=true;
            // }

            // //アップロードされた、または過去にアップロードしてたら
            // if(!empty($fileName) || $f_flag==true ){
            //     // アップロードしてたらファイルの拡張子チェック

            //     if(!empty($fileName)){
            //         $ext = substr($fileName,-3); 
    
            //         $ext = strtolower($ext); 
            //         if ($ext != "jpg" && $ext != "png" && $ext != "gif") { 
            //             $errors["image"] = "extention"; 
            //         }
            //           // else{
            //           //   $errors['image'] = "blank";
            //           // }
            //     }else{
            //       //アップロードしてなかったら、現在の画像を選択
            //       $fileName=$_SESSION["login_user"]['image'];
            //     }
            //    // エラーが空の時
            //    if (empty($errors['image'])) {
             

            //    // 画像を保存する
            //       if(!empty($fileName)){
            //         // echo$fileName;
            //         move_uploaded_file($_FILES["image"]["tmp_name"],'../image/'.$fileName); 
            //            error_log(print_r('$fileName',true),"3","../../../../../logs/error_log");
                  
            //       }
                
            //       // イメージのフォルダの中にファイルを保存する
            //   }



		
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




	// ==========================
	//　　　　 バリデーション
	// ==========================
	function validation($data) {

	$error = array();

	// 氏名のバリデーション
	if( empty($data['your_name']) ) {
		$error[] = "「氏名」は必ず入力してください。";
	}

	// メールアドレスのバリデーション
	if( empty($data['email']) ) {
		$error[] = "「メールアドレス」は必ず入力してください。";
	}

	// 性別のバリデーション
	if( empty($data['gender']) ) {
		$error[] = "「性別」は必ず入力してください。";
	}

	// 年齢のバリデーション
	if( empty($data['age']) ) {
		$error[] = "「年齢」は必ず入力してください。";
	}

	// お問い合わせ内容のバリデーション
	if( empty($data['contact']) ) {
		$error[] = "「お問い合わせ内容」は必ず入力してください。";
	}

	// プライバシーポリシー同意のバリデーション
	if( empty($data['agreement']) ) {
		$error[] = "プライバシーポリシーをご確認ください。";
	}

	return $error;
}



}
