<?php
// 設置資料類型 json
// 連結資料庫
require 'connect.php';
mysqli_select_db($con,"account");

if (!isset($_POST['ID']) || empty($_POST['ID']) || 
	!isset($_POST['Fullname']) || empty($_POST['Fullname'])) {
    
    echo json_encode(array('msg' => 'Typing ID and Fullname to delete!'));
    return;
}
else {
	$id = $_POST['ID'];
	$_fullname = $_POST['Fullname'];
	$sql = "SELECT * FROM account WHERE id = '$id' and fullname = '$_fullname'";
	$result = mysqli_query($con,$sql);

	if(mysqli_num_rows($result) == 0) {
		echo json_encode(array('msg' => 'The nurse is not existence!'));
		return;
	}
	else {
		$sql_delete = "DELETE FROM account WHERE id = '$id' and fullname = '$_fullname'";
		$delete_result = mysqli_query($con,$sql_delete);	
		// 刪除成功，返回姓名
		echo json_encode(array('Fullname' => $_fullname));
	}
}

?>