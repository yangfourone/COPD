<?php
// 設置資料類型 json
// 連結資料庫
require 'connect.php';
mysqli_select_db($con,"account");

if (!isset($_POST['ID']) || empty($_POST['ID']) ||
	!isset($_POST['Username']) || empty($_POST['Username']) ||
    !isset($_POST['Password']) || empty($_POST['Password']) ||
    !isset($_POST['Fullname']) || empty($_POST['Fullname'])) {
    echo json_encode(array('msg' => 'The data is not complete!!'));

    return;
}
else {
	$id = $_POST['ID'];
	$username = $_POST['Username'];
	$fullname = $_POST['Fullname'];
	$password = $_POST['Password'];
	$sql_insert = "INSERT INTO account (id, username, fullname, password) VALUES ('$id','$username','$fullname','$password')";
	$result = mysqli_query($con,$sql_insert);	
}

// 儲存成功，返回姓名
echo json_encode(array('Username' => $_POST['Username']));

?>