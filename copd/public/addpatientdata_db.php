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
	!isset($_POST['Drug']) || empty($_POST['Drug'])) 
	{
    	echo json_encode(array('msg' => 'The data is not complete!!'));
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
	$sql_insert = "INSERT INTO user (id,fname,lname,sex,bmi,history,drug) VALUES ('$id','$fname','$lname','$sex','$bmi','$history','$drug')";
	$result = mysqli_query($con,$sql_insert);	
	
	}

// 儲存成功，返回姓名
echo json_encode(array('FirstName' => $_POST['FirstName']));

?>