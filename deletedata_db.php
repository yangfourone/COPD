<?php
// 設置資料類型 json
// 連結資料庫
require 'connect.php';
mysqli_select_db($con,"user");

if (!isset($_POST['ID']) || empty($_POST['ID']) || 
	!isset($_POST['Firstname']) || empty($_POST['Firstname'])) {
    
    echo json_encode(array('msg' => 'Typing ID and Firstname to delete!'));
    return;
}
else {
	$id = $_POST['ID'];
	$_fname = $_POST['Firstname'];
	$sql = "SELECT * FROM user WHERE id = '$id' and fname = '$_fname'";
	$result = mysqli_query($con,$sql);

	if(mysqli_num_rows($result) == 0) {
		echo json_encode(array('msg' => 'The patient is not existence!'));
		return;
	}
	else {
		$sql_delete = "DELETE FROM user WHERE id = '$id' and fname = '$_fname'";
		$delete_result = mysqli_query($con,$sql_delete);
		// 刪除成功，返回姓名
		echo json_encode(array('Firstname' => $_fname));
	}
}

?>