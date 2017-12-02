<?php
// 設置資料類型 json
// 連結資料庫
require 'connect.php';
mysqli_select_db($con,"user");

if (!isset($_POST['ID']) || empty($_POST['ID']) ||
	!isset($_POST['FirstName']) || empty($_POST['FirstName']) ||
    !isset($_POST['LastName']) || empty($_POST['LastName']) ||
	!isset($_POST['Sex']) ||
	!isset($_POST['BMI']) || empty($_POST['BMI']) ||
	!isset($_POST['History']) || empty($_POST['History']) || 
	!isset($_POST['Drug']) || empty($_POST['Drug']) || 
	!isset($_POST['ENV_ID']) || empty($_POST['ENV_ID']) || 
	!isset($_POST['BLE_ID']) || empty($_POST['BLE_ID']) || 
	!isset($_POST['Watch_ID']) || empty($_POST['Watch_ID'])) 
	{
    	echo json_encode(array('msg' => 'The UPDATE data is not complete!!'));
        return;
    }

else{
	$id = $_POST['ID'];
	$fname = $_POST['FirstName'];
	$lname = $_POST['LastName'];
	$sex = $_POST['Sex'];
	$bmi = $_POST['BMI'];
	$history = $_POST['History'];
	$drug = $_POST['Drug'];
	$env_id = $_POST['ENV_ID'];
	$ble_id = $_POST['BLE_ID'];
	$watch_id = $_POST['Watch_ID'];
	$sql_update = "UPDATE user SET fname='$fname', lname='$lname', sex='sex', bmi='$bmi', history='$history', drug='$drug', env_id='$env_id', ble_id='$ble_id', watch_id='$watch_id' WHERE id='$id'";
	$result = mysqli_query($con,$sql_update);	
	
	}

// 儲存成功，返回姓名
echo json_encode(array('FirstName' => $_POST['FirstName']));

?>