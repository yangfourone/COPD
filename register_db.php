<?php
// 設置資料類型 json
header('Content-Type: application/json; charset=UTF-8');

// 連結資料庫
$con = mysqli_connect('localhost','root','qcg444ntn','session_login');
mysqli_select_db($con,"account");

    if (!isset($_POST['ID']) || empty($_POST['ID']) ||
		!isset($_POST['Username']) || empty($_POST['Username']) ||
        !isset($_POST['Password']) || empty($_POST['Password']) ||
        !isset($_POST['Fullname']) || empty($_POST['Fullname'])) {
        echo json_encode(array('msg' => '資料未填寫完全！'));

        return;
    }
	else {
		$id = $_POST['ID'];
		$username = $_POST['Username'];
		$password = $_POST['Password'];
		$fullname = $_POST['Fullname'];
		$sql_insert = "INSERT INTO account (id, username, password, fullname) VALUES ('$id','$username','$password','$fullname')";
		$result = mysqli_query($con,$sql_insert);	
	}

    // 儲存成功，返回學生姓名
    echo json_encode(array('Username' => $_POST['Username']));


?>