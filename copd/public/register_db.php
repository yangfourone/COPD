<?php
// 連結資料庫
require 'connect.php';
mysqli_select_db($con,"acc");

    if (!isset($_POST['accountName']) || empty($_POST['accountName']) ||
		!isset($_POST['firstname']) || empty($_POST['firstname']) ||
        !isset($_POST['lastname']) || empty($_POST['lastname']) ||
        !isset($_POST['password1']) || empty($_POST['password1']) ||
        !isset($_POST['password2']) || empty($_POST['password2'])) 
    {
      	echo json_encode(array('msg' => 'The data is not complete!!'));
        return;
    }
	else {
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		if(!($password1==$password2)){
			echo json_encode(array('msg' => 'The password is not the same!!'));
			return;
		}
		else {
			$account = $_POST['accountName'];
			$fname = $_POST['firstname'];
			$lname = $_POST['lastname'];
			$password = $_POST['password1'];
			$sql_insert = "INSERT INTO acc (account, fname, lname, password) VALUES ('$account','$fname','$lname','$password')";
			$result = mysqli_query($con,$sql_insert);	
		}
		// 儲存成功，返回帳戶名
    	echo json_encode(array('accountName' => $_POST['accountName']));
	}
    

?>